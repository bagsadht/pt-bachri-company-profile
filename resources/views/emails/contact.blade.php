@extends('layouts.app')

@section('title', 'Hubungi Kami - PT Bachri Samudera Indonesia')

@section('content')

<style>
    /* ==================== FONTS ==================== */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,500;1,500&display=swap');

    .contact-page { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; }
    .font-display { font-family: 'Outfit', sans-serif; letter-spacing: -0.03em; }
    .font-serif { font-family: 'Cormorant Garamond', serif; }

    /* ==================== HERO HEADER ==================== */
    .contact-hero {
        position: relative;
        width: 100%;
        min-height: 60vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #0b131e;
    }

    .contact-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 0;
    }

    .contact-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, 
            rgba(11, 19, 30, 0.95) 0%, 
            rgba(11, 19, 30, 0.75) 50%, 
            rgba(11, 19, 30, 0.4) 100%);
        z-index: 1;
    }

    .contact-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 9rem 0 5rem;
    }

    .contact-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 1.5rem;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.35em;
        color: #f1c40f;
        text-transform: uppercase;
    }

    .contact-hero-eyebrow::before {
        content: '';
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #f1c40f);
    }

    .contact-hero-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 5rem;
        line-height: 1;
        letter-spacing: -0.04em;
        color: #ffffff;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    }

    .contact-hero-title .accent {
        background: linear-gradient(135deg, #f1c40f 0%, #f39c12 50%, #e67e22 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-hero-subtitle {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 1.3rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        max-width: 620px;
    }

    /* ==================== CONTACT SECTION ==================== */
    .contact-section {
        padding: 6rem 0;
        background: #fafafa;
        position: relative;
    }

    .contact-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(11, 19, 30, 0.04) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
    }

    .contact-container {
        position: relative;
        z-index: 2;
        max-width: 1280px;
        margin: 0 auto;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 3rem;
        align-items: start;
    }

    /* ==================== INFO KONTAK (KIRI) ==================== */
    .contact-info-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 3rem 2.5rem;
        border: 1px solid #eef0f3;
        box-shadow: 0 10px 30px -15px rgba(11, 19, 30, 0.1);
    }

    .contact-info-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.75rem;
        color: #0b131e;
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
    }

    .contact-info-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        line-height: 1.7;
        color: #64748b;
        margin-bottom: 2.5rem;
    }

    .contact-info-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        padding: 1.25rem;
        border-radius: 16px;
        background: #fafafa;
        border: 1px solid #f0f0f0;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .contact-info-item:hover {
        background: #ffffff;
        border-color: rgba(212, 160, 23, 0.3);
        transform: translateX(4px);
        box-shadow: 0 10px 25px -15px rgba(212, 160, 23, 0.3);
    }

    .contact-info-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #f1c40f 0%, #e67e22 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px -8px rgba(212, 160, 23, 0.5);
    }

    .contact-info-icon svg {
        width: 22px;
        height: 22px;
        color: #ffffff;
    }

    .contact-info-label {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.75rem;
        letter-spacing: 0.15em;
        color: #94a3b8;
        text-transform: uppercase;
        margin-bottom: 0.35rem;
    }

    .contact-info-value {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 0.98rem;
        line-height: 1.6;
        color: #0b131e;
    }

    /* ==================== FORM (KANAN) ==================== */
    .contact-form-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 3rem 2.5rem;
        border: 1px solid #eef0f3;
        box-shadow: 0 10px 30px -15px rgba(11, 19, 30, 0.1);
    }

    .contact-form-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.75rem;
        color: #0b131e;
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
    }

    .contact-form-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        line-height: 1.7;
        color: #64748b;
        margin-bottom: 2.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.85rem;
        color: #0b131e;
        margin-bottom: 0.5rem;
        letter-spacing: 0.02em;
    }

    .form-control {
        width: 100%;
        padding: 0.9rem 1.15rem;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        color: #0b131e;
        background: #ffffff;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-control::placeholder {
        color: #cbd5e1;
    }

    .form-control:focus {
        border-color: #d4a017;
        box-shadow: 0 0 0 4px rgba(212, 160, 23, 0.1);
    }

    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #d4a017 0%, #e67e22 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.02em;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 10px 30px -10px rgba(212, 160, 23, 0.5);
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 45px -10px rgba(212, 160, 23, 0.7);
    }

    .btn-submit svg {
        transition: transform 0.3s ease;
    }

    .btn-submit:hover svg {
        transform: translateX(4px);
    }

    /* ==================== ALERT ==================== */
    .alert-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 30px -10px rgba(16, 185, 129, 0.4);
    }

    .alert-error {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .alert-error ul {
        margin: 0.5rem 0 0 0;
        padding-left: 1.25rem;
    }

    /* ==================== ALERT AUTO-DISMISS ==================== */
    .alert-auto {
        overflow: hidden;
        transition: opacity 0.5s ease, max-height 0.5s ease,
                    margin 0.5s ease, padding 0.5s ease,
                    transform 0.5s ease;
    }
    .alert-auto.is-hidden {
        opacity: 0 !important;
        max-height: 0 !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        transform: translateY(-8px);
    }

    /* ==================== MAP ==================== */
    .map-section {
        padding: 0 0 5rem;
        background: #fafafa;
    }

    .map-wrapper {
        position: relative;
        width: 100%;
        height: 450px;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 60px -25px rgba(11, 19, 30, 0.3);
        border: 1px solid #eef0f3;
    }

    .map-wrapper iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 991.98px) {
        .contact-hero { min-height: 50vh; }
        .contact-hero-title { font-size: 3.5rem; }
        .contact-hero-subtitle { font-size: 1.1rem; }
        .contact-hero-inner { padding: 7rem 0 4rem; }

        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .contact-info-card,
        .contact-form-card {
            padding: 2rem 1.75rem;
        }

        .map-wrapper {
            height: 350px;
        }
    }

    @media (max-width: 640px) {
        .contact-hero { min-height: 45vh; }
        .contact-hero-title { font-size: 2.5rem; }
        .contact-hero-subtitle { font-size: 1rem; }
        .contact-hero-inner { padding: 6rem 0 3rem; }

        .contact-section { padding: 4rem 0; }

        .contact-info-title,
        .contact-form-title {
            font-size: 1.4rem;
        }

        .contact-info-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
        }

        .contact-info-icon svg {
            width: 20px;
            height: 20px;
        }

        .map-section {
            padding: 0 0 3rem;
        }

        .map-wrapper {
            height: 280px;
            border-radius: 16px;
        }
    }
