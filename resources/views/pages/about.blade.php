@extends('layouts.app')

@section('title', 'Tentang Kami - PT Bachri Samudera Indonesia')

@section('content')

<style>
    /* ==================== FONTS ==================== */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,500;1,500&display=swap');

    .about-page { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; }
    .font-display { font-family: 'Outfit', sans-serif; letter-spacing: -0.03em; }
    .font-serif { font-family: 'Cormorant Garamond', serif; }

    /* ==================== HERO HEADER ==================== */
    .about-hero-img {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #0b131e;
    }

    .about-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 0;
        animation: heroZoom 20s ease-in-out infinite alternate;
    }

    @keyframes heroZoom {
        0% { transform: scale(1.03); }
        100% { transform: scale(1.10); }
    }

    .about-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, 
            rgba(11, 19, 30, 0.95) 0%, 
            rgba(11, 19, 30, 0.82) 30%, 
            rgba(11, 19, 30, 0.55) 65%, 
            rgba(11, 19, 30, 0.35) 100%);
        z-index: 1;
    }

    .about-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 10rem 0 5rem;
    }

    .about-hero-content {
        max-width: 800px;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .about-hero-eyebrow {
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
        animation: fadeInUp 1s ease-out 0.2s both;
    }

    .about-hero-eyebrow::before {
        content: '';
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #f1c40f);
    }

    /* ==================== JUDUL INTERAKTIF ==================== */
    .about-hero-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 5rem;
        line-height: 1;
        letter-spacing: -0.04em;
        color: #ffffff;
        margin-bottom: 2rem;
        text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        animation: fadeInUp 1s ease-out 0.3s both;
        perspective: 1000px;
        display: flex;
        flex-wrap: wrap;
        gap: 0.25em;
    }

    .about-hero-title .word {
        display: inline-block;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
        position: relative;
    }

    .about-hero-title .word:hover {
        transform: translateY(-8px) rotateX(12deg) scale(1.05);
        text-shadow: 
            0 10px 30px rgba(241, 196, 15, 0.5),
            0 0 60px rgba(241, 196, 15, 0.3);
    }

    .about-hero-title .accent {
        position: relative;
        display: inline-block;
        background: linear-gradient(135deg, 
            #f1c40f 0%, 
            #f39c12 25%, 
            #e67e22 50%, 
            #f1c40f 75%, 
            #f39c12 100%);
        background-size: 300% 100%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: goldShimmer 3s ease-in-out infinite;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
    }

    @keyframes goldShimmer {
        0%, 100% { background-position: 0% 50%; }
        60% { background-position: 100% 50%; }
    }

    .about-hero-title .accent:hover {
        transform: translateY(-8px) rotateX(12deg) scale(1.08);
        filter: brightness(1.2) drop-shadow(0 15px 40px rgba(241, 196, 15, 0.7));
    }

    .about-hero-title .accent::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #f1c40f, #e67e22, transparent);
        border-radius: 4px;
        transform: scaleX(0);
        transform-origin: left;
        animation: underlineExpand 1.2s ease-out 1s forwards;
        transition: all 0.4s ease;
    }

    .about-hero-title .accent:hover::after {
        height: 6px;
        box-shadow: 0 0 25px rgba(241, 196, 15, 0.9);
        background: linear-gradient(90deg, #f1c40f, #e67e22, #f1c40f);
    }

    @keyframes underlineExpand {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
    }

    .about-hero-subtitle {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 1.4rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.92);
        max-width: 620px;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.4);
        animation: fadeInUp 1s ease-out 0.5s both;
    }

    .about-hero-scroll {
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
        animation: fadeInUp 1s ease-out 1.2s both;
    }

    .about-hero-scroll .line {
        width: 1px;
        height: 40px;
        background: linear-gradient(180deg, rgba(241, 196, 15, 0.8), transparent);
        position: relative;
        overflow: hidden;
    }

    .about-hero-scroll .line::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 15px;
        background: #f1c40f;
        animation: scrollLine 2s ease-in-out infinite;
    }

    @keyframes scrollLine {
        0% { top: -15px; }
        100% { top: 40px; }
    }

    /* ==================== SECTION LABELS ==================== */
    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.75rem;
        letter-spacing: 0.3em;
        color: #d4a017;
        text-transform: uppercase;
    }

    .section-label::before {
        content: '';
        width: 40px;
        height: 1px;
        background: linear-gradient(90deg, transparent, #d4a017);
    }

    .section-label.center { justify-content: center; }

    .section-label.center::after {
        content: '';
        width: 40px;
        height: 1px;
        background: linear-gradient(90deg, #d4a017, transparent);
    }

    .section-heading {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        line-height: 1.15;
        letter-spacing: -0.025em;
        color: #0b131e;
        margin-top: 1rem;
    }

    /* ==================== STORY SECTION ==================== */
    .story-section {
        padding: 0 0 3rem;
        background: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .story-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(212, 160, 23, 0.04) 1px, transparent 1px);
        background-size: 28px 28px;
        mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 20%, transparent 80%);
        -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 20%, transparent 80%);
        pointer-events: none;
    }

    .story-container {
        max-width: 950px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .story-logo-wrap {
        display: inline-block;
        margin: 0 auto;
        padding: 0;
    }

    .story-logo {
        max-width: 340px;
        display: block;
        margin: 0 auto;
        transition: transform 0.5s ease;
    }

    .story-logo img {
        width: 100%;
        height: auto;
        object-fit: contain;
        display: block;
    }

    .story-logo-wrap:hover .story-logo {
        transform: scale(1.04);
    }

    .story-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin: 0.25rem auto 1rem;
        max-width: 180px;
    }

    .story-divider::before,
    .story-divider::after {
        content: '';
        flex-grow: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(212, 160, 23, 0.5));
    }

    .story-divider::after {
        background: linear-gradient(90deg, rgba(212, 160, 23, 0.5), transparent);
    }

    .story-divider .dot {
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #d4a017, #e67e22);
        border-radius: 50%;
        box-shadow: 0 0 12px rgba(212, 160, 23, 0.5);
    }

    .story-text {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        line-height: 1.9;
        color: #475569;
        margin: 0 auto 1.25rem;
        font-weight: 400;
        max-width: 780px;
    }

    .story-text:last-child { margin-bottom: 0; }

    .story-text strong {
        color: #0b131e;
        font-weight: 700;
        position: relative;
        white-space: nowrap;
    }

    .story-text strong::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, rgba(212, 160, 23, 0.35), rgba(212, 160, 23, 0.1));
        border-radius: 2px;
        z-index: -1;
    }

    /* ==================== VISI MISI SECTION ==================== */
    .vm-section {
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
        background-image: url("{{ asset('images/bgvisimisi.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .vm-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(11, 19, 30, 0.75);
        z-index: 1;
        pointer-events: none;
    }

    .vm-section .container-relative {
        position: relative;
        z-index: 2;
        width: 100%;
    }

    /* Grid */
    .vm-grid {
        display: grid;
        grid-template-columns: 1.55fr 1fr 1.2fr;
        gap: 1.5rem;
        align-items: stretch;
        max-width: 1400px;
        margin: 0 auto;
        padding-left: 1rem;
        padding-right: 2rem;
    }

    /* ===== KOLOM 1: FOTO DALAM FRAME ===== */
    .vm-photo {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        min-height: 600px;
        display: flex;
        align-items: center;
        padding: 3.5rem 3rem;
        background: linear-gradient(135deg, #1a365d 0%, #0b131e 100%);
        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 25px 60px -25px rgba(11, 19, 30, 0.6);
    }

    .vm-photo:hover {
        transform: translateY(-6px);
    }

    /* Foto dengan brightness lebih cerah */
    .vm-photo-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 0;
        transition: transform 0.7s ease;
        filter: brightness(1.15) contrast(1.05);
    }

    .vm-photo:hover .vm-photo-bg { transform: scale(1.05); }

    /* Overlay - lebih terang agar foto terlihat jelas */
    .vm-photo-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, 
            rgba(11, 19, 30, 0.45) 0%,
            rgba(11, 19, 30, 0.25) 50%,
            rgba(11, 19, 30, 0.6) 100%);
        z-index: 1;
    }

    /* Konten foto - align kiri */
    .vm-photo-content {
        position: relative;
        z-index: 2;
        color: #ffffff;
        width: 100%;
        text-align: left;
        padding-left: 0.5rem;
    }

    /* Label VISI & MISI */
    .vm-photo-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.25em;
        color: #ffffff;
        text-transform: uppercase;
        padding-bottom: 0.6rem;
        margin-bottom: 1.75rem;
        position: relative;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 1);
    }

    .vm-photo-label::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: #d4a017;
        border-radius: 3px;
        box-shadow: 0 0 12px rgba(212, 160, 23, 0.5);
    }

    /* Judul - align kiri */
    .vm-photo-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 2.2rem;
        line-height: 1.2;
        letter-spacing: -0.025em;
        color: #ffffff;
        margin-bottom: 1.5rem;
        text-shadow: 
            0 2px 8px rgba(0, 0, 0, 1),
            0 4px 20px rgba(0, 0, 0, 0.9),
            0 0 40px rgba(0, 0, 0, 0.7);
        text-align: left;
    }

    /* Deskripsi - align kiri */
    .vm-photo-desc {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 1rem;
        line-height: 1.75;
        color: #ffffff;
        max-width: 400px;
        margin: 0;
        text-shadow: 
            0 2px 6px rgba(0, 0, 0, 1),
            0 2px 15px rgba(0, 0, 0, 0.9);
        text-align: left;
    }

    /* ===== KOLOM 2 & 3: CARD ===== */
    .vm-card-new {
        background: #ffffff;
        border-radius: 24px;
        padding: 3rem 2.5rem;
        border: 1px solid #eef0f3;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -15px rgba(11, 19, 30, 0.15);
    }

    .vm-card-new::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #d4a017, #e67e22, #d4a017);
        transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .vm-card-new:hover::before {
        transform: scaleX(1);
    }

    .vm-card-new:hover {
        transform: translateY(-8px);
        border-color: rgba(212, 160, 23, 0.35);
        box-shadow: 
            0 25px 55px -20px rgba(11, 19, 30, 0.3),
            0 0 0 1px rgba(212, 160, 23, 0.2);
    }

    .vm-card-icon {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        background: linear-gradient(135deg, #f1c40f 0%, #e67e22 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.75rem;
        box-shadow: 0 12px 28px -8px rgba(212, 160, 23, 0.55);
        transition: all 0.4s ease;
    }

    .vm-card-new:hover .vm-card-icon {
        transform: rotate(-6deg) scale(1.1);
        box-shadow: 0 16px 38px -8px rgba(212, 160, 23, 0.75);
    }

    .vm-card-icon svg {
        width: 32px;
        height: 32px;
        color: #ffffff;
    }

    .vm-card-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.6rem;
        color: #0b131e;
        letter-spacing: -0.025em;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .vm-card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #d4a017, #e67e22);
        border-radius: 3px;
        transition: width 0.4s ease;
    }

    .vm-card-new:hover .vm-card-title::after {
        width: 80px;
    }

    .vm-card-quote {
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 1.02rem;
        line-height: 1.85;
        color: #475569;
    }

    .vm-mission-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 1.35rem;
    }

    .vm-mission-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .vm-mission-item:hover {
        transform: translateX(6px);
    }

    .vm-mission-number {
        flex-shrink: 0;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f1c40f 0%, #e67e22 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        color: #ffffff;
        box-shadow: 0 4px 12px -3px rgba(212, 160, 23, 0.5);
        transition: all 0.3s ease;
    }

    .vm-mission-item:hover .vm-mission-number {
        transform: scale(1.12);
        box-shadow: 0 6px 20px -3px rgba(212, 160, 23, 0.75);
    }

    .vm-mission-text {
        font-family: 'Inter', sans-serif;
        font-weight: 400;
        font-size: 0.96rem;
        line-height: 1.75;
        color: #475569;
        padding-top: 5px;
    }

    /* ==================== VALUES SECTION ==================== */
    .values-section { padding: 6rem 0; background: #ffffff; }

    .value-card {
        text-align: center;
        padding: 2.5rem 1.5rem;
        border-radius: 16px;
        border: 1px solid #f0f0f0;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        height: 100%;
        background: #ffffff;
    }

    .value-card:hover {
        transform: translateY(-8px);
        border-color: rgba(212, 160, 23, 0.3);
        box-shadow: 0 20px 40px -15px rgba(212, 160, 23, 0.15);
    }

    .value-icon {
        width: 64px; height: 64px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(212, 160, 23, 0.15), rgba(212, 160, 23, 0.05));
        border: 1px solid rgba(212, 160, 23, 0.2);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.4s ease;
    }

    .value-card:hover .value-icon {
        background: linear-gradient(135deg, #d4a017, #b08d1f);
        transform: rotate(-5deg) scale(1.1);
    }

    .value-icon svg {
        width: 30px; height: 30px;
        color: #d4a017;
        transition: color 0.4s ease;
    }

    .value-card:hover .value-icon svg { color: #ffffff; }

    .value-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: #0b131e;
        margin-bottom: 0.75rem;
        letter-spacing: -0.01em;
    }

    .value-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        line-height: 1.7;
        color: #64748b;
    }

    /* ==================== CTA ==================== */
    .cta-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #0b131e 0%, #1a365d 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 700px; height: 700px;
        background: radial-gradient(circle, rgba(212, 160, 23, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .cta-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
    }

    .cta-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        line-height: 1.15;
        letter-spacing: -0.025em;
        color: #ffffff;
        margin-bottom: 1.25rem;
    }

    .cta-title .accent {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-weight: 500;
        color: #d4a017;
    }

    .cta-desc {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        line-height: 1.75;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 2rem;
    }

    .cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #d4a017 0%, #e67e22 100%);
        color: #0b131e;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.02em;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 10px 30px -10px rgba(212, 160, 23, 0.5);
        border: none;
    }

    .cta-btn:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 20px 45px -10px rgba(212, 160, 23, 0.7);
        color: #0b131e;
    }

    .cta-btn svg { transition: transform 0.3s ease; }
    .cta-btn:hover svg { transform: translateX(4px); }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 1199.98px) {
        .vm-grid {
            grid-template-columns: 1.45fr 1fr 1.15fr;
            padding-left: 1rem;
            padding-right: 1.5rem;
            gap: 1.25rem;
        }
        .vm-photo {
            min-height: 550px;
        }
    }

    @media (max-width: 991.98px) {
        .about-hero-img { min-height: 70vh; }
        .about-hero-title { font-size: 3.5rem; }
        .about-hero-subtitle { font-size: 1.2rem; }
        .about-hero-inner { padding: 7rem 0 4rem; }
        .section-heading { font-size: 2rem; }
        .story-text { font-size: 1.05rem; }
        .cta-title { font-size: 2rem; }
        .story-logo { max-width: 280px; }

        .vm-section { background-attachment: scroll; }

        .vm-grid {
            grid-template-columns: 1fr;
            gap: 1.25rem;
            padding: 0 1.5rem;
        }

        .vm-photo {
            min-height: 480px;
            padding: 2.5rem 2rem;
        }

        .vm-photo-title { font-size: 1.95rem; }

        .vm-card-new {
            padding: 2.5rem 2rem;
        }
    }

    @media (max-width: 640px) {
        .about-hero-img { min-height: 65vh; }
        .about-hero-title { font-size: 2.5rem; gap: 0.15em; }
        .about-hero-subtitle { font-size: 1rem; }
        .about-hero-eyebrow { font-size: 0.7rem; }
        .about-hero-inner { padding: 6rem 0 3.5rem; }
        .about-hero-scroll { display: none; }
        .section-heading { font-size: 1.75rem; }

        .story-section { padding: 0 0 2rem; }
        .story-logo { max-width: 220px; }
        .story-divider { margin: 0.15rem auto 0.75rem; }
        .story-text { font-size: 0.95rem; line-height: 1.8; margin-bottom: 1rem; }
        .story-text strong { white-space: normal; }

        .vm-section { padding: 3rem 0; }
        .vm-grid { padding: 0 1rem; }
        .vm-photo {
            min-height: 400px;
            padding: 2rem 1.5rem;
        }
        .vm-photo-title { font-size: 1.7rem; }
        .vm-photo-desc { font-size: 0.92rem; }

        .vm-card-new { padding: 2rem 1.5rem; }
        .vm-card-title { font-size: 1.35rem; }
        .vm-mission-text { font-size: 0.9rem; }

        .value-card { padding: 2rem 1.25rem; }
        .cta-title { font-size: 1.75rem; }
        .cta-btn { width: 100%; justify-content: center; }
    }
