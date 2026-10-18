<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Mail\InterviewInvitationMail;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index()
    {
        return view('hrd.applications.index', [
            'applications' => JobApplication::with('vacancy')
                ->where('status', 'baru')
                ->latest()
                ->paginate(20),
        ]);
    }

    public function update(Request $request, JobApplication $application)
    {
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(JobApplication::STATUSES)),
        ]);

        $oldStatus = $application->status;
        $application->update($data);

        // Kirim email otomatis saat status berubah menjadi 'diproses'
        if ($oldStatus !== 'diproses' && $data['status'] === 'diproses') {
            $this->sendInterviewInvitation($application);
        }

        $message = $data['status'] === 'diproses'
            ? 'Pelamar dipindahkan ke Proses Seleksi. Email undangan interview telah dikirim.'
            : 'Status lamaran diperbarui.';

        return back()->with('success', $message);
    }

    /**
     * Unduh CV pelamar.
     */
    public function cv(JobApplication $application)
    {
        // Cek apakah file benar-benar ada di folder storage
        abort_unless(Storage::exists($application->path_cv), 404, 'File CV tidak ditemukan di server.');

        $ext  = pathinfo($application->path_cv, PATHINFO_EXTENSION);
        $name = 'CV-' . \Illuminate\Support\Str::slug($application->nama) . '.' . $ext;

        // Ini akan memaksa browser untuk mengunduh file
        return Storage::download($application->path_cv, $name);
    }

    public function destroy(JobApplication $application)
    {
        Storage::delete($application->path_cv);
        $application->delete();

        return back()->with('success', 'Lamaran dihapus.');
    }

    private function sendInterviewInvitation(JobApplication $application): void
    {
        try {
            Mail::to($application->email)
                ->send(new InterviewInvitationMail($application));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email undangan interview: ' . $e->getMessage(), [
                'application_id' => $application->id,
                'email'          => $application->email,
            ]);
        }
    }
}