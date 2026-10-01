<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = JobApplication::with('vacancy')->latest();

        if ($request->filled('vacancy')) {
            $query->where('job_vacancy_id', $request->integer('vacancy'));
        }
        if ($request->filled('status') && array_key_exists($request->status, JobApplication::STATUSES)) {
            $query->where('status', $request->status);
        }

        return view('admin.applications.index', [
            'applications' => $query->paginate(20)->withQueryString(),
            'vacancies'    => JobVacancy::orderBy('title')->get(['id', 'title']),
        ]);
    }

    public function update(Request $request, JobApplication $application)
    {
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(JobApplication::STATUSES)),
        ]);

        $application->update($data);

        return back()->with('success', 'Status lamaran diperbarui.');
    }

    public function cv(JobApplication $application)
    {
        abort_unless(Storage::exists($application->cv_path), 404, 'File CV tidak ditemukan.');

        $ext = pathinfo($application->cv_path, PATHINFO_EXTENSION);
        $name = 'CV-' . str($application->name)->slug() . '.' . $ext;

        return Storage::download($application->cv_path, $name);
    }

    public function destroy(JobApplication $application)
    {
        Storage::delete($application->cv_path);
        $application->delete();

        return back()->with('success', 'Lamaran dihapus.');
    }
}