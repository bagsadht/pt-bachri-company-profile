<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
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

        // 2. KIRIM EMAIL DULU
        try {
            Mail::send([], [], function ($message) use ($validated) {
                $message->to('adhityabagas216@gmail.com')
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
            // JIKA GAGAL: Catat error dan JANGAN simpan ke DB.
            Log::error('Gagal kirim email kontak: ' . $e->getMessage());

            return redirect()->route('contact')
                ->withInput()
                ->with('error', 'Maaf, pesan gagal dikirim karena masalah server email. Silakan coba lagi atau hubungi kami via WhatsApp.');
        }

        // 3. JIKA EMAIL SUKSES: Baru simpan ke Database
        $isiPesanLengkap = $validated['pesan'];
        if (!empty($validated['no_telpon'])) {
            $isiPesanLengkap .= "\n\nNo. Telepon: " . $validated['no_telpon'];
        }

        Pesan::create([
            'nama'      => $validated['nama'],
            'email'     => $validated['email'],
            'isi_pesan' => $isiPesanLengkap,
        ]);

        // 4. Tampilkan pesan sukses
        return redirect()->route('contact')
            ->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}