</style>

<div class="contact-page">

{{-- ==================== HERO HEADER ==================== --}}
<section class="contact-hero">
    
    <img src="{{ asset('images/tentangkami1.jpeg') }}" 
         alt="Hubungi Kami PT Bachri Samudera Indonesia" 
         class="contact-hero-bg">

    <div class="contact-hero-overlay"></div>

    <div class="contact-hero-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <div class="contact-hero-eyebrow">
                Hubungi Kami
            </div>

            <h1 class="contact-hero-title">
                Mari <span class="accent">Berkolaborasi</span>
            </h1>

            <p class="contact-hero-subtitle">
                Punya proyek atau ide? Tim kami siap membantu mewujudkannya menjadi kenyataan. Hubungi kami sekarang!
            </p>

        </div>
    </div>

</section>

{{-- ==================== CONTACT SECTION ==================== --}}
<section class="contact-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="contact-container">
            
            <div class="contact-grid">
                
                {{-- ===== KIRI: INFO KONTAK ===== --}}
                <div class="contact-info-card" data-aos="fade-right">
                    
                    <h2 class="contact-info-title">Informasi Kontak</h2>
                    <p class="contact-info-desc">
                        Silakan hubungi kami melalui salah satu kanal di bawah ini. Kami akan merespons secepat mungkin.
                    </p>

                    <div class="contact-info-list">
                        
                        {{-- Telepon --}}
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="contact-info-label">Telepon</p>
                                <p class="contact-info-value">0817 1414 1802</p>
                                <p class="contact-info-value">0821 2451 2741</p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="contact-info-label">Email</p>
                                <p class="contact-info-value">bachrisamuderaindonesia@gmail.com</p>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="contact-info-label">Alamat</p>
                                <p class="contact-info-value">
                                    RensJaya Office, Jl. Kenari XIV, 12,<br>
                                    Panulisan Barat, Pamulang,<br>
                                    Tangerang Selatan
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- ===== KANAN: FORM KONTAK ===== --}}
                <div class="contact-form-card" data-aos="fade-left">
                    
                    <h2 class="contact-form-title">Kirim Pesan</h2>
                    <p class="contact-form-desc">
                        Isi formulir di bawah ini dan kami akan menghubungi Anda kembali.
                    </p>

                    {{-- Alert Sukses --}}
                    @if(session('success'))
                        <div id="contact-alert-success" class="alert-success alert-auto">
                            ✓ {{ session('success') }}
                        </div>
                        <script>
                            (function () {
                                var el = document.getElementById('contact-alert-success');
                                if (!el) return;
                                setTimeout(function () {
                                    el.classList.add('is-hidden');
                                    setTimeout(function () {
                                        if (el.parentNode) el.parentNode.removeChild(el);
                                    }, 600);
                                }, 4000);
                            })();
                        </script>
                    @endif

                    {{-- Alert Error email --}}
                    @if(session('error'))
                        <div id="contact-alert-error" class="alert-error alert-auto">
                            ✕ {{ session('error') }}
                        </div>
                        <script>
                            (function () {
                                var el = document.getElementById('contact-alert-error');
                                if (!el) return;
                                setTimeout(function () {
                                    el.classList.add('is-hidden');
                                    setTimeout(function () {
                                        if (el.parentNode) el.parentNode.removeChild(el);
                                    }, 600);
                                }, 6000);
                            })();
                        </script>
                    @endif

                    {{-- Alert Error validasi --}}
                    @if($errors->any())
                        <div id="contact-alert-validation" class="alert-error alert-auto">
                            <strong>Mohon periksa kembali:</strong>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <script>
                            (function () {
                                var el = document.getElementById('contact-alert-validation');
                                if (!el) return;
                                setTimeout(function () {
                                    el.classList.add('is-hidden');
                                    setTimeout(function () {
                                        if (el.parentNode) el.parentNode.removeChild(el);
                                    }, 600);
                                }, 6000);
                            })();
                        </script>
                    @endif

                    {{-- FORM - Pastikan route name cocok dengan web.php --}}
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama') }}"
                                   placeholder="Masukkan nama Anda" 
                                   required>
                        </div>

                        {{-- ✅ FIELD BARU: No. Telepon (hanya angka) --}}
                        <div class="form-group">
                            <label class="form-label" for="no_telpon">No. Telepon</label>
                            <input type="tel" 
                                   class="form-control" 
                                   id="no_telpon" 
                                   name="no_telpon" 
                                   value="{{ old('no_telpon') }}"
                                   placeholder="Contoh: 0812 3456 7890"
                                   inputmode="numeric"
                                   pattern="[0-9+\-\s]*"
                                   maxlength="20"
                                   oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   0 
                                   value="{{ old('email') }}"
                                   placeholder="nama@email.com" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="pesan">Pesan</label>
                            <textarea class="form-control" 
                                      id="pesan" 
                                      name="pesan" 
                                      placeholder="Tulis pesan Anda di sini..." 
                                      required>{{ old('pesan') }}</textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            Kirim Pesan
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>

{{-- ==================== MAP ==================== --}}
<section class="map-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="map-wrapper" data-aos="fade-up">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.839855295194!2d106.74293431476996!3d-6.287677395450875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f0000000000%3A0x0!2sPamulang%2C%20Tangerang%20Selatan!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

</div>

@endsection