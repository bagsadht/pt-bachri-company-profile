<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    private const DIR = 'laporan';
    private const NAME_PATTERN = '/^laporan-rekrutmen-\d{8}-\d{6}\.csv$/';

    private const STATUS_LABELS = [
        'aktif'    => 'Aktif Seleksi',
        'diterima' => 'Diterima',
        'ditolak'  => 'Ditolak',
    ];

    // Query pelamar sesuai filter (tanggal daftar & status akhir)
    private function filtered(Request $request)
    {
        $request->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date',
            'status' => 'nullable|in:aktif,diterima,ditolak',
        ]);

        $query = JobApplication::with('vacancy')->latest();

        if ($request->filled('dari'))   $query->whereDate('created_at', '>=', $request->dari);
        if ($request->filled('sampai')) $query->whereDate('created_at', '<=', $request->sampai);

        if ($request->status === 'aktif')         $query->active();
        elseif ($request->status === 'diterima')  $query->where('status', 'diterima');
        elseif ($request->status === 'ditolak')   $query->where('status', 'ditolak');

        return $query;
    }

    private function summary($applications): array
    {
        return [
            'total'    => $applications->count(),
            'aktif'    => $applications->whereIn('status', JobApplication::ACTIVE)->count(),
            'diterima' => $applications->where('status', 'diterima')->count(),
            'ditolak'  => $applications->where('status', 'ditolak')->count(),
        ];
    }

    private function history(): array
    {
        return collect(Storage::files(self::DIR))
            ->map(fn ($path) => [
                'name' => basename($path),
                'time' => Carbon::createFromTimestamp(Storage::lastModified($path)),
                'size' => Storage::size($path),
            ])
            ->filter(fn ($f) => preg_match(self::NAME_PATTERN, $f['name']))
            ->sortByDesc(fn ($f) => $f['time']->timestamp)
            ->take(15)
            ->values()
            ->all();
    }

    public function index(Request $request)
    {
        $applications = $this->filtered($request)->get();

        return view('admin.report.index', [
            'summary'      => $this->summary($applications),
            'applications' => $applications,
            'history'      => $this->history(),
        ]);
    }

    // Cetak Laporan: buat file CSV BARU dari data terkini, simpan ke arsip, lalu unduh
    public function export(Request $request)
    {
        $rows = $this->filtered($request)->get();
        $summary = $this->summary($rows);

        $filename = 'laporan-rekrutmen-' . now()->format('Ymd-His') . '.csv';

        $out = fopen('php://temp', 'r+');
        fwrite($out, "\xEF\xBB\xBF"); // BOM agar Excel membaca UTF-8

        // Cegah formula injection saat dibuka di Excel/Sheets
        $safe = fn ($v) => preg_match('/^[=+\-@\t\r]/', (string) $v) ? "'" . $v : (string) $v;
        $put = fn (array $r) => fputcsv($out, $r, ';');

        $put(['LAPORAN REKRUTMEN - PT BACHRI SAMUDERA INDONESIA']);
        $put(['Dicetak pada', now()->format('d-m-Y H:i:s')]);
        $put(['Periode daftar', ($request->dari ?: 'awal') . ' s/d ' . ($request->sampai ?: 'sekarang')]);
        $put(['Filter status', self::STATUS_LABELS[$request->status] ?? 'Semua']);
        $put([]);
        $put(['RINGKASAN']);
        $put(['Total Pelamar', $summary['total']]);
        $put(['Aktif Seleksi', $summary['aktif']]);
        $put(['Diterima', $summary['diterima']]);
        $put(['Ditolak', $summary['ditolak']]);
        $put([]);
        $put(['No', 'Nama Pelamar', 'Email', 'No. Telepon', 'Posisi Dilamar', 'Tahap Terakhir', 'Status Akhir', 'Tanggal Daftar']);

        foreach ($rows as $i => $a) {
            $put([
                $i + 1,
                $safe($a->name),
                $safe($a->email),
                '="' . preg_replace('/\D/', '', (string) $a->phone) . '"', // jaga angka 0 di depan
                $safe($a->vacancy?->title ?? '-'),
                $a->stageLabel(),
                $a->finalStatusLabel(),
                $a->created_at->format('d-m-Y'),
            ]);
        }

        rewind($out);
        $path = self::DIR . '/' . $filename;
        Storage::put($path, stream_get_contents($out));
        fclose($out);

        return Storage::download($path, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    // Unduh ulang laporan lama dari arsip
    public function download(string $file)
    {
        abort_unless(preg_match(self::NAME_PATTERN, $file) && Storage::exists(self::DIR . '/' . $file), 404);

        return Storage::download(self::DIR . '/' . $file, $file, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function destroy(string $file)
    {
        abort_unless(preg_match(self::NAME_PATTERN, $file), 404);
        Storage::delete(self::DIR . '/' . $file);

        return back()->with('success', 'Arsip laporan dihapus.');
    }
}