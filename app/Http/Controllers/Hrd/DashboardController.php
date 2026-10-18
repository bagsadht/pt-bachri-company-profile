<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobVacancy;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vacancies'  => JobVacancy::count(),
            'active_vacancies' => JobVacancy::where('aktif', true)
                                    ->where(function ($q) {
                                        $q->whereNull('batas_lamaran')
                                          ->orWhere('batas_lamaran', '>=', now());
                                    })->count(),
            'total_applicants' => JobApplication::count(),
            'new_applicants'   => JobApplication::where('status', 'baru')->count(),
            'hired'            => JobApplication::where('status', 'diterima')->count(),
            'rejected'         => JobApplication::where('status', 'ditolak')->count(),
        ];

        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $chartData[] = [
                'label' => $month->translatedFormat('M'),
                'count' => JobApplication::whereYear('created_at', $month->year)
                                          ->whereMonth('created_at', $month->month)
                                          ->count(),
            ];
        }

        $recentVacancies = JobVacancy::withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        $recentApplicants = JobApplication::with('vacancy')
            ->latest()
            ->take(5)
            ->get();

        return view('hrd.dashboard', compact(
            'stats',
            'chartData',
            'recentVacancies',
            'recentApplicants'
        ));
    }
}