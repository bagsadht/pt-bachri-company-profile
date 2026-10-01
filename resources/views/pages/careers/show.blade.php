@extends('layouts.app')

@section('title', $vacancy->title . ' - Karir PT Bachri Samudera Indonesia')

@section('content')
<style>
    .detail-wrap { max-width: 1020px; margin: 0 auto; padding: 2.5rem 1rem 5rem; }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        color: rgba(255,255,255,.65);
        text-decoration: none;
        font-size: .88rem;
        margin-bottom: 1.5rem;
        transition: color .2s;
    }
    .back-link:hover { color: #f1c40f; }

    .detail-header {
        background: linear-gradient(135deg, rgba(241,196,15,.08), rgba(255,255,255,.02));
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    .detail-title {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: clamp(1.6rem, 4.5vw, 2.4rem);
        line-height: 1.2;
        margin-bottom: 1rem;
    }
    .detail-dept { color: rgba(255,255,255,.55); font-size: .9rem; margin-bottom: 1rem; }

    .job-tag {
        display: inline-flex;
        align-items: center;
        font-size: .8rem;
        padding: .35rem .8rem;
        border-radius: 50px;
        background: rgba(241,196,15,.12);
        color: #f1c40f;
        font-weight: 600;
        margin: 0 .4rem .4rem 0;
    }
    .job-tag.muted { background: rgba(255,255,255,.07); color: rgba(255,255,255,.75); }

    .panel {
        background: rgba(255,255,255,.035);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 18px;
        padding: 1.75rem;
        margin-bottom: 1.25rem;
    }
    .panel h2 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #f1c40f;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .panel p, .panel li { color: rgba(255,255,255,.82); line-height: 1.75; font-size: .95rem; }
    .panel ul { padding-left: 0; margin: 0; list-style: none; }
    .panel ul li {
        padding-left: 1.6rem;
        position: relative;
        margin-bottom: .6rem;
    }
    .panel ul li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #f1c40f;
        font-weight: 700;
    }

    .apply-panel {
        position: sticky;
        top: 1.5rem;
    }
    .form-label { font-weight: 600; font-size: .85rem; color: rgba(255,255,255,.85); margin-bottom: .4rem; }
    .apply-input {
        background: rgba(255,255,255,.06) !important;
        border: 1px solid rgba(255,255,255,.15) !important;
        color: #fff !important;
        border-radius: 10px !important;
        padding: .65rem .9rem !important;
        font-size: .92rem !important;
    }
    .apply-input:focus { border-color: #f1c40f !important; box-shadow: 0 0 0 3px rgba(241,196,15,.2) !important; }
    .apply-input::placeholder { color: rgba(255,255,255,.4); }

    .file-drop {
        border: 1.5px dashed rgba(255,255,255,.25);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: border-color .2s, background .2s;
        cursor: pointer;
        position: relative;
    }
    .file-drop:hover { border-color: #f1c40f; background: rgba(241,196,15,.04); }
    .file-drop input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .file-drop-text { font-size: .85rem; color: rgba(255,255,255,.6); }
    .file-drop-text strong { color: #f1c40f; }

    .btn-apply {
        background: linear-gradient(135deg, #f1c40f, #e67e22);
        color: #0b131e;
        border: 0;
        border-radius: 50px;
        padding: .85rem 2rem;
        font-weight: 800;
        width: 100%;
        transition: all .3s;
        font-size: .95rem;
    }
    .btn-apply:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(241,196,15,.35); }
    .btn-apply:active { transform: translateY(0); }

    .alert-box { padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; font-weight: 500; color: #fff; font-size: .9rem; }
    .alert-ok { background: linear-gradient(135deg, #10b981, #059669); }
    .alert-err { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .closed-note {
        background: rgba(239,68,68,.1);
        border: 1px solid rgba(239,68,68,.35);
        border-radius: 12px;
        padding: 1.25rem;
        color: #fca5a5;
        text-align: center;
        font-size: .9rem;
    }

    @media (max-width: 991.98px) {
        .apply-panel { position: static; }
    }
    @media (max-width: 575.98px) {
        .detail-header { padding: 1.5rem; border-radius: 16px; }
        .panel { padding: 1.25rem; border-radius: 14px; }
    }
</style>

<section class="detail-wrap">
    <a href="{{ route('careers.index') }}" class="back-link">&larr; Semua lowongan</a>

    @if($vacancy->imageUrl())
        <img src="{{ $vacancy->imageUrl() }}" alt="{{ $vacancy->title }}"
             style="width:100%;max-height:320px;object-fit:cover;border-radius:20px;margin-bottom:1.5rem;">
    @endif

    <div class="detail-header">
        <h1 class="detail-title">{{ $vacancy->title }}</h1>
        
        @if($vacancy->department)<div class="detail-dept">{{ $vacancy->department }}</div>@endif
        <div>
            <span class="job-tag">{{ $vacancy->employment_type }}</span>
            <span class="job-tag muted">📍 {{ $vacancy->location }}</span>
            @if($vacancy->salary_range)<span class="job-tag muted">💰 {{ $vacancy->salary_range }}</span>@endif
            @if($vacancy->deadline)<span class="job-tag muted">🗓️ Batas: {{ $vacancy->deadline->translatedFormat('d F Y') }}</span>@endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert-box alert-ok">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-box alert-err">✕ {{ session('error') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="panel">
                <h2>📋 Deskripsi Pekerjaan</h2>
                <p class="mb-0">{!! nl2br(e($vacancy->description)) !!}</p>
            </div>
            <div class="panel mb-0">
                <h2>✅ Persyaratan</h2>
                <ul>
                    @foreach($vacancy->requirementList() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="panel apply-panel" id="lamar">
                <h2>📨 Lamar Posisi Ini</h2>

                @if(! $vacancy->isOpen())
                    <div class="closed-note">Lowongan ini sudah ditutup.</div>
                @else
                    @if($errors->any())
                        <div class="alert-box alert-err">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('careers.apply', $vacancy) }}#lamar" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control apply-input" value="{{ old('name') }}" maxlength="100" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control apply-input" value="{{ old('email') }}" maxlength="100" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="phone">No. Telepon / WhatsApp</label>
                                <input type="text" id="phone" name="phone" class="form-control apply-input" value="{{ old('phone') }}" maxlength="20" placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="cover_letter">Surat Lamaran <span class="text-white-50 fw-normal">(opsional)</span></label>
                            <textarea id="cover_letter" name="cover_letter" rows="3" maxlength="2000" class="form-control apply-input" placeholder="Ceritakan singkat mengapa Anda cocok untuk posisi ini">{{ old('cover_letter') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Unggah CV</label>
                            <label class="file-drop" id="fileDropLabel">
                                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required
                                       onchange="document.getElementById('fileName').textContent = this.files[0] ? this.files[0].name : 'Klik untuk memilih file'">
                                <div class="file-drop-text" id="fileName"><strong>Klik untuk memilih file</strong></div>
                            </label>
                            <small class="text-white-50 d-block mt-1">PDF, DOC, atau DOCX. Maksimal 2 MB.</small>
                        </div>
                        <button type="submit" class="btn-apply">Kirim Lamaran</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
@endsection