<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    // Tahap 1 = status "diproses" (Interview & Tes), Tahap 2 = status "wawancara" (Tahap Final)
    private const STAGES = ['interview' => 'diproses', 'final' => 'wawancara'];

    public function index(Request $request)
    {
        $tahap = $request->query('tahap') === 'final' ? 'final' : 'interview';

        return view('hrd.selection.index', [
            'tahap'        => $tahap,
            'applications' => JobApplication::with('vacancy')->where('status', self::STAGES[$tahap])->oldest()->get(),
        ]);
    }

   public function decide(Request $request, JobApplication $application)
{
    $request->validate(['keputusan' => 'required|in:lolos,gugur']);

    if (! in_array($application->status, self::STAGES, true)) {
        return back()->with('error', 'Pelamar ini tidak sedang berada di tahap seleksi.');
    }

    if ($request->keputusan === 'gugur') {
        $application->update(['status' => 'ditolak']);
        return back()->with('success', $application->nama . ' dinyatakan gugur.');
    }

    $next = $application->status === 'diproses' ? 'wawancara' : 'diterima';
    $application->update(['status' => $next]);

    $message = match ($next) {
        'wawancara' => $application->nama . ' lolos ke Tahap Final.',
        'diterima'  => $application->nama . ' berhasil DITERIMA sebagai karyawan.',
        default     => 'Keputusan disimpan.',
    };

    return back()->with('success', $message);
}
}