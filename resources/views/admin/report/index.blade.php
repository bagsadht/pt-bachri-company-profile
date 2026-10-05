@extends('admin.layout')
@section('title', 'Rekap & Analisis')

@section('content')
<style>
    .stat { display:block; background:#fff; border:2px solid var(--c); border-radius:14px; padding:1rem 1.2rem; height:100%; }
    .stat small { font-size:.72rem; font-weight:700; text-transform:uppercase; color:#334155; }
    .stat .num { font-size:2rem; font-weight:800; line-height:1.15; }
</style>

<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
    <div>
        <h1 class="page-title">Rekap &amp; Laporan Rekrutmen</h1>
        <p class="page-sub">Ringkasan performa rekrutmen dan rekapitulasi data seluruh pelamar.</p>
    </div>
    <a href="{{ route('admin.report.export', request()->query()) }}" class="btn btn-dark btn-sm fw-semibold" style="border-radius:50px;padding:.5rem 1.1rem;font-size:.78rem;">
        <i class="fa-solid fa-file-csv me-1"></i> Cetak Laporan (CSV)
    </a>
</div>

{{-- Filter laporan --}}
<form method="GET" class="box p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-6 col-md-3">
            <label class="form-label small fw-semibold mb-1">Daftar dari tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}" class="form-control form-control-sm">
        </div>
        <div class="col-6 col-md-3">
            <label class="form-label small fw-semibold mb-1">Sampai tanggal</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}" class="form-control form-control-sm">
        </div>
        <div class="col-6 col-md-3">
            <label class="form-label small fw-semibold mb-1">Status akhir</label>
            <select name="status" class="form-select form-select-sm">
                <option value="">Semua</option>
                <option value="aktif" @selected(request('status') === 'aktif')>Aktif Seleksi</option>
                <option value="diterima" @selected(request('status') === 'diterima')>Diterima</option>
                <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
            </select>
        </div>
        <div class="col-6 col-md-3 d-flex gap-2">
            <button class="btn btn-primary btn-sm px-3"><i class="fa-solid fa-filter me-1"></i> Terapkan</button>
            <a href="{{ route('admin.report.index') }}" class="btn btn-outline-secondary btn-sm px-3">Reset</a>
        </div>
    </div>
    <div class="text-muted mt-2" style="font-size:.72rem;">Filter ini juga dipakai saat Cetak Laporan. Setiap cetak membuat file CSV baru dari data terkini.</div>
</form>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3"><div class="stat" style="--c:#0d6efd;"><small>Total Pelamar</small><div class="num">{{ $summary['total'] }}</div></div></div>
    <div class="col-6 col-lg-3"><div class="stat" style="--c:#ffc107;"><small>Aktif Seleksi</small><div class="num">{{ $summary['aktif'] }}</div></div></div>
    <div class="col-6 col-lg-3"><div class="stat" style="--c:#198754;"><small>Diterima</small><div class="num">{{ $summary['diterima'] }}</div></div></div>
    <div class="col-6 col-lg-3"><div class="stat" style="--c:#dc3545;"><small>Ditolak</small><div class="num">{{ $summary['ditolak'] }}</div></div></div>
</div>

<div class="box p-3 mb-4">
    <div class="fw-bold small mb-2">Distribusi Hasil Rekrutmen</div>
    <div style="position:relative;height:280px;max-width:520px;margin:0 auto;"><canvas id="donut"></canvas></div>
</div>

{{-- Riwayat laporan yang pernah dicetak --}}
<div class="box overflow-hidden mb-4">
    <div class="d-flex justify-content-between align-items-center px-3 py-3">
        <div class="fw-bold small"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>Riwayat Laporan</div>
        <span class="text-muted" style="font-size:.72rem;">15 laporan terakhir</span>
    </div>
    <div class="table-responsive">
        <table class="table tbl">
            <thead><tr><th>Nama File</th><th>Dicetak Pada</th><th>Ukuran</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
            @forelse($history as $f)
                <tr>
                    <td class="fw-semibold"><i class="fa-solid fa-file-csv text-success me-2"></i>{{ $f['name'] }}</td>
                    <td class="text-muted">{{ $f['time']->format('d M Y H:i') }}</td>
                    <td class="text-muted">{{ number_format($f['size'] / 1024, 1) }} KB</td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('admin.report.download', $f['name']) }}" class="btn-s"><i class="fa-solid fa-download"></i> Unduh</a>
                        <form action="{{ route('admin.report.destroy', $f['name']) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus arsip laporan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn-s red" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty">Belum ada laporan yang dicetak.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="box overflow-hidden">
    <div class="d-flex justify-content-between align-items-center px-3 py-3">
        <div class="fw-bold small"><i class="fa-solid fa-user-group text-primary me-2"></i>Semua Daftar Pelamar</div>
        <span class="pill" style="background:#0d6efd;color:#fff;">{{ $summary['total'] }} Orang</span>
    </div>
    <div class="table-responsive">
        <table class="table tbl">
            <thead><tr><th>No</th><th>Nama Pelamar</th><th>Posisi Dilamar</th><th>Tahap Terakhir</th><th>Status Akhir</th><th>Tanggal Daftar</th></tr></thead>
            <tbody>
            @forelse($applications as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $a->name }}</td>
                    <td><span class="tag">{{ $a->vacancy->title }}</span></td>
                    <td class="text-muted">{{ $a->stageLabel() }}</td>
                    <td>
                        @if($a->status === 'diterima')<span class="pill green">Diterima</span>
                        @elseif($a->status === 'ditolak')<span class="pill red">Ditolak</span>
                        @else<span class="pill yellow">Aktif Seleksi</span>@endif
                    </td>
                    <td class="text-muted">{{ $a->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">Tidak ada data pelamar untuk filter ini.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const vals = [{{ $summary['aktif'] }}, {{ $summary['diterima'] }}, {{ $summary['ditolak'] }}];
    const sum = vals.reduce((a, b) => a + b, 0) || 1;
    new Chart(document.getElementById('donut'), {
        type: 'doughnut',
        data: { labels: ['Aktif Seleksi', 'Diterima', 'Ditolak'], datasets: [{ data: vals, backgroundColor: ['#f59e0b', '#10b981', '#ef4444'], borderWidth: 0 }] },
        options: { maintainAspectRatio: false, cutout: '45%', plugins: { legend: { position: 'top', labels: { boxWidth: 28, boxHeight: 10, font: { size: 11 } } } } },
        plugins: [{ id: 'pct', afterDatasetsDraw(c) {
            c.getDatasetMeta(0).data.forEach((arc, i) => {
                if (!vals[i]) return;
                const p = arc.tooltipPosition(), x = c.ctx;
                x.save(); x.fillStyle = '#fff'; x.font = 'bold 11px Plus Jakarta Sans'; x.textAlign = 'center'; x.textBaseline = 'middle';
                x.fillText((vals[i] / sum * 100).toFixed(1) + '%', p.x, p.y); x.restore();
            });
        } }]
    });
</script>
@endpush