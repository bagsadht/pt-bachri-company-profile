<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    private const DIR = 'laporan';
    // Mengizinkan file .csv lama dan .xls baru
    private const NAME_PATTERN = '/^laporan-rekrutmen-\d{8}-\d{6}\.(csv|xls)$/';

    private const STATUS_LABELS = [
        'aktif'    => 'Aktif Seleksi',
        'diterima' => 'Diterima',
        'ditolak'  => 'Ditolak',
    ];

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

        return view('hrd.report.index', [
            'summary'      => $this->summary($applications),
            'applications' => $applications,
            'history'      => $this->history(),
        ]);
    }

    // Cetak Laporan: buat file Excel (.xls) dari HTML Table
    public function export(Request $request)
    {
        $rows = $this->filtered($request)->get();
        $summary = $this->summary($rows);

        $filename = 'laporan-rekrutmen-' . now()->format('Ymd-His') . '.xls';
        
        // CSS untuk Excel
        $style = '
        <style>
            table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 12px; }
            th { background-color: #0d6efd; color: white; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ddd; }
            td { padding: 8px; border: 1px solid #ddd; }
            .text-center { text-align: center; }
            .status-aktif { color: #d97706; font-weight: bold; }
            .status-diterima { color: #059669; font-weight: bold; }
            .status-ditolak { color: #dc2626; font-weight: bold; }
            .meta-table td { border: none; padding: 2px 10px 2px 0; font-size: 12px; }
        </style>';

        // Build HTML
        $html = '<html><head><meta charset="UTF-8">' . $style . '</head><body>';
        
        $html .= '<h2 style="font-family: Arial, sans-serif;">LAPORAN REKRUTMEN - PT BACHRI SAMUDERA INDONESIA</h2>';
        
        $html .= '<table class="meta-table" style="margin-bottom: 20px;">';
        $html .= '<tr><td><strong>Dicetak pada</strong></td><td>: ' . now()->format('d-m-Y H:i:s') . '</td></tr>';
        $html .= '<tr><td><strong>Periode daftar</strong></td><td>: ' . ($request->dari ?: 'awal') . ' s/d ' . ($request->sampai ?: 'sekarang') . '</td></tr>';
        $html .= '<tr><td><strong>Filter status</strong></td><td>: ' . (self::STATUS_LABELS[$request->status] ?? 'Semua') . '</td></tr>';
        $html .= '<tr><td><strong>Total Pelamar</strong></td><td>: ' . $summary['total'] . '</td></tr>';
        $html .= '<tr><td><strong>Aktif / Diterima / Ditolak</strong></td><td>: ' . $summary['aktif'] . ' / ' . $summary['diterima'] . ' / ' . $summary['ditolak'] . '</td></tr>';
        $html .= '</table>';

        $html .= '<table>';
        $html .= '<thead><tr>
                    <th width="40">No</th>
                    <th width="150">Nama Pelamar</th>
                    <th width="200">Email</th>
                    <th width="100">No. Telepon</th>
                    <th width="150">Posisi Dilamar</th>
                    <th width="120">Tahap Terakhir</th>
                    <th width="100">Status Akhir</th>
                    <th width="100">Tanggal Daftar</th>
                  </tr></thead><tbody>';

        foreach ($rows as $i => $a) {
            // Menentukan warna teks status
            $statusClass = '';
            if (in_array($a->status, JobApplication::ACTIVE)) {
                $statusClass = 'status-aktif';
            } elseif ($a->status === 'diterima') {
                $statusClass = 'status-diterima';
            } elseif ($a->status === 'ditolak') {
                $statusClass = 'status-ditolak';
            }

            // Trik mso-number-format agar nomor HP tidak kehilangan angka 0 di depan
            $telepon = ' style="mso-number-format:\'\\@\';"';

            $html .= '<tr>
                        <td class="text-center">' . ($i + 1) . '</td>
                        <td>' . htmlspecialchars($a->nama) . '</td>
                        <td>' . htmlspecialchars($a->email) . '</td>
                        <td' . $telepon . '>' . htmlspecialchars($a->telepon) . '</td>
                        <td>' . htmlspecialchars($a->vacancy?->judul ?? '-') . '</td>
                        <td>' . $a->stageLabel() . '</td>
                        <td class="' . $statusClass . '">' . $a->finalStatusLabel() . '</td>
                        <td class="text-center">' . $a->created_at->format('d/m/Y') . '</td>
                      </tr>';
        }

        $html .= '</tbody></table></body></html>';

        // Simpan ke storage
        $path = self::DIR . '/' . $filename;
        Storage::put($path, $html);

        // Download
        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function download(string $file)
    {
        abort_unless(preg_match(self::NAME_PATTERN, $file) && Storage::exists(self::DIR . '/' . $file), 404);

        $contentType = str_ends_with($file, '.xls') ? 'application/vnd.ms-excel' : 'text/csv; charset=UTF-8';
        
        return Storage::download(self::DIR . '/' . $file, $file, ['Content-Type' => $contentType]);
    }

    public function destroy(string $file)
    {
        abort_unless(preg_match(self::NAME_PATTERN, $file), 404);
        Storage::delete(self::DIR . '/' . $file);

        return back()->with('success', 'Arsip laporan dihapus.');
    }
}