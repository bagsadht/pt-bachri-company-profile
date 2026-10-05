<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    // Kontak Masuk: lamaran yang belum ditinjau
    public function index()
    {
        return view('admin.applications.index', [
            'applications' => JobApplication::with('vacancy')->where('status', 'baru')->latest()->paginate(20),
        ]);
    }

    public function update(Request $request, JobApplication $application)
    {
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(JobApplication::STATUSES)),
        ]);

        $application->update($data);

        return back()->with('success', $data['status'] === 'diproses' ? 'Pelamar dipindahkan ke Proses Seleksi.' : 'Status lamaran diperbarui.');
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