@extends('admin.layout')
@section('title', $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan')

@section('content')
<h1 class="h4 mb-3">{{ $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan' }}</h1>

<form method="POST" class="card card-body" enctype="multipart/form-data"
      action="{{ $vacancy->exists ? route('admin.vacancies.update', $vacancy) : route('admin.vacancies.store') }}">
    @csrf
    @if($vacancy->exists) @method('PUT') @endif


        <div class="col-12">
            <label class="form-label">Foto Lowongan</label>
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
            <label class="form-label">Judul Posisi *</label>
            
    <div class="row g-3">
        <div class="col-md-8">
            <label class="form-label">Judul Posisi *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $vacancy->title) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Departemen</label>
            <input type="text" name="department" class="form-control" value="{{ old('department', $vacancy->department) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Lokasi *</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $vacancy->location) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tipe Pekerjaan *</label>
            <select name="employment_type" class="form-select" required>
                @foreach(\App\Models\JobVacancy::EMPLOYMENT_TYPES as $type)
                    <option value="{{ $type }}" @selected(old('employment_type', $vacancy->employment_type) === $type)>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Kisaran Gaji</label>
            <input type="text" name="salary_range" class="form-control" placeholder="mis. Rp 5–7 juta" value="{{ old('salary_range', $vacancy->salary_range) }}">
        </div>
        <div class="col-12">
            <label class="form-label">Deskripsi Pekerjaan *</label>
            <textarea name="description" rows="5" class="form-control" required>{{ old('description', $vacancy->description) }}</textarea>
        </div>
        <div class="col-12">
            <label class="form-label">Persyaratan * <span class="text-muted small">(satu persyaratan per baris)</span></label>
            <textarea name="requirements" rows="6" class="form-control" required>{{ old('requirements', $vacancy->requirements) }}</textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label">Batas Lamaran</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $vacancy->deadline?->format('Y-m-d')) }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                       @checked(old('is_active', $vacancy->is_active))>
                <label class="form-check-label" for="is_active">Tampilkan di situs</label>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button class="btn btn-dark">Simpan</button>
        <a href="{{ route('admin.vacancies.index') }}" class="btn btn-link">Batal</a>
    </div>
</form>
@endsection