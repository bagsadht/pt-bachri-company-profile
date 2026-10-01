<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // Menampilkan halaman utama (Company Profile + Daftar Pesan)
    public function index()
    {
        $messages = Message::latest()->get(); // Ambil semua pesan, urutkan dari yang terbaru
        return view('company-profile', compact('messages'));
    }

    // Menyimpan pesan baru dari form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create($request->all());

        return redirect()->to('/#contact')->with('success', 'Pesan Anda berhasil dikirim!');
    }

    // Menghapus pesan
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->to('/#contact')->with('success', 'Pesan berhasil dihapus!');
    }
};