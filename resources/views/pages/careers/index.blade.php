@extends('layouts.app')

@section('title', 'Karir - PT Bachri Samudera Indonesia')

@section('content')

<style>
    /* ==================== FONTS ==================== */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

    .career-page { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; }

    /* ==================== HERO HEADER ==================== */
    .career-hero-img {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #0b131e;
    }

    .career-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 0;
        animation: careerHeroZoom 20s ease-in-out infinite alternate;
    }

    @keyframes careerHeroZoom {
        0% { transform: scale(1.03); }
        100% { transform: scale(1.10); }
    }

    .career-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg,
            rgba(11, 19, 30, 0.95) 0%,
            rgba(11, 19, 30, 0.82) 30%,
            rgba(11, 19, 30, 0.55) 65%,
            rgba(11, 19, 30, 0.35) 100%);
        z-index: 1;
    }

    .career-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 9rem 0 5rem;
    }

    .career-hero-content {
        max-width: 800px;
        animation: careerFadeInUp 1s ease-out;
    }

    @keyframes careerFadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .career-hero-eyebrow {
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
        animation: careerFadeInUp 1s ease-out 0.2s both;
    }

    .career-hero-eyebrow::before {
        content: '';
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #f1c40f);
    }

    .career-hero-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 5rem;
        line-height: 1;
        letter-spacing: -0.04em;
        color: #ffffff;
        margin-bottom: 2rem;
        text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        animation: careerFadeInUp 1s ease-out 0.3s both;
        display: flex;
        flex-wrap: wrap;
        gap: 0.25em;
    }

    .career-hero-title .accent {
        position: relative;
        display: inline-block;
        background: linear-gradient(135deg,
            #f1c40f 0%, #f39c12 25%, #e67e22 50%, #f1c40f 75%, #f39c12 100%);
        background-size: 300% 100%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: careerGoldShimmer 3s ease-in-out infinite;
    }

    @keyframes careerGoldShimmer {
        0%, 100% { background-position: 0% 50%; }
        60% { background-position: 100% 50%; }
    }

    .career-hero-subtitle {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 1.4rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.92);
        max-width: 620px;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.4);
        animation: careerFadeInUp 1s ease-out 0.5s both;
        margin-bottom: 2.5rem;
    }

    .career-hero-actions { display: flex; gap: .9rem; flex-wrap: wrap; animation: careerFadeInUp 1s ease-out 0.6s both; }
    .btn-hero-primary {
        background: #f1c40f;
        color: #0b131e;
        font-weight: 700;
        padding: .9rem 1.8rem;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-family: 'Outfit', sans-serif;
        transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 10px 30px -10px rgba(241,196,15,.5);
    }
    .btn-hero-primary:hover { transform: translateY(-3px) scale(1.02); color: #0b131e; box-shadow: 0 15px 40px -10px rgba(241,196,15,.7); }
    .btn-hero-secondary {
        border: 1.5px solid rgba(255,255,255,.5);
        color: #fff;
        font-weight: 700;
        padding: .9rem 1.8rem;
        border-radius: 50px;
        text-decoration: none;
        font-family: 'Outfit', sans-serif;
        transition: border-color .2s, background .2s;
    }
    .btn-hero-secondary:hover { border-color: #fff; background: rgba(255,255,255,.08); color: #fff; }

    .career-hero-scroll {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        color: rgba(255, 255, 255, 0.6);
        font-family: 'Outfit', sans-serif;
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        animation: careerFadeInUp 1s ease-out 1.2s both;
    }

    .career-hero-scroll .line {
        width: 1px;
        height: 40px;
        background: linear-gradient(180deg, rgba(241, 196, 15, 0.8), transparent);
        position: relative;
        overflow: hidden;
    }

    .career-hero-scroll .line::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 15px;
        background: #f1c40f;
        animation: careerScrollLine 2s ease-in-out infinite;
    }

    @keyframes careerScrollLine {
        0% { top: -15px; }
        100% { top: 40px; }
    }

    .career-stats { display: flex; gap: 2.5rem; flex-wrap: wrap; margin-top: 2.5rem; animation: careerFadeInUp 1s ease-out 0.7s both; }
    .career-stat strong { display: block; font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; color: #fff; }
    .career-stat span { font-size: .8rem; color: rgba(255,255,255,.65); font-family: 'Inter', sans-serif; }

    /* ==================== DAFTAR LOWONGAN — BACKGROUND FOTO ==================== */
    .career-wrap {
        position: relative;
        padding: 6rem 0;
        overflow: hidden;
        background-image: url('{{ asset('images/bgvisimisi.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .career-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(11, 19, 30, 0.82);
        z-index: 1;
        pointer-events: none;
    }
    .career-wrap-inner { max-width: 1120px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 2; }

    .career-section-label {
        display: inline-flex; align-items: center; gap: 12px;
        font-family: 'Outfit', sans-serif; font-weight: 600; font-size: .75rem;
        letter-spacing: .3em; color: #f1c40f; text-transform: uppercase;
    }
    .career-section-label::before { content: ''; width: 40px; height: 1px; background: linear-gradient(90deg, transparent, #f1c40f); }
    .career-section-heading {
        font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 2.2rem;
        color: #ffffff; margin-top: .75rem; margin-bottom: .5rem;
        text-shadow: 0 2px 15px rgba(0,0,0,.6);
    }
    .career-toolbar {
        display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem;
        margin-bottom: 2.5rem; padding-bottom: 1.75rem; border-bottom: 1px solid rgba(255,255,255,.15);
    }
    .career-count {
        color: #fff; font-size: .85rem; font-family: 'Inter', sans-serif;
        background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.2);
        padding: .4rem .9rem; border-radius: 50px; backdrop-filter: blur(6px);
    }

    .job-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.75rem; }

    .job-card {
        display: flex; flex-direction: column;
        background: #fff; border: 1px solid #eef0f3; border-radius: 20px; overflow: hidden;
        color: inherit; text-decoration: none;
        transition: all .4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 20px 45px -18px rgba(0,0,0,.55);
    }
    .job-card:hover {
        border-color: rgba(212,160,23,.4);
        transform: translateY(-7px);
        box-shadow: 0 30px 60px -18px rgba(0,0,0,.65);
        color: inherit;
    }

    .job-card-img { width: 100%; aspect-ratio: 16/10; object-fit: cover; }
    .job-card-img-placeholder {
        width: 100%; aspect-ratio: 16/10;
        background: linear-gradient(135deg, rgba(212,160,23,.14), rgba(11,19,30,.04));
        display: flex; align-items: center; justify-content: center; font-size: 2.4rem;
    }

    .job-card-body { padding: 1.6rem; display: flex; flex-direction: column; flex: 1; }
    .job-card-top { display: flex; justify-content: space-between; align-items: flex-start; gap: .75rem; }
    .job-card h2 { font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 700; margin: 0 0 .4rem; color: #0b131e; line-height: 1.35; }
    .job-card .dept { font-size: .82rem; color: #64748b; margin-bottom: .9rem; }

    .job-meta { display: flex; flex-wrap: wrap; gap: .45rem; margin-top: auto; }
    .job-tag { font-size: .74rem; padding: .28rem .7rem; border-radius: 50px; background: rgba(212,160,23,.12); color: #a3720a; font-weight: 600; white-space: nowrap; }
    .job-tag.muted { background: #f1f4f8; color: #475569; }
    .job-tag.urgent { background: #fee2e2; color: #dc2626; }

    .job-card .go {
        flex-shrink: 0; width: 36px; height: 36px; border-radius: 50%;
        background: linear-gradient(135deg, #f1c40f, #e67e22);
        color: #0b131e; display: flex; align-items: center; justify-content: center;
        font-size: 1rem; transition: transform .3s;
        box-shadow: 0 8px 18px -6px rgba(212,160,23,.55);
    }
    .job-card:hover .go { transform: translateX(3px) rotate(-8deg); }

    .career-empty {
        text-align: center; padding: 4rem 1.5rem;
        border: 1.5px dashed rgba(241,196,15,.5); border-radius: 20px; color: rgba(255,255,255,.85);
        background: rgba(255,255,255,.06);
        backdrop-filter: blur(6px);
    }
    .career-empty h3 { color: #fff; font-family: 'Outfit', sans-serif; font-weight: 700; margin-bottom: .5rem; }
    .career-empty a { color: #f1c40f; font-weight: 600; text-decoration: none; }
    .career-empty a:hover { text-decoration: underline; }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 991.98px) {
        .career-hero-img { min-height: 70vh; }
        .career-hero-title { font-size: 3.5rem; }
        .career-hero-subtitle { font-size: 1.2rem; }
        .career-hero-inner { padding: 7rem 0 4rem; }
        .career-section-heading { font-size: 2rem; }
        .career-wrap { background-attachment: scroll; }
    }

    @media (max-width: 640px) {
        .career-hero-img { min-height: 65vh; }
        .career-hero-title { font-size: 2.5rem; gap: 0.15em; }
        .career-hero-subtitle { font-size: 1rem; }
        .career-hero-eyebrow { font-size: 0.7rem; }
        .career-hero-inner { padding: 6rem 0 3.5rem; }
        .career-hero-scroll { display: none; }
        .career-hero-actions { flex-direction: column; }
        .btn-hero-primary, .btn-hero-secondary { justify-content: center; text-align: center; }
        .career-stats { gap: 1.5rem; }
        .career-wrap { padding: 3.5rem 0; }
        .career-toolbar { flex-direction: column; align-items: flex-start; }
        .job-grid { grid-template-columns: 1fr; }
    }

    FOOTER
   ============================================================ */
.site-footer{
    position:relative;z-index:2;
    background:#080C1F;color:#94a3b8;
    padding:0 0 2rem;
    overflow:hidden;isolation:isolate;
}
.site-footer::before{
    content:"";
    position:absolute;inset:0;
    background-image:var(--hp-header-url);
    background-size:cover;background-position:center 40%;
    filter:blur(75px) saturate(0.4) brightness(0.22);
    opacity:.55;z-index:-1;
    transform:translate3d(0,0,0) scale(1.08);
    animation:hp-footer-drift 80s cubic-bezier(.4,0,.6,1) infinite alternate;
    will-change:transform;
}
@keyframes hp-footer-drift{
    0%   { transform:translate3d(0,0,0) scale(1.08); }
    100% { transform:translate3d(-1.5%,1%,0) scale(1.14); }
}
.site-footer::after{
    content:"";
    position:absolute;inset:0;
    background:
        linear-gradient(180deg,rgba(6,10,26,.65) 0%,rgba(6,10,26,.85) 40%,rgba(4,7,16,.95) 100%),
        radial-gradient(ellipse 60% 40% at 50% 0%,rgba(241,196,15,.05),transparent 70%);
    z-index:-1;pointer-events:none;
}

.hp-footer-city{
    position:absolute;
    left:0;right:0;bottom:0;
    height:130px;
    z-index:-1;
    opacity:.32;
    pointer-events:none;
    overflow:hidden;
    -webkit-mask-image:linear-gradient(180deg,transparent 0%,#000 55%,#000 100%);
    mask-image:linear-gradient(180deg,transparent 0%,#000 55%,#000 100%);
}
.hp-footer-city .hp-city-track svg{height:220px}
.hp-footer-city .hp-city-track{bottom:0}

.hp-footer-bar{
    position:relative;height:1px;width:100%;
    background:linear-gradient(90deg,transparent 5%,rgba(241,196,15,.5) 50%,transparent 95%);
}
.hp-footer-bar::after{
    content:"";position:absolute;top:-8px;left:50%;
    width:56px;height:16px;margin-left:-28px;
    background:radial-gradient(ellipse at center,rgba(241,196,15,.35),transparent 70%);
    pointer-events:none;
}

.footer-grid{
    position:relative;
    display:grid;grid-template-columns:2fr 1fr 1.2fr;
    gap:3rem;max-width:1100px;
    margin:0 auto 3rem;padding:3.5rem 1rem 0;
}
.footer-col h4{
    position:relative;padding-bottom:.75rem;
    font-family:'Outfit',sans-serif;color:#fff;
    font-size:1.08rem;font-weight:700;
    margin-bottom:1.35rem;letter-spacing:.02em;
}
.footer-col h4::after{
    content:"";position:absolute;left:0;bottom:0;
    width:32px;height:2px;
    background:linear-gradient(90deg,#f1c40f,rgba(241,196,15,.2));
    border-radius:2px;
}
.footer-col p{font-size:.9rem;line-height:1.7;color:#94a3b8;margin-bottom:1rem;max-width:44ch}
.footer-contact-item{
    display:flex;align-items:flex-start;gap:10px;
    margin-bottom:.85rem;font-size:.9rem;color:#94a3b8;line-height:1.6;
}
.footer-contact-item svg{
    width:16px;height:16px;color:#f1c40f;flex-shrink:0;margin-top:3px;
    filter:drop-shadow(0 0 4px rgba(241,196,15,.35));
}
.footer-col a.footer-contact-link{color:#94a3b8;text-decoration:none;transition:color .3s ease}
.footer-col a.footer-contact-link:hover{color:#f1c40f;text-decoration:underline}
.footer-links{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.75rem}
.footer-links a{
    position:relative;display:inline-block;
    color:#94a3b8;text-decoration:none;font-size:.9rem;padding-left:0;
    transition:color .3s,transform .3s cubic-bezier(.19,1,.22,1),padding-left .3s;
}
.footer-links a::before{
    content:"";position:absolute;left:0;top:50%;
    width:0;height:1px;background:#f1c40f;
    transition:width .3s cubic-bezier(.19,1,.22,1);transform:translateY(-50%);
}
.footer-links a:hover{color:#f1c40f;padding-left:14px}
.footer-links a:hover::before{width:8px}
.footer-bottom{
    position:relative;max-width:1100px;margin:0 auto;
    padding:1.5rem 1rem 0;
    border-top:1px solid rgba(255,255,255,.06);
    display:flex;justify-content:space-between;align-items:center;
    font-size:.85rem;color:#64748b;
}
.footer-bottom p:first-child{letter-spacing:.02em}
.footer-bottom p:last-child{
    color:#94a3b8;display:inline-flex;align-items:center;gap:8px;
}
.footer-bottom p:last-child::before{
    content:"";width:6px;height:6px;border-radius:50%;
    background:#f1c40f;box-shadow:0 0 8px rgba(241,196,15,.7);
}
@media(max-width:991.98px){
    .footer-grid{grid-template-columns:1fr;gap:2rem;padding-top:2.5rem}
    .footer-bottom{flex-direction:column;text-align:center;gap:.5rem}
}
</style>



<div class="career-page">

{{-- ==================== HERO HEADER ==================== --}}
<section class="career-hero-img">

    <img src="{{ asset('images/karir.jpeg') }}"
         alt="Karir PT Bachri Samudera Indonesia"
         class="career-hero-bg">

    <div class="career-hero-overlay"></div>

    <div class="career-hero-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="career-hero-content">

                <div class="career-hero-eyebrow">
                    PT Bachri Samudera Indonesia
                </div>

                <h1 class="career-hero-title">
                    <span>Bergabung</span>
                    <span class="accent">Bersama Kami</span>
                </h1>

                <p class="career-hero-subtitle">
                    Kami mencari orang-orang berdedikasi untuk tumbuh bersama kami.<br>
                    Temukan posisi yang sesuai dengan Anda dan jadi bagian dari tim yang
                    membangun solusi kreatif di bidang konstruksi, desain, dan manajemen acara.
                </p>

                <div class="career-hero-actions">
                    <a href="#lowongan" class="btn-hero-primary">Lihat Lowongan &rarr;</a>
                    <a href="{{ url('/contact') }}" class="btn-hero-secondary">Hubungi Kami</a>
                </div>

            

            </div>
        </div>
    </div>

    <div class="career-hero-scroll">
        <span>Scroll</span>
        <div class="line"></div>
    </div>

</section>

{{-- ==================== DAFTAR LOWONGAN ==================== --}}
<section class="career-wrap" id="lowongan">
    <div class="career-wrap-inner">

        <div class="career-toolbar">
            <div>
                <span class="career-section-label">Karir</span>
                <h2 class="career-section-heading">Lowongan Tersedia</h2>
            </div>
            @if($vacancies->count())
                <span class="career-count">Menampilkan {{ $vacancies->count() }} lowongan aktif</span>
            @endif
        </div>

        @if($vacancies->count())
            <div class="job-grid">
                @foreach($vacancies as $vacancy)
                    @php
                        $isUrgent = $vacancy->deadline && now()->diffInDays($vacancy->deadline, false) <= 7 && now()->diffInDays($vacancy->deadline, false) >= 0;
                    @endphp
                    <a href="{{ route('careers.show', $vacancy) }}" class="job-card">
                        @if($vacancy->imageUrl())
                            <img src="{{ $vacancy->imageUrl() }}" alt="{{ $vacancy->title }}" class="job-card-img">
                        @else
                            <div class="job-card-img-placeholder">💼</div>
                        @endif
                        <div class="job-card-body">
                            <div class="job-card-top">
                                <div>
                                    <h2>{{ $vacancy->title }}</h2>
                                    @if($vacancy->department)<div class="dept">{{ $vacancy->department }}</div>@endif
                                </div>
                                <span class="go">&rarr;</span>
                            </div>
                            <div class="job-meta">
                                <span class="job-tag">{{ $vacancy->employment_type }}</span>
                                <span class="job-tag muted">📍 {{ $vacancy->location }}</span>
                                @if($isUrgent)
                                    <span class="job-tag urgent">⏰ Segera ditutup</span>
                                @elseif($vacancy->deadline)
                                    <span class="job-tag muted">Batas: {{ $vacancy->deadline->translatedFormat('d M Y') }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="career-empty">
                <h3>Belum ada lowongan yang dibuka</h3>
                <p class="mb-0">Silakan cek kembali nanti, atau kirim pertanyaan lewat halaman <a href="{{ url('/contact') }}">Hubungi Kami</a>.</p>
            </div>
        @endif

    </div>
</section>

</div>


{{-- ============================================================
     FOOTER
     ============================================================ --}}
    <footer class="site-footer">
        <div class="hp-footer-city" aria-hidden="true">
            <div class="hp-city-track hp-city-track-front">
                <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
                <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
            </div>
        </div>

        <div class="hp-footer-bar" aria-hidden="true"></div>

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
                    <li><a href="{{ route('careers.index') }}">Karir</a></li>
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
                        <a href="https://maps.google.com/?q=ReniJaya+Office+Jl+Kenari+XV+Pamulang+Barat+Tangerang+Selatan" target="_blank" class="footer-contact-link">
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
            <p>Professional &amp; Reliable Service</p>
        </div>
    </footer>

 
  
@endsection