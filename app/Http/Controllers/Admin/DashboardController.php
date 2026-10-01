<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobVacancy;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'open_vacancies'     => JobVacancy::open()->count(),
            'total_vacancies'    => JobVacancy::count(),
            'new_applications'   => JobApplication::where('status', 'baru')->count(),
            'total_applications' => JobApplication::count(),
            'this_month'         => JobApplication::where('created_at', '>=', now()->startOfMonth())->count(),
        ];

         // Perbandingan lamaran minggu ini vs minggu lalu, untuk indikator tren
        $thisWeekCount = JobApplication::where('created_at', '>=', now()->startOfWeek())->count();
        $lastWeekCount = JobApplication::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek(),
        ])->count();
        $weeklyTrend = $lastWeekCount > 0
            ? round((($thisWeekCount - $lastWeekCount) / $lastWeekCount) * 100)
            : ($thisWeekCount > 0 ? 100 : 0);

        // Jumlah lamaran per status (semua status selalu muncul, meski 0)
        $byStatus = JobApplication::selectRaw('status, count(*) as total')
            ->groupBy('status')->pluck('total', 'status');
        $statusCounts = [];
        foreach (JobApplication::STATUSES as $key => $label) {
            $statusCounts[$key] = ['label' => $label, 'total' => (int) ($byStatus[$key] ?? 0)];
        }

        // Lamaran 7 hari terakhir
        $perDay = JobApplication::where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->get(['created_at'])
            ->groupBy(fn ($a) => $a->created_at->format('Y-m-d'));
        $chart = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $chart[] = [
                'label' => $day->translatedFormat('D'),
                'total' => $perDay->get($day->format('Y-m-d'))?->count() ?? 0,
            ];
        }

        $recentApplications = JobApplication::with('vacancy')->latest()->take(8)->get();

        $vacancies = JobVacancy::withCount([
            'applications',
            'applications as new_applications_count' => fn ($q) => $q->where('status', 'baru'),
        ])->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'statusCounts', 'chart', 'recentApplications', 'vacancies', 'weeklyTrend'));
    }
}