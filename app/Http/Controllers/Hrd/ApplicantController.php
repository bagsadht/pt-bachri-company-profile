<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Mail\ApplicantAcceptedMail;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    public function index(Request $request)
    {
        $mode = $request->routeIs('hrd.applications.index') ? 'masuk' : 'manajemen';
        $q    = trim((string) $request->query('q'));

        $query = JobApplication::with('vacancy')->latest();

        if ($mode === 'masuk') {
            $query->where('status', 'baru');
            $tab   = 'baru';
            $hasil = null;
        } else {
            $tab = in_array($request->query('tab'), ['interview', 'final', 'semua'], true)
                ? $request->query('tab')
                : 'interview';

            $hasil = in_array($request->query('hasil'), ['lolos', 'gagal'], true)
                ? $request->query('hasil')
                : null;

            if ($tab === 'semua') {
                if ($hasil === 'lolos')      $query->where('status', 'diterima');
                elseif ($hasil === 'gagal')  $query->where('status', 'ditolak');
            } else {
                $map = [
                    'interview' => 'diproses',
                    'final'     => 'wawancara',
                ];
                $query->where('status', $map[$tab]);
            }
        }

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhereHas('vacancy', fn ($v) => $v->where('judul', 'like', "%{$q}%"));
            });
        }

        return view('hrd.applicants.index', [
            'applications' => $query->paginate(20)->withQueryString(),
            'mode'         => $mode,
            'tab'          => $tab,
            'hasil'        => $hasil,
            'q'            => $q,
            'counts'       => [
                'baru'      => JobApplication::where('status', 'baru')->count(),
                'interview' => JobApplication::where('status', 'diproses')->count(),
                'final'     => JobApplication::where('status', 'wawancara')->count(),
                'semua'     => JobApplication::count(),
                'lolos'     => JobApplication::where('status', 'diterima')->count(),
                'gagal'     => JobApplication::where('status', 'ditolak')->count(),
            ],
        ]);
    }

    /**
     * Terima pelamar di tahap final + kirim email pengumuman otomatis.
     */
    public function acceptAndNotify(Request $request, JobApplication $application)
    {
        // Guard 1: harus di tahap final
        if ($application->status !== 'wawancara') {
            return response()->json([
                'success' => false,
                'message' => 'Pelamar ini bukan di Tahap Final.',
            ], 422);
        }

        // Guard 2: cegah kirim dobel
        if ($application->email_sent_at) {
            return response()->json([
                'success' => false,
                'message' => 'Email pengumuman sudah pernah dikirim ke pelamar ini.',
            ], 422);
        }

        // Validasi input dari modal
        $data = $request->validate([
            'subject'    => 'required|string|max:200',
            'message'    => 'required|string|max:3000',
            'start_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'workplace'  => 'required|string|max:200',
            'notes'      => 'nullable|string|max:1000',
        ]);

        try {
            // Update status + simpan detail
            $application->update([
                'status'           => 'diterima',
                'email_sent_at'    => now(),
                'email_type'       => 'accepted',
                'start_date'       => $data['start_date'],
                'start_time'       => $data['start_time'],
                'workplace'        => $data['workplace'],
                'onboarding_notes' => $data['notes'] ?? null,
            ]);

            // Kirim email pengumuman
            Mail::to($application->email)
                ->send(new ApplicantAcceptedMail(
                    application: $application,
                    subjectLine: $data['subject'],
                    bodyMessage: $data['message'],
                    startDate:   $data['start_date'],
                    startTime:   $data['start_time'],
                    workplace:   $data['workplace'],
                    notes:       $data['notes'] ?? null,
                ));

            return response()->json([
                'success' => true,
                'message' => "Berhasil! {$application->nama} telah DITERIMA & email pengumuman terkirim ke {$application->email}.",
            ]);

        } catch (\Throwable $e) {
            // Rollback kalau email gagal
            $application->update([
                'status'           => 'wawancara',
                'email_sent_at'    => null,
                'email_type'       => null,
                'start_date'       => null,
                'start_time'       => null,
                'workplace'        => null,
                'onboarding_notes' => null,
            ]);

            Log::error('Accept & Notify error: ' . $e->getMessage(), [
                'application_id' => $application->id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email: ' . $e->getMessage(),
            ], 500);
        }
    }
}