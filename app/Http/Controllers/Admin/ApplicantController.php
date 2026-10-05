<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(Request $request)
    {
        $filter = in_array($request->query('filter'), ['lolos', 'gagal'], true) ? $request->query('filter') : 'semua';
        $q = trim((string) $request->query('q'));

        $query = JobApplication::with('vacancy')->latest();

        if ($filter === 'lolos') $query->where('status', 'diterima');
        if ($filter === 'gagal') $query->where('status', 'ditolak');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhereHas('vacancy', fn ($v) => $v->where('title', 'like', "%{$q}%"));
            });
        }

        return view('admin.applicants.index', [
            'applications' => $query->paginate(20)->withQueryString(),
            'filter'       => $filter,
            'q'            => $q,
            'counts'       => [
                'semua' => JobApplication::count(),
                'lolos' => JobApplication::where('status', 'diterima')->count(),
                'gagal' => JobApplication::where('status', 'ditolak')->count(),
            ],
        ]);
    }
}