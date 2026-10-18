@extends('admin.layout')
@section('title', 'Daftar Lowongan')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <h1 class="page-title">Daftar Lowongan</h1>
        <p class="page-sub">Seluruh lowongan yang dikelola Admin (hanya untuk dilihat).</p>
    </div>

    <form method="GET" action="{{ route('hrd.vacancies.index') }}" class="d-flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}"
               class="form-control form-control-sm"
               placeholder="Cari posisi / lokasi...">
        <button type="submit" class="btn-s green">
            <i class="fa-solid fa-magnifying-glass"></i> Cari
        </button>
        @if(request('q'))
            <a href="{{ route('hrd.vacancies.index') }}" class="btn-s gray">Reset</a>
        @endif
    </form>
</div>

<div class="box">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Posisi</th>
                    <th>Departemen</th>
                    <th>Lokasi</th>
                    <th>Tipe</th>
                    <th>Batas Waktu</th>
                    <th>Status</th>
                    <th class="text-center">Pelamar</th>
                </tr>
            </thead>
            <tbody>
            @forelse($vacancies as $v)
                <tr>
                    <td class="ps-4 fw-semibold">{{ $v->judul }}</td>
                    <td>{{ $v->departemen ?? '-' }}</td>
                    <td>{{ $v->lokasi }}</td>
                    <td><span class="tag">{{ $v->jenis_pekerjaan }}</span></td>
                    <td>{{ $v->batas_lamaran?->format('d M Y') ?? '-' }}</td>
                    <td>
                        @if($v->isOpen())
                            <span class="pill green">Aktif</span>
                        @elseif(! $v->aktif)
                            <span class="pill gray">Nonaktif</span>
                        @else
                            <span class="pill orange">Kedaluwarsa</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('hrd.applicants.index', ['q' => $v->judul]) }}" class="btn-s">
                            <i class="fa-solid fa-user-group"></i> {{ $v->applications_count }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        Belum ada lowongan.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $vacancies->links() }}</div>
@endsection