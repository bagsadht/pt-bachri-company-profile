<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobVacancyController extends Controller
{
    public function index()
    {
        $vacancies = JobVacancy::withCount('applications')->latest()->get();

        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function create()
    {
        return view('admin.vacancies.form', ['vacancy' => new JobVacancy(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('vacancies', 'public');
        }

        JobVacancy::create($data);

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil dibuat.');
    }

    public function edit(JobVacancy $vacancy)
    {
        return view('admin.vacancies.form', compact('vacancy'));
    }

    public function update(Request $request, JobVacancy $vacancy)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            // Hapus foto lama sebelum ganti yang baru
            if ($vacancy->image_path) {
                Storage::disk('public')->delete($vacancy->image_path);
            }
            $data['image_path'] = $request->file('image')->store('vacancies', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($vacancy->image_path) {
                Storage::disk('public')->delete($vacancy->image_path);
            }
            $data['image_path'] = null;
        }

        // Slug sengaja tidak diubah agar link lowongan yang sudah dibagikan tetap valid
        $vacancy->update($data);

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function toggle(JobVacancy $vacancy)
    {
        $vacancy->update(['is_active' => ! $vacancy->is_active]);

        return back()->with('success', $vacancy->is_active
            ? 'Lowongan ditampilkan di situs.'
            : 'Lowongan disembunyikan dari situs.');
    }

    public function destroy(JobVacancy $vacancy)
    {
        foreach ($vacancy->applications as $application) {
            Storage::delete($application->cv_path);
        }
        if ($vacancy->image_path) {
            Storage::disk('public')->delete($vacancy->image_path);
        }
        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan dan seluruh lamarannya dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'           => 'required|string|max:150',
            'department'      => 'nullable|string|max:100',
            'location'        => 'required|string|max:100',
            'employment_type' => 'required|in:' . implode(',', JobVacancy::EMPLOYMENT_TYPES),
            'salary_range'    => 'nullable|string|max:100',
            'description'     => 'required|string',
            'requirements'    => 'required|string',
            'deadline'        => 'nullable|date',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        unset($data['image']); // ditangani terpisah di store()/update()

        return $data;
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'lowongan';
        $slug = $base;
        $i = 2;

        while (JobVacancy::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}