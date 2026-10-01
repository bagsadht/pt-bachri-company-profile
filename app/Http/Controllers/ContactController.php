<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'nama'      => 'required|string|max:100',
           'no_telpon' => 'nullable|regex:/^[0-9+\-\s]+$/|min:8|max:20',
            'email'     => 'required|email|max:100',
            'pesan'     => 'required|string|max:1000',
        ]);

        // 2. Kirim email ke admin
        try {
            Mail::send([], [], function ($message) use ($validated) {
                $message->to('bachrisamuderaindonesia@gmail.com')
                        ->replyTo($validated['email'], $validated['nama'])
                        ->subject('Pesan Baru dari Website - ' . $validated['nama'])
                        ->html(
                            '<h3>Pesan Baru dari Form Kontak</h3>' .
                            '<p><strong>Nama:</strong> ' . e($validated['nama']) . '</p>' .
                            '<p><strong>No. Telepon:</strong> ' . e($validated['no_telpon'] ?? '-') . '</p>' .
                            '<p><strong>Email:</strong> ' . e($validated['email']) . '</p>' .
                            '<p><strong>Pesan:</strong><br>' . nl2br(e($validated['pesan'])) . '</p>'
                        );
            });
        } catch (\Exception $e) {
            // Catat error supaya bisa dicek di storage/logs/laravel.log
            Log::error('Gagal kirim email kontak: ' . $e->getMessage());

            return redirect()->route('contact')
                ->withInput()
                ->with('error', 'Maaf, pesan gagal dikirim. Silakan coba lagi atau hubungi kami via WhatsApp.');
        }

        // 3. Sukses
        return redirect()->route('contact')
            ->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}