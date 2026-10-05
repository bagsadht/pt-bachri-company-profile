@extends('admin.layout')
@section('title', $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan')

@section('content')
<div class="mb-4">
    <h1 class="page-title">{{ $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan' }}</h1>
    <p class="page-sub">Lengkapi informasi lowongan yang akan tampil di situs karir.</p>
</div>

<form method="POST" class="box p-4" enctype="multipart/form-data"
      action="{{ $vacancy->exists ? route('admin.vacancies.update', $vacancy) : route('admin.vacancies.store') }}">
    @csrf
    @if($vacancy->exists) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-12">
            <label class="form-label small fw-semibold">Foto Lowongan</label>
            @if($vacancy->image_path)
                <div class="mb-2">
                    <img src="{{ $vacancy->imageUrl() }}" alt="Foto lowongan" style="max-width:220px;border-radius:10px;" class="d-block mb-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remove_image" name="remove_image" value="1">
                        <label class="form-check-label small text-danger" for="remove_image">Hapus foto ini</label>
                    </div>
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            <small class="text-muted">JPG, PNG, atau WEBP. Maksimal 2 MB. Rasio landscape (mis. 800x500) hasilnya paling rapi.</small>
        </div>

        <div class="col-md-8">
            <label class="form-label small fw-semibold">Judul Posisi *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $vacancy->title) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-semibold">Departemen</label>
            <input type="text" name="department" class="form-control" value="{{ old('department', $vacancy->department) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-semibold">Lokasi *</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $vacancy->location) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-semibold">Tipe Pekerjaan *</label>
            <select name="employment_type" class="form-select" required>
                @foreach(\App\Models\JobVacancy::EMPLOYMENT_TYPES as $type)
                    <option value="{{ $type }}" @selected(old('employment_type', $vacancy->employment_type) === $type)>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-semibold">Kisaran Gaji</label>
            <input type="text" name="salary_range" class="form-control" placeholder="mis. Rp 5–7 juta" value="{{ old('salary_range', $vacancy->salary_range) }}">
        </div>
        <div class="col-12">
            <label class="form-label small fw-semibold">Deskripsi Pekerjaan *</label>
            <textarea name="description" rows="5" class="form-control" required>{{ old('description', $vacancy->description) }}</textarea>
        </div>
        <div class="col-12">
            <label class="form-label small fw-semibold">Persyaratan * <span class="text-muted fw-normal">(satu persyaratan per baris)</span></label>
            <textarea name="requirements" rows="6" class="form-control" required>{{ old('requirements', $vacancy->requirements) }}</textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-semibold">Batas Lamaran</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $vacancy->deadline?->format('Y-m-d')) }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @checked(old('is_active', $vacancy->is_active))>
                <label class="form-check-label small" for="is_active">Tampilkan di situs</label>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button class="btn-s green" style="padding:.5rem 1.2rem;font-size:.8rem;"><i class="fa-solid fa-check"></i> Simpan</button>
        <a href="{{ route('admin.vacancies.index') }}" class="btn-s gray" style="padding:.5rem 1.2rem;font-size:.8rem;">Batal</a>
    </div>
</form>
@endsection