</style>

<div class="about-page">

{{-- ==================== HERO HEADER ==================== --}}
<section class="about-hero-img">
    
    <img src="{{ asset('images/tentangkami11.jpg') }}" 
         alt="Tentang Kami PT Bachri Samudera Indonesia" 
         class="about-hero-bg">

    <div class="about-hero-overlay"></div>

    <div class="about-hero-inner">
        <div class="max-w-7xl mx-auto px-10 sm:px-11 lg:px-8 w-full">
            <div class="about-hero-content">
                
                <div class="about-hero-eyebrow">
                    PT Bachri Samudera Indonesia
                </div>

                <h1 class="about-hero-title">
                    <span class="word">Tentang</span>
                    <span class="word accent">Kami</span>
                </h1>

                <p class="about-hero-subtitle">
                    Kreativitas, Kualitas dan Kolaborasi<br>
                    untuk Masa Depan yang Lebih Baik
                </p>

            </div>
        </div>
    </div>

    <div class="about-hero-scroll">
        <span>Scroll</span>
        <div class="line"></div>
    </div>

</section>

{{-- ==================== STORY SECTION ==================== --}}
<section class="story-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="story-container" data-aos="fade-up">
            
            {{-- Logo --}}
            <div class="story-logo-wrap">
                <div class="story-logo">
                    <img src="{{ asset('images/logo.jpeg') }}" 
                         alt="Logo PT Bachri Samudera Indonesia">
                </div>
            </div>

            {{-- Garis Dekoratif Emas --}}
            <div class="story-divider">
                <span class="dot"></span>
            </div>

            {{-- Paragraf 1 --}}
            <p class="story-text">
                Berdiri sejak 2020, PT BACHRI SAMUDERA INDONESIA (BAHRI) adalah perusahaan multibisnis yang bergerak dibidang <strong>Konstruksi, Exterior & Interior, Event Management, Desain serta Periklanan</strong>. Dengan kemampuan desain kreatif dan produksi mandiri, kami memastikan setiap solusi visual dan branding memiliki kualitas terbaik dari konsep hingga eksekusi.
            </p>

            {{-- Paragraf 2 --}}
            <p class="story-text">
                Sebagai profesional yang berpengalaman di industri Event Organizer, kami senantiasa selalu berinovasi, cepat tanggap terhadap kebutuhan klien, dan mampu mengelola berbagai situasi, termasuk kondisi darurat.
            </p>

            {{-- Paragraf 3 --}}
            <p class="story-text">
                Melalui kombinasi profesionalisme, kreativitas, dan eksekusi yang tepat waktu, kami berkomitmen untuk memberikan nilai tambah yang signifikan bagi klien, mitra, dan masyarakat.
            </p>

        </div>

    </div>
</section>

{{-- ==================== VISI & MISI SECTION ==================== --}}
<section class="vm-section">
    <div class="container-relative">
        <div class="vm-grid">
            
            {{-- ===== KOLOM 1: FOTO LEBIH TERANG ===== --}}
            <div class="vm-photo" data-aos="fade-right">
                
                <img src="{{ asset('images/visimisi.jpeg') }}" 
                     alt="Visi Misi PT Bachri Samudera Indonesia" 
                     class="vm-photo-bg">

                <div class="vm-photo-overlay"></div>

                <div class="vm-photo-content">
                    
                    <div class="vm-photo-label">
                        VISI & MISI
                    </div>

                    <h3 class="vm-photo-title">
                        Membangun Solusi Kreatif untuk Masa Depan
                    </h3>

                    <p class="vm-photo-desc">
                        Dengan komitmen pada inovasi, kreativitas, dan kolaborasi, kami terus berupaya memberikan nilai tambah bagi klien, mitra, dan masyarakat.
                    </p>

                </div>
            </div>

            {{-- ===== KOLOM 2: CARD VISI ===== --}}
            <div class="vm-card-new" data-aos="fade-up" data-aos-delay="100">
                
                <div class="vm-card-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>

                <h3 class="vm-card-title">Visi</h3>

                <p class="vm-card-quote">
                    "Menjadi perusahaan multibisnis yang inovatif, terpercaya, dan berdampak positif dalam membangun solusi kreatif dan berkelanjutan."
                </p>

            </div>

            {{-- ===== KOLOM 3: CARD MISI ===== --}}
            <div class="vm-card-new" data-aos="fade-left" data-aos-delay="200">
                
                <div class="vm-card-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <circle cx="12" cy="12" r="6"/>
                        <circle cx="12" cy="12" r="2"/>
                    </svg>
                </div>

                <h3 class="vm-card-title">Misi</h3>

                <ul class="vm-mission-list">
                    
                    <li class="vm-mission-item">
                        <span class="vm-mission-number">1</span>
                        <span class="vm-mission-text">
                            Memberikan layanan berkualitas tinggi di bidang <strong>Konstruksi, Exterior & Interior, Event Management, Desain, serta Periklanan.</strong>
                        </span>
                    </li>

                    <li class="vm-mission-item">
                        <span class="vm-mission-number">2</span>
                        <span class="vm-mission-text">
                            Menghadirkan desain kreatif dan produksi mandiri yang efisien dan berstandar tinggi.
                        </span>
                    </li>

                    <li class="vm-mission-item">
                        <span class="vm-mission-number">3</span>
                        <span class="vm-mission-text">
                            Membangun kolaborasi yang kuat dengan klien, mitra, dan komunitas untuk menciptakan pertumbuhan bersama.
                        </span>
                    </li>

                    <li class="vm-mission-item">
                        <span class="vm-mission-number">4</span>
                        <span class="vm-mission-text">
                            Mendorong mengutamakan inovasi dan kreativitas sebagai fondasi utama dalam menghadapi setiap tantangan bisnis.
                        </span>
                    </li>

                </ul>

            </div>

        </div>
    </div>
</section>
{{-- ==================== VALUES SECTION ==================== --}}
<section id="values" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <div class="lg:col-span-5 text-left" data-aos="fade-right">
                <div class="flex items-center gap-3 mb-3">
                    <span class="section-label">WHY CHOOSE US</span>
                    <div class="h-[2px] w-12 bg-amber-400"></div>
                </div>
                <h2 class="section-heading text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                    Mengapa BACHRI?
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    Kami percaya bahwa setiap proyek adalah kesempatan untuk menciptakan dampak yang nyata.
                </p>
            </div>

            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" data-aos="fade-left">
                
                <div class="value-card p-5 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center text-center justify-center">
                    <div class="value-icon mb-3 p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="value-title font-bold text-slate-900 text-base mb-1">Creative</h3>
                    <p class="value-desc text-xs text-slate-600 leading-relaxed">Mengutamakan kreativitas dalam setiap konsep dan solusi.</p>
                </div>

                <div class="value-card p-5 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center text-center justify-center">
                    <div class="value-icon mb-3 p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="value-title font-bold text-slate-900 text-base mb-1">Professional</h3>
                    <p class="value-desc text-xs text-slate-600 leading-relaxed">Didukung pengalaman mendalam dalam mengelola proyek dan event.</p>
                </div>

                <div class="value-card p-5 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center text-center justify-center">
                    <div class="value-icon mb-3 p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="value-title font-bold text-slate-900 text-base mb-1">End-to-end Solution</h3>
                    <p class="value-desc text-xs text-slate-600 leading-relaxed">Dari konsep, desain produksi hingga instalasi.</p>
                </div>

                <div class="value-card p-5 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center text-center justify-center">
                    <div class="value-icon mb-3 p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="value-title font-bold text-slate-900 text-base mb-1">Responsive</h3>
                    <p class="value-desc text-xs text-slate-600 leading-relaxed">Cepat tanggap terhadap kebutuhan klien dan situasi lapangan.</p>
                </div>

                <div class="value-card p-5 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center text-center justify-center">
                    <div class="value-icon mb-3 p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="value-title font-bold text-slate-900 text-base mb-1">Quality</h3>
                    <p class="value-desc text-xs text-slate-600 leading-relaxed">Mengutamakan kualitas hasil dan standar produksi.</p>
                </div>

                <div class="value-card p-5 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center text-center justify-center">
                    <div class="value-icon mb-3 p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="value-title font-bold text-slate-900 text-base mb-1">Collaboration</h3>
                    <p class="value-desc text-xs text-slate-600 leading-relaxed">Membangun hubungan dan kolaborasi yang kuat dengan klien dan mitra.</p>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Section Pimpinan Perusahaan -->
