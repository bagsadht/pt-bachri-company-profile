@extends('admin.layout')
@section('title', 'Proses Seleksi')

@section('content')
<div class="mb-3">
    <h1 class="page-title">Pipeline Kualifikasi &amp; Seleksi</h1>
    <p class="page-sub">Kelola dan tentukan kelulusan kandidat di setiap tahapan kualifikasi.</p>
</div>

<div class="d-flex gap-2 mb-3">
    <a href="{{ route('admin.selection.index') }}" class="chip {{ $tahap === 'interview' ? 'on' : '' }}">1. Interview &amp; Tes</a>
    <a href="{{ route('admin.selection.index', ['tahap' => 'final']) }}" class="chip {{ $tahap === 'final' ? 'on' : '' }}">2. Tahap Final</a>
</div>

<div class="box overflow-hidden">
    <div class="table-responsive">
        <table class="table tbl">
            <thead><tr><th>Kandidat</th><th>Posisi</th><th>Tahap Sekarang</th><th class="text-center">Keputusan</th></tr></thead>
            <tbody>
            @forelse($applications as $a)
                <tr>
                    <td class="fw-bold">{{ $a->name }}</td>
                    <td class="text-muted">{{ $a->vacancy->title }}</td>
                    <td><span class="pill yellow">{{ $a->stageLabel() }}</span></td>
                    <td class="text-center text-nowrap">
                        <form action="{{ route('admin.selection.decide', $a) }}" method="POST" class="d-inline">
                            @csrf <input type="hidden" name="keputusan" value="lolos">
                            <button class="btn-s green" style="border-radius:50px;"><i class="fa-solid fa-check"></i> Loloskan</button>
                        </form>
                        <form action="{{ route('admin.selection.decide', $a) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Nyatakan {{ e($a->name) }} gugur?')">
                            @csrf <input type="hidden" name="keputusan" value="gugur">
                            <button class="btn-s red" style="border-radius:50px;">Gugur</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty">Belum ada kandidat di tahap ini.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection