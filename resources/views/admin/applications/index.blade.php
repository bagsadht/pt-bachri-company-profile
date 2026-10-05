@extends('admin.layout')
@section('title', 'Kontak Masuk')

@section('content')
<div class="mb-4">
    <h1 class="page-title"><i class="fa-solid fa-inbox text-primary me-2" style="font-size:1.05rem;"></i>Lamaran Baru / Masuk</h1>
    <p class="page-sub">Tinjau lamaran yang baru masuk, lalu proses ke tahap seleksi atau tolak.</p>
</div>

<div class="box overflow-hidden">
    <div class="table-responsive">
        <table class="table tbl">
            <thead><tr><th>Nama Pelamar</th><th>Posisi Lowongan</th><th>Tanggal Masuk</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
            @forelse($applications as $a)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $a->name }}</div>
                        <div class="text-muted" style="font-size:.72rem;">
                            <a href="mailto:{{ $a->email }}" class="text-muted">{{ $a->email }}</a> &middot;
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $a->phone)) }}" target="_blank" class="text-muted">{{ $a->phone }}</a>
                        </div>
                        @if($a->cover_letter)
                            <details class="text-muted mt-1" style="font-size:.72rem;"><summary>Surat lamaran</summary>{!! nl2br(e($a->cover_letter)) !!}</details>
                        @endif
                    </td>
                    <td><span class="tag">{{ $a->vacancy->title }}</span></td>
                    <td class="text-muted"><i class="fa-regular fa-clock me-1"></i>{{ $a->created_at->format('d M Y H:i') }}</td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('admin.applications.cv', $a) }}" class="btn-s"><i class="fa-regular fa-file-lines"></i> Berkas</a>
                        <form action="{{ route('admin.applications.update', $a) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="diproses">
                            <button class="btn-s green"><i class="fa-solid fa-check"></i> Proses</button>
                        </form>
                        <form action="{{ route('admin.applications.update', $a) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Tolak lamaran ini?')">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="ditolak">
                            <button class="btn-s red">Tolak</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty">Tidak ada lamaran baru yang masuk.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $applications->links('pagination::bootstrap-5') }}</div>
@endsection