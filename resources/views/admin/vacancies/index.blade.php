@extends('admin.layout')
@section('title', 'Kelola Lowongan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Lowongan Pekerjaan</h1>
    <a href="{{ route('admin.vacancies.create') }}" class="btn btn-dark">+ Tambah Lowongan</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Posisi</th><th>Tipe</th><th>Batas</th><th>Status</th><th>Pelamar</th><th class="text-end">Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($vacancies as $v)
                <tr>
                    <td>
                        <a href="{{ route('careers.show', $v) }}" target="_blank" class="fw-semibold text-decoration-none">{{ $v->title }}</a>
                        <div class="small text-muted">{{ $v->location }}</div>
                    </td>
                    <td>{{ $v->employment_type }}</td>
                    <td>{{ $v->deadline?->format('d M Y') ?? '-' }}</td>
                    <td>
                        @if($v->isOpen())<span class="badge text-bg-success">Dibuka</span>
                        @elseif(! $v->is_active)<span class="badge text-bg-secondary">Nonaktif</span>
                        @else<span class="badge text-bg-danger">Kedaluwarsa</span>@endif
                    </td>
                    <td><a href="{{ route('admin.applications.index', ['vacancy' => $v->id]) }}">{{ $v->applications_count }}</a></td>
                    <td class="text-end text-nowrap">
                        <form action="{{ route('admin.vacancies.toggle', $v) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-outline-secondary">{{ $v->is_active ? 'Sembunyikan' : 'Tampilkan' }}</button>
                        </form>
                        <a href="{{ route('admin.vacancies.edit', $v) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.vacancies.destroy', $v) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus lowongan ini beserta seluruh lamarannya?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada lowongan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection