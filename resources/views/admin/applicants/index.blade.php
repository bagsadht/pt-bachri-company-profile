@extends('admin.layout')
@section('title', 'Daftar Pelamar')

@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
    <div>
        <h1 class="page-title">Daftar Semua Pelamar</h1>
        <p class="page-sub">Arsip seluruh rekapitulasi data kandidat pelamar kerja.</p>
    </div>
    <form method="GET" class="d-flex gap-1">
        @if($filter !== 'semua')<input type="hidden" name="filter" value="{{ $filter }}">@endif
        <input type="text" name="q" value="{{ $q }}" class="form-control form-control-sm" placeholder="Cari nama, posisi..." style="width:190px;">
        <button class="btn btn-primary btn-sm px-3"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

<div class="d-flex gap-2 flex-wrap mb-3">
    <a href="{{ route('admin.applicants.index', array_filter(['q' => $q])) }}" class="chip {{ $filter === 'semua' ? 'on' : '' }}">Semua Pelamar <span class="n">{{ $counts['semua'] }}</span></a>
    <a href="{{ route('admin.applicants.index', array_filter(['filter' => 'lolos', 'q' => $q])) }}" class="chip {{ $filter === 'lolos' ? 'on green' : '' }}">Pelamar Lolos <span class="n">{{ $counts['lolos'] }}</span></a>
    <a href="{{ route('admin.applicants.index', array_filter(['filter' => 'gagal', 'q' => $q])) }}" class="chip {{ $filter === 'gagal' ? 'on red' : '' }}">Pelamar Tidak Lolos <span class="n">{{ $counts['gagal'] }}</span></a>
</div>

<div class="box overflow-hidden">
    <div class="table-responsive">
        <table class="table tbl">
            <thead><tr><th>No</th><th>Nama Pelamar</th><th>Posisi</th><th>Tahap Seleksi</th><th>Status</th><th class="text-center">Aksi</th></tr></thead>
            <tbody>
            @forelse($applications as $a)
                <tr>
                    <td>{{ $applications->firstItem() + $loop->index }}</td>
                    <td>
                        <div class="fw-bold">{{ $a->name }}</div>
                        <div class="text-muted" style="font-size:.72rem;"><i class="fa-regular fa-clock me-1"></i>{{ $a->created_at->format('d M Y') }}</div>
                    </td>
                    <td><span class="tag">{{ $a->vacancy->title }}</span></td>
                    <td class="text-muted">{{ $a->stageLabel() }}</td>
                    <td>
                        @if($a->status === 'diterima')<span class="pill green">Diterima</span>
                        @elseif($a->status === 'ditolak')<span class="pill red">Ditolak</span>
                        @else<span class="pill yellow">Aktif Seleksi</span>@endif
                    </td>
                    <td class="text-center text-nowrap">
                        <a href="{{ route('admin.applications.cv', $a) }}" class="btn-s"><i class="fa-regular fa-file-lines"></i> Berkas</a>
                        <form action="{{ route('admin.applications.destroy', $a) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus data pelamar ini?')">
                            @csrf @method('DELETE')
                            <button class="btn-s red" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">Tidak ada data pelamar.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $applications->links('pagination::bootstrap-5') }}</div>
@endsection