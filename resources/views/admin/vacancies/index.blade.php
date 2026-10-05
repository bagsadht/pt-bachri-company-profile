@extends('admin.layout')
@section('title', 'Kelola Lowongan')

@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
    <div>
        <h1 class="page-title">Kelola Lowongan</h1>
        <p class="page-sub">Tambah, ubah, dan atur tampilan lowongan di situs karir.</p>
    </div>
    <a href="{{ route('admin.vacancies.create') }}" class="btn-s green" style="padding:.5rem 1rem;font-size:.8rem;"><i class="fa-solid fa-plus"></i> Tambah Lowongan</a>
</div>

<div class="box overflow-hidden">
    <div class="table-responsive">
        <table class="table tbl">
            <thead><tr><th>Posisi</th><th>Tipe</th><th>Batas</th><th>Status</th><th>Pelamar</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
            @forelse($vacancies as $v)
                <tr>
                    <td>
                        <a href="{{ route('careers.show', $v) }}" target="_blank" class="fw-bold text-decoration-none text-dark">{{ $v->title }}</a>
                        <div class="text-muted" style="font-size:.72rem;">{{ $v->location }}</div>
                    </td>
                    <td><span class="tag">{{ $v->employment_type }}</span></td>
                    <td>{{ $v->deadline?->format('d M Y') ?? '-' }}</td>
                    <td>
                        @if($v->isOpen())<span class="pill green">Dibuka</span>
                        @elseif(! $v->is_active)<span class="pill gray">Nonaktif</span>
                        @else<span class="pill red">Kedaluwarsa</span>@endif
                    </td>
                    <td><a href="{{ route('admin.applicants.index', ['q' => $v->title]) }}" class="fw-semibold text-decoration-none">{{ $v->applications_count }}</a></td>
                    <td class="text-end text-nowrap">
                        <form action="{{ route('admin.vacancies.toggle', $v) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn-s gray">{{ $v->is_active ? 'Sembunyikan' : 'Tampilkan' }}</button>
                        </form>
                        <a href="{{ route('admin.vacancies.edit', $v) }}" class="btn-s"><i class="fa-solid fa-pen"></i> Edit</a>
                        <form action="{{ route('admin.vacancies.destroy', $v) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus lowongan ini beserta seluruh lamarannya?')">
                            @csrf @method('DELETE')
                            <button class="btn-s red" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">Belum ada lowongan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection