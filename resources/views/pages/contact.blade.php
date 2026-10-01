@extends('layouts.app')

@section('title', 'Hubungi Kami - PT Bachri Samudera Indonesia')

@section('content')

<style>
    /* ==================== FONTS ==================== */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

    .contact-page { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; position: relative; }

    /* ==================== HERO HEADER ==================== */
    .contact-hero {
        position: relative;
        width: 100%;
        min-height: 100vh;
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
        object-position: 50% 15%;
        z-index: 0;
    }

    .contact-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, 
            rgba(11, 19, 30, 0.88) 0%, 
            rgba(11, 19, 30, 0.6) 50%, 
            rgba(11, 19, 30, 0.25) 100%);
        z-index: 1;
    }

    .contact-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 12rem 0 8rem;
    }

    .contact-hero-title-wrap {
        position: relative;
    }

    .contact-hero-title-wrap::before {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: #f1c40f;
        border-radius: 4px;
        margin-bottom: 1rem;
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
        display: inline-block;
        background: linear-gradient(135deg, #f1c40f 0%, #f39c12 50%, #e67e22 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-hero-subtitle {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 1.3rem;
        line-height: 1.5;
        color: #ffffff;
        max-width: 500px;
    }

    /* ==================== HUBUNGI & KANTOR KAMI (NYAMBUNG SATU BACKGROUND) ==================== */
    .unified-bg-section {
        position: relative;
        overflow: hidden;
        background-image: url("{{ asset('images/bgvisimisi.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .unified-bg-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(11, 19, 30, 0.75);
        z-index: 1;
    }

    /* ===== HUBUNGI SECTION ===== */
    .hubungi-section {
        padding: 6rem 0 5rem;
        position: relative;
        z-index: 2;
    }

    .hubungi-title-wrap {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        z-index: 2;
    }

    .hubungi-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        color: #f1c40f;
        letter-spacing: -0.02em;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
    }

    .hubungi-container {
        position: relative;
        z-index: 2;
        max-width: 1100px;
        margin: 0 auto;
        width: 100%;
    }

    .hubungi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 30px 80px -20px rgba(0, 0, 0, 0.5);
    }

    /* ===== KIRI: FORM ===== */
    .hubungi-form-card {
        background: #ffffff;
        padding: 3rem 2.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        color: #0b131e;
        margin-bottom: 0.6rem;
    }

    .form-control {
        width: 100%;
        padding: 0.85rem 1.15rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        color: #0b131e;
        background: #ffffff;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus {
        border-color: #d4a017;
        box-shadow: 0 0 0 4px rgba(212, 160, 23, 0.1);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.85rem 2rem;
        background: #d4a017;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.02em;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btn-submit:hover {
        background: #b08d1f;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -8px rgba(212, 160, 23, 0.5);
    }

    /* ==================== ALERT AUTO-DISMISS ==================== */
    .contact-alert {
        overflow: hidden;
        transition: opacity 0.5s ease, max-height 0.5s ease,
                    margin 0.5s ease, padding 0.5s ease, transform 0.5s ease;
    }
    .contact-alert.is-hidden {
        opacity: 0 !important;
        max-height: 0 !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        transform: translateY(-8px);
    }

    /* ===== KANAN: INFO KONTAK ===== */
    .hubungi-info-card {
        position: relative;
        padding: 3rem 2.5rem;
        background: rgba(11, 19, 30, 0.88);
        backdrop-filter: blur(5px);
        color: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hubungi-info-content {
        position: relative;
        z-index: 2;
    }

    .hubungi-logo {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .hubungi-logo img {
        max-width: 180px;
        height: auto;
        object-fit: contain;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .info-icon {
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .info-icon svg {
        width: 16px;
        height: 16px;
        color: #ffffff;
    }

    .info-text-label {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.8rem;
        color: #ffffff;
        margin-bottom: 0.3rem;
        letter-spacing: 0.02em;
    }

    .info-text-value {
        font-family: 'Inter', sans-serif;
        font-weight: 400;
        font-size: 0.85rem;
        line-height: 1.55;
        color: rgba(255, 255, 255, 0.85);
    }

    .info-link {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .info-link:hover {
        color: #f1c40f;
        text-decoration: underline;
    }

    .whatsapp-link {
        color: #25d366;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: opacity 0.2s ease;
    }

    .whatsapp-link:hover {
        opacity: 0.8;
        text-decoration: underline;
    }

    /* ==================== KANTOR KAMI (MAP DENGAN FRAME) ==================== */
    .kantor-section {
        padding: 4rem 0 6rem;
        position: relative;
        z-index: 2;
    }

    .kantor-title-wrap {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .kantor-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        color: #f1c40f;
        letter-spacing: -0.02em;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
    }

    .map-frame-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .map-frame {
        background: rgba(11, 19, 30, 0.85);
        border: 2px solid rgba(212, 160, 23, 0.5);
        border-radius: 20px;
        padding: 12px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(5px);
    }

    .map-wrapper {
        width: 100%;
        height: 450px;
        overflow: hidden;
        border-radius: 12px;
    }

    .map-wrapper iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
        filter: invert(90%) hue-rotate(180deg) brightness(95%) contrast(90%);
    }

    /* ==================== FOOTER ==================== */
    .site-footer {
        background: #060a10;
        color: #94a3b8;
        padding: 4rem 0 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        position: relative;
        z-index: 2;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1.2fr;
        gap: 3rem;
        max-width: 1100px;
        margin: 0 auto 3rem;
        padding: 0 1rem;
    }

    .footer-col h4 {
        font-family: 'Outfit', sans-serif;
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1.25rem;
        letter-spacing: 0.02em;
    }

    .footer-col p {
        font-size: 0.9rem;
        line-height: 1.6;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        color: #94a3b8;
    }

    .footer-contact-item svg {
        width: 16px;
        height: 16px;
        color: #f1c40f;
        flex-shrink: 0;
        margin-top: 3px;
    }

    .footer-col a.footer-contact-link {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .footer-col a.footer-contact-link:hover {
        color: #f1c40f;
        text-decoration: underline;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s ease;
    }

    .footer-links a:hover {
        color: #f1c40f;
    }

    .footer-bottom {
        max-width: 1100px;
        margin: 0 auto;
        padding: 1.5rem 1rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: #64748b;
    }

    /* ==================== FLOATING WHATSAPP BUTTON ==================== */
    .floating-whatsapp {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99999;
        background-color: #25d366;
        color: #ffffff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
    }

    .floating-whatsapp:hover {
        transform: scale(1.1) translateY(-3px);
        box-shadow: 0 12px 30px rgba(37, 211, 102, 0.7);
        color: #ffffff;
    }

    .floating-whatsapp svg {
        width: 32px;
        height: 32px;
        fill: #ffffff;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 991.98px) {
        .contact-hero { min-height: 80vh; }
        .contact-hero-title { font-size: 3.5rem; }
        .contact-hero-subtitle { font-size: 1.1rem; }
        .contact-hero-inner { padding: 10rem 0 6rem; }

        .hubungi-grid,
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .hubungi-form-card,
        .hubungi-info-card {
            padding: 2.5rem 1.75rem;
        }

        .hubungi-title,
        .kantor-title { font-size: 2rem; }

        .map-wrapper { height: 350px; }
        .footer-bottom { flex-direction: column; text-align: center; gap: 0.5rem; }
        .floating-whatsapp { bottom: 20px; right: 20px; width: 52px; height: 52px; }
        .floating-whatsapp svg { width: 28px; height: 28px; }
    }

    @media (max-width: 640px) {
        .contact-hero { min-height: 70vh; }
        .contact-hero-title { font-size: 2.5rem; }
        .contact-hero-subtitle { font-size: 1rem; }
        .contact-hero-inner { padding: 8rem 0 4rem; }

        .hubungi-section { padding: 4rem 0 3rem; }
        .kantor-section { padding: 2rem 0 4rem; }

        .hubungi-form-card,
        .hubungi-info-card {
            padding: 2rem 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .map-wrapper { height: 260px; }
        .map-frame { padding: 8px; border-radius: 14px; }
    }
</style>

<div class="contact-page">

{{-- ==================== HERO HEADER ==================== --}}
<section class="contact-hero">
    <img src="{{ asset('images/bgatasservice.jpeg') }}" 
         alt="Hubungi Kami PT Bachri Samudera Indonesia" 
         class="contact-hero-bg">

    <div class="contact-hero-overlay"></div>

    <div class="contact-hero-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <div class="contact-hero-title-wrap">
                <h1 class="contact-hero-title">
                    Hubungi<br>
                    <span class="accent">Kami</span>
                </h1>
            </div>

            <p class="contact-hero-subtitle">
                Responsif, Profesional, dan Siap<br>
                Membantu Setiap Kebutuhan Anda
            </p>

        </div>
    </div>
</section>

{{-- ==================== SECTION UTAMA DENGAN BACKGROUND MENYAMBUNG (bgvisimisi.jpeg) ==================== --}}
<div class="unified-bg-section">

    {{-- HUBUNGI SECTION --}}
    <section class="hubungi-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <div class="hubungi-title-wrap" data-aos="fade-up">
                <h2 class="hubungi-title">Hubungi</h2>
            </div>

            <div class="hubungi-container">
                <div class="hubungi-grid" data-aos="fade-up" data-aos-delay="100">

                    {{-- ===== KIRI: FORM ===== --}}
                    <div class="hubungi-form-card">
                        
                        {{-- Alert Sukses — hilang otomatis setelah 4 detik --}}
                        @if(session('success'))
                            <div id="contact-alert-success" class="contact-alert" style="background: linear-gradient(135deg, #10b981, #059669); color: #fff; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 500;">
                                ✓ {{ session('success') }}
                            </div>
                            <script>
                                (function () {
                                    var el = document.getElementById('contact-alert-success');
                                    if (!el) return;
                                    el.style.maxHeight = el.scrollHeight + 'px';
                                    setTimeout(function () {
                                        el.classList.add('is-hidden');
                                        setTimeout(function () {
                                            if (el.parentNode) el.parentNode.removeChild(el);
                                        }, 600);
                                    }, 4000);
                                })();
                            </script>
                        @endif

                        {{-- Alert Error (validasi form) — hilang otomatis setelah 6 detik --}}
                        @if($errors->any())
                            <div id="contact-alert-validation" class="contact-alert" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem;">
                                <ul style="margin: 0; padding-left: 1.25rem;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <script>
                                (function () {
                                    var el = document.getElementById('contact-alert-validation');
                                    if (!el) return;
                                    el.style.maxHeight = el.scrollHeight + 'px';
                                    setTimeout(function () {
                                        el.classList.add('is-hidden');
                                        setTimeout(function () {
                                            if (el.parentNode) el.parentNode.removeChild(el);
                                        }, 600);
                                    }, 6000);
                                })();
                            </script>
                        @endif

                        {{-- Alert Error (gagal kirim email dari controller) — hilang otomatis setelah 6 detik --}}
                        @if(session('error'))
                            <div id="contact-alert-error" class="contact-alert" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 500;">
                                ✕ {{ session('error') }}
                            </div>
                            <script>
                                (function () {
                                    var el = document.getElementById('contact-alert-error');
                                    if (!el) return;
                                    el.style.maxHeight = el.scrollHeight + 'px';
                                    setTimeout(function () {
                                        el.classList.add('is-hidden');
                                        setTimeout(function () {
                                            if (el.parentNode) el.parentNode.removeChild(el);
                                        }, 600);
                                    }, 6000);
                                })();
                            </script>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nama" 
                                       name="nama" 
                                       value="{{ old('nama') }}"
                                       placeholder="Nama" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kontak info</label>
                                <div class="form-row">
                                    <input type="tel" 
                                           class="form-control" 
                                           id="no_telpon" 
                                           name="no_telpon" 
                                           value="{{ old('no_telpon') }}"
                                           placeholder="No telpon (angka saja)"
                                           inputmode="numeric"
                                           pattern="[0-9]*"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                           required>

                                    <input type="email" 
                                           class="form-control" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}"
                                           placeholder="E-mail" 
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="pesan">Pesan</label>
                                <textarea class="form-control" 
                                          id="pesan" 
                                          name="pesan" 
                                          placeholder="Pesan" 
                                          required>{{ old('pesan') }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>

                    {{-- ===== KANAN: INFO KONTAK ===== --}}
                    <div class="hubungi-info-card">
                        <div class="hubungi-info-content">
                            
                            <div class="hubungi-logo">
                                <img src="{{ asset('images/logo2.png') }}" alt="PT Bachri Samudera Indonesia">
                            </div>

                            <div class="info-list">
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="info-text-label">Alamat</p>
                                        <p class="info-text-value">
                                            <a href="https://maps.google.com/?q=ReniJaya+Office+Jl+Kenari+XV+Pamulang+Barat+Tangerang+Selatan" 
                                               target="_blank" 
                                               class="info-link">
                                                ReniJaya Office,<br>
                                                Jl. Kenari XV No. 12, Pamulang Barat,<br>
                                                Pamulang - Tangerang Selatan
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="info-text-label">E-mail</p>
                                        <p class="info-text-value">
                                            <a href="mailto:bachrisamuderaindonesia@gmail.com" class="info-link">
                                                bachrisamuderaindonesia@gmail.com
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="info-text-label">Telepon</p>
                                        <p class="info-text-value">
                                            <a href="tel:085714141802" class="info-link">
                                                0857 1414 1802
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <svg fill="currentColor" viewBox="0 0 24 24" stroke="none">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="info-text-label">Whatsapp</p>
                                        <p class="info-text-value">
                                            <a href="https://wa.me/6285714141802?text=Halo%2C%20saya%20ingin%20menghubungi%20PT%20Bachri%20Samudera%20Indonesia." 
                                               target="_blank" 
                                               class="whatsapp-link">
                                                0857 1414 1802 (Chat WA)
                                            </a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- KANTOR KAMI (MAP DENGAN FRAME) --}}
    <section class="kantor-section">
        <div class="kantor-title-wrap" data-aos="fade-up">
            <h2 class="kantor-title">Kantor Kami</h2>
        </div>

        <div class="map-frame-container" data-aos="fade-up">
            <div class="map-frame">
                <div class="map-wrapper">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.839855295194!2d106.74293431476996!3d-6.287677395450875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f0000000000%3A0x0!2sPamulang%2C%20Tangerang%20Selatan!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

</div> {{-- Penutup unified-bg-section --}}

{{-- ==================== FOOTER ==================== --}}
<footer class="site-footer">
    <div class="footer-grid">
        <div class="footer-col">
            <h4>PT Bachri Samudera Indonesia</h4>
            <p>Perusahaan profesional yang bergerak di bidang layanan dan solusi terpercaya, berkomitmen memberikan pelayanan terbaik bagi setiap klien dengan standar kualitas tinggi.</p>
        </div>
        <div class="footer-col">
            <h4>Menu Utama</h4>
            <ul class="footer-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
                <li><a href="{{ url('/services') }}">Layanan</a></li>
                <li><a href="{{ url('/contact') }}">Hubungi Kami</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            
            <div class="footer-contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>
                    <a href="https://maps.google.com/?q=ReniJaya+Office+Jl+Kenari+XV+Pamulang+Barat+Tangerang+Selatan" 
                       target="_blank" 
                       class="footer-contact-link">
                        ReniJaya Office, Jl. Kenari XV No. 12, Pamulang Barat, Pamulang - Tangerang Selatan
                    </a>
                </span>
            </div>

            <div class="footer-contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Email: <a href="mailto:bachrisamuderaindonesia@gmail.com" class="footer-contact-link">bachrisamuderaindonesia@gmail.com</a></span>
            </div>

            <div class="footer-contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>Telepon: <a href="tel:085714141802" class="footer-contact-link">0857 1414 1802</a></span>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} PT Bachri Samudera Indonesia. All rights reserved.</p>
        <p>Professional & Reliable Service</p>
    </div>
</footer>

{{-- ==================== FLOATING WHATSAPP BUTTON ==================== --}}
<a href="https://wa.me/6285714141802?text=Halo%2C%20saya%20ingin%20menghubungi%20PT%20Bachri%20Samudera%20Indonesia." 
   target="_blank" 
   class="floating-whatsapp" 
   title="Hubungi Kami via WhatsApp">
    <svg viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>

</div>

@endsection