@extends('admin.layout')
@section('title', 'Lamaran Masuk')

@section('content')
<h1 class="h4 mb-3">Lamaran Masuk</h1>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="vacancy" class="form-select" onchange="this.form.submit()">
            <option value="">Semua posisi</option>
            @foreach($vacancies as $v)
                <option value="{{ $v->id }}" @selected(request('vacancy') == $v->id)>{{ $v->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">Semua status</option>
            @foreach(\App\Models\JobApplication::STATUSES as $key => $label)
                <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Pelamar</th><th>Posisi</th><th>Kontak</th><th>Masuk</th><th style="width:170px">Status</th><th class="text-end">Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($applications as $a)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $a->name }}</div>
                        @if($a->cover_letter)
                            <details class="small text-muted"><summary>Surat lamaran</summary>{!! nl2br(e($a->cover_letter)) !!}</details>
                        @endif
                    </td>
                    <td>{{ $a->vacancy->title }}</td>
                    <td class="small">
                        <a href="mailto:{{ $a->email }}">{{ $a->email }}</a><br>
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $a->phone)) }}" target="_blank">{{ $a->phone }}</a>
                    </td>
                    <td class="small">{{ $a->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.applications.update', $a) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach(\App\Models\JobApplication::STATUSES as $key => $label)
                                    <option value="{{ $key }}" @selected($a->status === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('admin.applications.cv', $a) }}" class="btn btn-sm btn-outline-primary">Unduh CV</a>
                        <form action="{{ route('admin.applications.destroy', $a) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus lamaran ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada lamaran.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $applications->links('pagination::bootstrap-5') }}</div>
@endsection