<section class="py-20 relative overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/bgvisimisi.jpeg') }}');">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight drop-shadow-md">
                Pimpinan <span class="text-amber-400">Perusahaan</span>
            </h2>
            <div class="w-20 h-1 bg-amber-500 mx-auto mt-4 rounded-full shadow-md"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            
            <div class="group relative bg-white/95 backdrop-blur-md rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/20 flex flex-col" data-aos="fade-up" data-aos-delay="100">
                <div class="relative w-full h-80 sm:h-96 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/rieco.jpeg') }}" alt="Rieco Advina Fazihulisan, SE" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <span class="inline-block px-3.5 py-1 bg-amber-500 text-slate-950 text-xs font-bold rounded-full mb-2 tracking-wide shadow-md">Komisaris</span>
                        <h3 class="text-xl font-bold tracking-wide">Rieco Advina Fazihulisan, SE</h3>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white/95 backdrop-blur-md rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/20 flex flex-col" data-aos="fade-up" data-aos-delay="200">
                <div class="relative w-full h-80 sm:h-96 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/ilham.jpeg') }}" alt="Ilham Adi Syaputra" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <span class="inline-block px-3.5 py-1 bg-amber-500 text-slate-950 text-xs font-bold rounded-full mb-2 tracking-wide shadow-md">Direktur Utama</span>
                        <h3 class="text-xl font-bold tracking-wide">Ilham Adi Syaputra</h3>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white/95 backdrop-blur-md rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/20 flex flex-col" data-aos="fade-up" data-aos-delay="300">
                <div class="relative w-full h-80 sm:h-96 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/ferdinal.jpeg') }}" alt="Ferdinal Ruderi" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <span class="inline-block px-3.5 py-1 bg-amber-500 text-slate-950 text-xs font-bold rounded-full mb-2 tracking-wide shadow-md">Direktur</span>
                        <h3 class="text-xl font-bold tracking-wide">Ferdinal Ruderi</h3>
                    </div>
                </div>
            </div>

        </div>

        <!-- Foto Kebersamaan (Diperbaiki agar bagian atas foto turun secara penuh tanpa terpotong) -->
        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/20 bg-slate-900" data-aos="zoom-in" data-aos-delay="400">
            
            <div class="w-full flex justify-center items-center overflow-hidden bg-slate-950 py-4">
                <img src="{{ asset('images/fotobertiga.jpeg') }}" alt="Jajaran Pimpinan Perusahaan" class="w-full h-auto max-h-[650px] object-contain object-top">
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/70 to-slate-950/30 flex flex-col justify-end items-center text-center p-6 sm:p-12">
                <div class="max-w-3xl mx-auto flex flex-col items-center">
                    <h3 class="text-3xl sm:text-4xl font-black text-white tracking-wider mb-2">
                        TIM KAMI
                    </h3>
                    <div class="w-24 h-1 bg-amber-500 mb-4 rounded-full"></div>
                    <p class="text-slate-200 text-sm sm:text-base leading-relaxed font-normal">
                        Di balik pertumbuhan dan reputasi perusahaan kami, terdapat kepemimpinan visioner dari Dewan Komisaris serta eksekusi strategis yang solid dari Direktur Utama dan Direktur kami. Bersama-sama, kami membawa pengalaman bertahun-tahun di industri untuk menghadirkan solusi andal, amanah, dan berorientasi pada hasil jangka panjang bagi setiap mitra dan klien kami.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ==================== CTA SECTION ==================== --}}
<section class="cta-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 cta-content" data-aos="fade-up">
        
        <h2 class="cta-title">
            Siap membangun sesuatu yang <span class="accent">berkesan</span> bersama kami?
        </h2>

        <p class="cta-desc">
            Mari berkolaborasi untuk mewujudkan ide dan visi Anda menjadi kenyataan. Kami siap membantu dari konsep hingga eksekusi.
        </p>

        <a href="{{ route('contact') }}" class="cta-btn">
            <span>Hubungi Kami</span>
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

    </div>
</section>


</div>

@endsection