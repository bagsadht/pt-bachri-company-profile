<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    // UC-12: HRD hanya melihat daftar lowongan (tanpa tambah/edit/hapus)
    public function index(Request $request)
    {
        $vacancies = JobVacancy::withCount('applications')
            ->when($request->q, fn ($query, $s) => $query->where(
                fn ($w) => $w->where('judul', 'like', "%{$s}%")
                             ->orWhere('departemen', 'like', "%{$s}%")
                             ->orWhere('lokasi', 'like', "%{$s}%")
            ))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('hrd.vacancies.index', compact('vacancies'));
    }
}