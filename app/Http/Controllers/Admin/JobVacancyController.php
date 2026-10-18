<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobVacancyController extends Controller
{
    public function index(Request $request)
    {
        // ==========================================
        // 1. HITUNG STATISTIK UNTUK KARTU & TAB
        // ==========================================
        $stats = [
            'all'      => JobVacancy::count(),
            'active'   => JobVacancy::where('aktif', true)
                                ->where(function ($q) {
                                    $q->whereNull('batas_lamaran')->orWhere('batas_lamaran', '>=', now());
                                })->count(),
            'inactive' => JobVacancy::where('aktif', false)->count(),
            'expired'  => JobVacancy::where('aktif', true)
                                ->whereNotNull('batas_lamaran')
                                ->where('batas_lamaran', '<', now())->count(),
        ];

        // ==========================================
        // 2. TAB AKTIF (default: 'all')
        // ==========================================
        $tab = $request->get('tab', 'all');

        // ==========================================
        // 3. QUERY UTAMA DENGAN FILTER
        // ==========================================
        $vacancies = JobVacancy::withCount('applications')
            // Filter Pencarian (Judul, Departemen, Lokasi)
            ->when($request->q, function ($query, $q) {
                return $query->where(function ($sub) use ($q) {
                    $sub->where('judul', 'like', "%{$q}%")
                        ->orWhere('departemen', 'like', "%{$q}%")
                        ->orWhere('lokasi', 'like', "%{$q}%");
                });
            })
            // Filter Tab: Aktif
            ->when($tab === 'active', function ($query) {
                return $query->where('aktif', true)
                    ->where(function ($q) {
                        $q->whereNull('batas_lamaran')->orWhere('batas_lamaran', '>=', now());
                    });
            })
            // Filter Tab: Nonaktif
            ->when($tab === 'inactive', function ($query) {
                return $query->where('aktif', false);
            })
            // Filter Tab: Kedaluwarsa
            ->when($tab === 'expired', function ($query) {
                return $query->where('aktif', true)
                    ->whereNotNull('batas_lamaran')
                    ->where('batas_lamaran', '<', now());
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.vacancies.index', compact('vacancies', 'stats', 'tab'));
    }

    public function create()
    {
        return view('admin.vacancies.form', ['vacancy' => new JobVacancy(['aktif' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['judul']);

        if ($request->hasFile('gambar')) {
            $data['path_gambar'] = $request->file('gambar')->store('vacancies', 'public');
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

        if ($request->hasFile('gambar')) {
            if ($vacancy->path_gambar) {
                Storage::disk('public')->delete($vacancy->path_gambar);
            }
            $data['path_gambar'] = $request->file('gambar')->store('vacancies', 'public');
        } elseif ($request->boolean('hapus_gambar')) {
            if ($vacancy->path_gambar) {
                Storage::disk('public')->delete($vacancy->path_gambar);
            }
            $data['path_gambar'] = null;
        }

        $vacancy->update($data);

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function toggle(JobVacancy $vacancy)
    {
        $vacancy->update(['aktif' => ! $vacancy->aktif]);

        return back()->with('success', $vacancy->aktif
            ? 'Lowongan ditampilkan di situs.'
            : 'Lowongan disembunyikan dari situs.');
    }

    public function destroy(JobVacancy $vacancy)
    {
        foreach ($vacancy->applications as $application) {
            Storage::delete($application->path_cv);
        }
        if ($vacancy->path_gambar) {
            Storage::disk('public')->delete($vacancy->path_gambar);
        }
        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan dan seluruh lamarannya dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'judul'           => 'required|string|max:150',
            'departemen'      => 'nullable|string|max:100',
            'lokasi'          => 'required|string|max:100',
            'jenis_pekerjaan' => 'required|in:' . implode(',', JobVacancy::EMPLOYMENT_TYPES),
            'kisaran_gaji'    => 'nullable|string|max:100',
            'deskripsi'       => 'required|string',
            'persyaratan'     => 'required|string',
            'batas_lamaran'   => 'nullable|date',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['aktif'] = $request->boolean('aktif');
        unset($data['gambar']);

        return $data;
    }

    private function uniqueSlug(string $judul): string
    {
        $base = Str::slug($judul) ?: 'lowongan';
        $slug = $base;
        $i = 2;

        while (JobVacancy::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}