<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index()
    {
        $vacancies = JobVacancy::open()->latest()->get();

        return view('pages.careers.index', compact('vacancies'));
    }

    public function show(JobVacancy $vacancy)
    {
        abort_unless($vacancy->is_active, 404);

        return view('pages.careers.show', compact('vacancy'));
    }

    public function apply(Request $request, JobVacancy $vacancy)
    {
        abort_unless($vacancy->is_active, 404);

        if (! $vacancy->isOpen()) {
            return redirect()->route('careers.show', $vacancy)
                ->with('error', 'Maaf, lowongan ini sudah ditutup.');
        }

        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'email'        => 'required|email|max:100',
            'phone'        => ['required', 'regex:/^[0-9+\-\s]+$/', 'min:8', 'max:20'],
            'cover_letter' => 'nullable|string|max:2000',
            'cv'           => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'cv.required' => 'CV wajib diunggah.',
            'cv.mimes'    => 'CV harus berformat PDF, DOC, atau DOCX.',
            'cv.max'      => 'Ukuran CV maksimal 2 MB.',
            'phone.regex' => 'Nomor telepon hanya boleh berisi angka, +, - dan spasi.',
        ]);

        $alreadyApplied = $vacancy->applications()->where('email', $validated['email'])->exists();
        if ($alreadyApplied) {
            return back()->withInput()
                ->with('error', 'Email ini sudah pernah dipakai untuk melamar posisi tersebut.');
        }

        // CV disimpan di storage privat (tidak bisa dibuka lewat URL publik)
        $cvPath = $request->file('cv')->store('cvs');

        $application = $vacancy->applications()->create([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'cover_letter' => $validated['cover_letter'] ?? null,
            'cv_path'      => $cvPath,
        ]);

        $this->notifyAdmin($vacancy, $application);

        return redirect()->route('careers.show', $vacancy)
            ->with('success', 'Lamaran Anda berhasil dikirim! Tim kami akan menghubungi Anda jika profil Anda sesuai.');
    }

    // Kirim email notifikasi ke admin. Jika email gagal, lamaran tetap tersimpan.
    private function notifyAdmin(JobVacancy $vacancy, JobApplication $application): void
    {
        try {
            Mail::send([], [], function ($message) use ($vacancy, $application) {
                $message->to(config('admin.notify_email'))
                    ->replyTo($application->email, $application->name)
                    ->subject('Lamaran Baru: ' . $vacancy->title . ' - ' . $application->name)
                    ->html(
                        '<h3>Lamaran Baru</h3>' .
                        '<p><strong>Posisi:</strong> ' . e($vacancy->title) . '</p>' .
                        '<p><strong>Nama:</strong> ' . e($application->name) . '</p>' .
                        '<p><strong>Email:</strong> ' . e($application->email) . '</p>' .
                        '<p><strong>No. Telepon:</strong> ' . e($application->phone) . '</p>' .
                        '<p><strong>Surat Lamaran:</strong><br>' . nl2br(e($application->cover_letter ?? '-')) . '</p>'
                    )
                    ->attach(Storage::path($application->cv_path));
            });
        } catch (\Throwable $e) {
            Log::error('Gagal kirim notifikasi lamaran: ' . $e->getMessage());
        }
    }
}