@extends('layouts.app')

@section('title', 'Layanan Kami - PT Bachri Samudera Indonesia')

@section('content')

<style>
    /* ==================== FONTS ==================== */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

    html, body { margin: 0; padding: 0; }

    .services-page { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; position: relative; }

    /* ==================== HERO HEADER ==================== */
    .services-hero {
        position: relative; width: 100%; height: 100vh; min-height: 700px;
        display: flex; align-items: center; overflow: hidden; background: #0b131e;
    }

    .services-hero-bg {
        position: absolute; inset: 0; width: 100%; height: 100%;
        object-fit: cover; object-position: center center; z-index: 0;
    }

    .services-hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(90deg,
            rgba(11, 19, 30, 0.92) 0%,
            rgba(11, 19, 30, 0.75) 50%,
            rgba(11, 19, 30, 0.35) 100%);
        z-index: 1;
    }

    .services-hero-inner { position: relative; z-index: 2; width: 100%; padding: 8rem 0 6rem; }

    .services-hero-eyebrow {
        display: inline-block; font-family: 'Outfit', sans-serif; font-weight: 700;
        font-size: 0.8rem; letter-spacing: 0.25em; text-transform: uppercase;
        margin-bottom: 1.25rem; padding: 0.4rem 1rem;
        background: rgba(240, 192, 96, 0.08);
        border: 1px solid rgba(217, 166, 48, 0.45); border-radius: 50px;
        background-image: linear-gradient(180deg, #F0C060 0%, #D9A630 55%, #A67C10 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .services-hero-title {
        font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 4.2rem;
        line-height: 1.05; letter-spacing: -0.04em; color: #ffffff;
        margin-bottom: 1.25rem; text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    }

    .services-hero-title .accent {
        display: inline-block;
        background: linear-gradient(180deg, #F0C060 0%, #D9A630 55%, #A67C10 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        color: transparent;
    }

    .services-hero-tagline {
        font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 1.35rem;
        margin-bottom: 1.25rem; letter-spacing: 0.02em;
        background: linear-gradient(180deg, #F0C060 0%, #D9A630 55%, #A67C10 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
        display: inline-block;
    }

    .services-hero-subtitle {
        font-family: 'Inter', sans-serif; font-weight: 400; font-size: 1.1rem;
        line-height: 1.7; color: rgba(255, 255, 255, 0.85);
        max-width: 620px; margin-bottom: 2.25rem;
    }

    /* ==================== MAIN BG ==================== */
    .services-unified-bg {
        position: relative; overflow: hidden;
        background-image: url("{{ asset('images/bgvisimisi.jpeg') }}");
        background-size: cover; background-position: center; background-repeat: no-repeat;
    }

    .services-unified-bg::before {
        content: ''; position: absolute; inset: 0;
        background: rgba(12, 22, 40, 0.85); z-index: 1;
    }

    /* ==================== SECTION COMMON ==================== */
    .section-header { text-align: center; margin-bottom: 3.5rem; }
    .section-badge {
        display: inline-block; padding: 0.4rem 1rem;
        background: rgba(241, 196, 15, 0.1);
        border: 1px solid rgba(241, 196, 15, 0.3);
        border-radius: 50px; font-family: 'Outfit', sans-serif; font-weight: 600;
        font-size: 0.78rem; color: #f1c40f; text-transform: uppercase;
        letter-spacing: 0.15em; margin-bottom: 1rem;
    }
    .section-title {
        font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 2.5rem;
        color: #ffffff; letter-spacing: -0.02em; margin: 0;
    }
    .section-title .gold { color: #f1c40f; }

    /* ==================== PILLARS SECTION ==================== */
    .pillars-section { padding: 6rem 0 4rem; position: relative; z-index: 2; }

    .pillars-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 2rem; max-width: 1250px; margin: 0 auto; padding: 0 1rem;
    }

    .pillar-card {
        position: relative; border-radius: 20px; overflow: hidden;
        border: 1px solid rgba(241, 196, 15, 0.4);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.7);
        display: flex; flex-direction: column;
        background-size: cover; background-position: center; background-repeat: no-repeat;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .pillar-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 30px 60px rgba(241, 196, 15, 0.25);
    }

    .pillar-card::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(180deg,
            rgba(22, 43, 73, 0.80) 0%,
            rgba(15, 30, 55, 0.88) 50%,
            rgba(11, 19, 30, 0.94) 100%);
        z-index: 1;
    }

    .pillar-card > * { position: relative; z-index: 2; }

    .pillar-card-header {
        padding: 2rem 1.75rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        display: flex; align-items: center; gap: 1.25rem;
    }

    .pillar-card-icon-box {
        width: 65px; height: 65px; border-radius: 50%;
        border: 2px solid rgba(241, 196, 15, 0.65);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; background: rgba(241, 196, 15, 0.08);
        box-shadow: 0 0 20px rgba(241, 196, 15, 0.15),
                    inset 0 0 15px rgba(241, 196, 15, 0.05);
    }

    .pillar-card-icon-box svg { width: 34px; height: 34px; color: #f1c40f; stroke: #f1c40f; }

    .pillar-card-titles h3 {
        font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.75rem;
        color: #ffffff; margin: 0 0 0.15rem 0; letter-spacing: 0.03em;
    }

    .pillar-card-titles p {
        font-size: 0.9rem; color: rgba(255, 255, 255, 0.75);
        margin: 0; font-weight: 500;
    }

    .pillar-card-body {
        padding: 1.75rem; flex-grow: 1;
        display: flex; flex-direction: column; justify-content: space-between;
    }

    .service-list {
        list-style: none; padding: 0; margin: 0 0 2rem 0;
        display: flex; flex-direction: column; gap: 1rem;
    }

    .service-list li {
        display: flex; align-items: center; gap: 14px;
        font-size: 1.02rem; font-weight: 600; color: #ffffff;
    }

    .service-list li svg { width: 22px; height: 22px; color: #f39c12; flex-shrink: 0; }

    .benefits-box {
        background: rgba(0, 0, 0, 0.55);
        border: 1px solid rgba(241, 196, 15, 0.3);
        border-radius: 14px; padding: 1.25rem 1.5rem; backdrop-filter: blur(5px);
    }

    .benefits-title {
        font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.05rem;
        color: #f1c40f; margin-bottom: 0.75rem;
    }

    .benefits-list {
        list-style: none; padding: 0; margin: 0;
        display: flex; flex-direction: column; gap: 0.6rem;
    }

    .benefits-list li {
        font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);
        display: flex; align-items: flex-start; gap: 10px;
        line-height: 1.4; font-weight: 500;
    }

    .benefits-list li::before {
        content: "•"; color: #f1c40f; font-weight: bold;
        font-size: 1.2rem; line-height: 1;
    }

    /* ==================== PROCESS TIMELINE (UPDATED) ==================== */
.process-timeline-section { padding: 2rem 0 4rem; position: relative; z-index: 2; }

.process-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.process-card {
    background: rgba(11, 19, 30, 0.9);
    border: 1px solid rgba(241, 196, 15, 0.3);
    border-radius: 16px;
    padding: 2rem 1.5rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.25rem;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
}

.process-card:hover {
    transform: translateY(-5px);
    border-color: rgba(241, 196, 15, 0.8);
    box-shadow: 0 15px 35px rgba(241, 196, 15, 0.15);
}

.process-icon-box {
    width: 55px; height: 55px;
    background: rgba(241, 196, 15, 0.1);
    border: 1px solid rgba(241, 196, 15, 0.4);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #f1c40f; flex-shrink: 0;
    transition: all 0.3s ease;
}

.process-card:hover .process-icon-box {
    background: #f1c40f;
    color: #0b131e;
    box-shadow: 0 0 20px rgba(241, 196, 15, 0.5);
}

.process-icon-box svg { width: 24px; height: 24px; }

.process-text h5 {
    font-family: 'Outfit', sans-serif; font-weight: 700;
    font-size: 1.05rem; color: #ffffff; margin: 0;
}

/* ==================== FAQ (UPDATED) ==================== */
.faq-section { padding: 4rem 0 5rem; position: relative; z-index: 3; }

.faq-light-box {
    max-width: 1200px; margin: 0 auto; padding: 0;
    background: transparent;
    box-shadow: none;
    border: none;
}

.faq-title-light {
    font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 2rem;
    color: #ffffff; text-align: center; margin: 0 0 2.5rem 0;
    letter-spacing: -0.02em;
}

.faq-title-light::after {
    content: ''; display: block; width: 70px; height: 4px;
    background: linear-gradient(90deg, #d4a017, #f1c40f);
    border-radius: 2px; margin: 0.9rem auto 0;
}

.faq-grid {
    display: grid; grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem; align-items: start;
}

.faq-item {
    background: #ffffff; border: 1px solid #e5e7eb;
    border-radius: 12px; padding: 0; overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.faq-item:hover {
    border-color: #d4a017;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.faq-item[open] {
    border-color: #d4a017;
    box-shadow: 0 10px 20px rgba(212, 160, 23, 0.15);
}

.faq-item-q {
    font-family: 'Inter', sans-serif; font-weight: 600; font-size: 1rem;
    color: #1e2f55; line-height: 1.5; padding: 1.25rem 1.5rem;
    cursor: pointer; display: flex; justify-content: space-between;
    align-items: center; gap: 1rem; list-style: none;
    user-select: none; transition: background 0.25s ease; margin: 0;
}

.faq-item-q::-webkit-details-marker { display: none; }
.faq-item-q::marker { display: none; content: ''; }
.faq-item-q:hover { background: rgba(30, 47, 85, 0.02); }

.faq-icon {
    width: 20px; height: 20px; flex-shrink: 0;
    color: #1e2f55;
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.3s ease;
}

.faq-item[open] .faq-icon {
    transform: rotate(45deg);
    color: #d4a017;
}

.faq-item-a {
    font-family: 'Inter', sans-serif; font-weight: 400; font-size: 0.95rem;
    color: #4b5563; line-height: 1.65;
    padding: 0 1.5rem 1.25rem 1.5rem; margin: 0;
    animation: faqSlideDown 0.3s ease;
}

@keyframes faqSlideDown {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Responsive untuk FAQ & Process */
@media (max-width: 991.98px) {
    .faq-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    .faq-title-light { font-size: 1.6rem; }
    .faq-item-q { padding: 1rem 1.25rem; font-size: 0.95rem; }
    .faq-item-a { padding: 0 1.25rem 1rem 1.25rem; font-size: 0.9rem; }
    .process-grid { grid-template-columns: 1fr; }
}

    /* ==================== PORTOFOLIO ==================== */
    .portfolio-section { padding: 4rem 0 5rem; position: relative; z-index: 2; }

    .portfolio-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 1.75rem; max-width: 1200px; margin: 0 auto; padding: 0 1rem;
    }

    .portfolio-card {
        background: rgba(11, 19, 30, 0.85);
        border: 1px solid rgba(241, 196, 15, 0.3);
        border-radius: 16px; overflow: hidden; display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .portfolio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(241, 196, 15, 0.2);
        border-color: rgba(241, 196, 15, 0.7);
    }

    .portfolio-image-wrapper { width: 100%; height: 210px; overflow: hidden; position: relative; }

    .portfolio-image-wrapper img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.5s ease;
    }

    .portfolio-card:hover .portfolio-image-wrapper img { transform: scale(1.08); }

    .portfolio-content {
        padding: 1.25rem 1.4rem; flex-grow: 1;
        display: flex; flex-direction: column; gap: 0.4rem;
        background: linear-gradient(180deg, rgba(11, 19, 30, 0.95) 0%, rgba(18, 28, 43, 0.98) 100%);
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .portfolio-title {
        font-family: 'Outfit', sans-serif; font-weight: 700;
        font-size: 1.02rem; color: #ffffff; margin: 0; line-height: 1.4;
    }

    .portfolio-client {
        font-family: 'Inter', sans-serif; font-size: 0.82rem;
        color: #f1c40f; margin: 0; font-weight: 600; letter-spacing: 0.03em;
    }

    /* ==================== EXPERIENCE CAROUSEL (ENHANCED) ==================== */
    .experience-section { padding: 4rem 0 5rem; position: relative; z-index: 3; }

    .experience-header {
        max-width: 1400px;
        margin: 0 auto 2.25rem;
        padding: 0 3.5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .experience-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 2.4rem;
        color: #ffffff;
        margin: 0;
        letter-spacing: -0.02em;
        display: inline-block;
    }

    .experience-title .gold { color: #f1c40f; }

    .experience-title::after {
        content: '';
        display: block;
        width: 85px;
        height: 5px;
        background: linear-gradient(90deg, #d4a017, #f1c40f);
        border-radius: 3px;
        margin-top: 0.75rem;
    }

    /* Autoplay progress bar */
    .exp-progress {
        flex: 1;
        min-width: 120px;
        max-width: 220px;
        height: 3px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.75rem;
        position: relative;
    }

    .exp-progress-bar {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #d4a017, #f1c40f);
        border-radius: 2px;
        transition: width 0.1s linear;
    }

    .exp-progress.paused .exp-progress-bar {
        opacity: 0.4;
    }

    .experience-carousel-wrap {
        position: relative;
        max-width: 1400px;
        margin: 0 auto;
    }

    .experience-carousel {
        display: flex;
        gap: 1.5rem;
        overflow-x: auto;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
        padding: 0.5rem 3.5rem 1.5rem;
        scrollbar-width: none;
        -ms-overflow-style: none;
        cursor: grab;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior-x: contain;
    }

    .experience-carousel::-webkit-scrollbar { display: none; }
    .experience-carousel.dragging { cursor: grabbing; scroll-snap-type: none; scroll-behavior: auto; }
    .experience-carousel.dragging .exp-card { pointer-events: none; }
    .experience-carousel:focus { outline: none; }
    .experience-carousel:focus-visible { outline: 2px solid rgba(241, 196, 15, 0.5); outline-offset: 4px; border-radius: 12px; }

    .exp-card {
        flex: 0 0 360px;
        scroll-snap-align: start;
        border-radius: 12px;
        overflow: hidden;
        background: #1e2f55;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.55);
        transition: transform 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                    opacity 0.7s ease;
        display: flex;
        flex-direction: column;
        height: 420px;
        user-select: none;
        opacity: 0.6;
        transform: scale(0.96);
    }

    .exp-card.is-active {
        opacity: 1;
        transform: scale(1);
        box-shadow: 0 25px 55px rgba(0, 0, 0, 0.75);
        border: 1px solid rgba(241, 196, 15, 0.35);
    }

    .exp-card:hover {
        transform: translateY(-8px) scale(1);
        box-shadow: 0 30px 65px rgba(0, 0, 0, 0.8), 0 0 30px rgba(241, 196, 15, 0.15);
    }

    .exp-card-image {
        width: 100%;
        height: 230px;
        overflow: hidden;
        background: #0b131e;
        position: relative;
        flex-shrink: 0;
    }

    .exp-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        pointer-events: none;
        -webkit-user-drag: none;
    }

    .exp-card:hover .exp-card-image img { transform: scale(1.08); }

    .exp-card-image.placeholder {
        background: linear-gradient(135deg, #1e2f55 0%, #2c4373 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .exp-card-image.placeholder span {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 3.5rem;
        color: #f1c40f;
        letter-spacing: 0.05em;
        opacity: 0.9;
    }

    .exp-card-info {
        flex: 1;
        background: #1e2f55;
        padding: 1.35rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
        border-top: 3px solid #d4a017;
    }

    .exp-card-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.2rem;
        color: #ffffff;
        margin: 0;
        line-height: 1.25;
        letter-spacing: -0.01em;
    }

    .exp-card-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.87rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.55;
        margin: 0;
    }

    /* ============ NAV BUTTONS ============ */
    .exp-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: rgba(11, 19, 30, 0.85);
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        backdrop-filter: blur(8px);
        padding: 0;
    }

    .exp-nav:hover {
        background: #d4a017;
        border-color: #d4a017;
        transform: translateY(-50%) scale(1.12);
        box-shadow: 0 8px 30px rgba(212, 160, 23, 0.6);
    }

    .exp-nav:active { transform: translateY(-50%) scale(0.95); }

    .exp-nav svg { width: 22px; height: 22px; transition: transform 0.3s ease; }
    .exp-nav-prev:hover svg { transform: translateX(-3px); }
    .exp-nav-next:hover svg { transform: translateX(3px); }

    .exp-nav-prev { left: 1rem; }
    .exp-nav-next { right: 1rem; }

    /* ============ DOTS ============ */
    .exp-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 1.75rem;
        padding: 0 1rem;
        flex-wrap: wrap;
    }

    .exp-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        padding: 0;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
    }

    .exp-dot::before {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 50%;
    }

    .exp-dot:hover {
        background: rgba(255, 255, 255, 0.5);
        transform: scale(1.3);
    }

    .exp-dot.active {
        background: #f1c40f;
        width: 28px;
        border-radius: 4px;
        box-shadow: 0 0 12px rgba(241, 196, 15, 0.6);
    }

    /* ==================== FAQ ==================== */
    .faq-section { padding: 4rem 0 5rem; position: relative; z-index: 3; }

    .faq-light-box {
        max-width: 1150px; margin: 0 auto; padding: 3rem 2rem 3.5rem;
        background: #f5f4f0;
        background-image:
            radial-gradient(circle at 15% 20%, rgba(200, 200, 200, 0.15) 0%, transparent 40%),
            radial-gradient(circle at 85% 80%, rgba(200, 200, 200, 0.12) 0%, transparent 40%);
        border-radius: 20px; box-shadow: 0 25px 70px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .faq-title-light {
        font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 2rem;
        color: #1e2f55; text-align: center; margin: 0 0 2.25rem 0;
        letter-spacing: -0.02em;
    }

    .faq-title-light::after {
        content: ''; display: block; width: 70px; height: 4px;
        background: linear-gradient(90deg, #d4a017, #f1c40f);
        border-radius: 2px; margin: 0.9rem auto 0;
    }

    .faq-grid {
        display: grid; grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem; align-items: start;
    }

    .faq-item {
        background: #ffffff; border: 1px solid #c9c9c9;
        border-radius: 10px; padding: 0; overflow: hidden;
        transition: box-shadow 0.3s ease, border-color 0.3s ease, background 0.3s ease;
    }

    .faq-item:hover {
        box-shadow: 0 8px 20px rgba(30, 47, 85, 0.12);
        border-color: #1e2f55;
    }

    .faq-item[open] {
        border-color: #1e2f55;
        box-shadow: 0 10px 25px rgba(30, 47, 85, 0.18);
        background: #fbfbf8;
    }

    .faq-item-q {
        font-family: 'Inter', sans-serif; font-weight: 700; font-size: 0.95rem;
        color: #1e2f55; line-height: 1.45; padding: 1.2rem 1.4rem;
        cursor: pointer; display: flex; justify-content: space-between;
        align-items: flex-start; gap: 0.75rem; list-style: none;
        user-select: none; transition: background 0.25s ease; margin: 0;
    }

    .faq-item-q::-webkit-details-marker { display: none; }
    .faq-item-q::marker { display: none; content: ''; }
    .faq-item-q:hover { background: rgba(30, 47, 85, 0.04); }
    .faq-item[open] .faq-item-q {
        border-bottom: 1px solid #e5e5e0;
        background: rgba(30, 47, 85, 0.03);
    }

    .faq-chevron {
        width: 18px; height: 18px; flex-shrink: 0; margin-top: 2px;
        color: #1e2f55;
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .faq-item[open] .faq-chevron {
        transform: rotate(180deg); color: #d4a017;
    }

    .faq-item-a {
        font-family: 'Inter', sans-serif; font-weight: 400; font-size: 0.9rem;
        color: #333333; line-height: 1.65;
        padding: 0 1.4rem 1.2rem 1.4rem; margin: 0;
        animation: faqSlideDown 0.35s ease;
    }

    @keyframes faqSlideDown {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ==================== CTA ==================== */
    .cta-banner-section { padding: 2rem 0 6rem; position: relative; z-index: 2; text-align: center; }

    .cta-banner-box {
        max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;
        background: linear-gradient(135deg, rgba(11, 19, 30, 0.88) 0%, rgba(11, 19, 30, 0.75) 100%), 
                    url("{{ asset('images/layanan.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border: 2px solid rgba(212, 160, 23, 0.4);
        border-radius: 24px; backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .cta-banner-title {
        font-family: 'Outfit', sans-serif; font-weight: 800;
        font-size: 2.5rem; color: #ffffff; margin-bottom: 1rem;
    }

    .cta-banner-desc {
        font-size: 1.05rem; color: rgba(255, 255, 255, 0.85);
        max-width: 620px; margin: 0 auto 2rem; line-height: 1.6;
    }

    .btn-cta {
        display: inline-flex; align-items: center; gap: 10px;
        padding: 0.9rem 2.5rem;
        background: linear-gradient(180deg, #F0C060 0%, #D9A630 55%, #A67C10 100%);
        color: #12173F;
        border-radius: 8px; font-family: 'Outfit', sans-serif;
        font-weight: 700; font-size: 0.95rem; text-decoration: none;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 10px 25px -5px rgba(217, 166, 48, 0.55);
    }

    .btn-cta:hover {
        background: linear-gradient(180deg, #D9A630 0%, #C99521 55%, #8A6610 100%);
        transform: translateY(-2px);
        color: #12173F;
    }

    /* ==================== COLLAGE ==================== */
    .full-bleed-collage {
        position: relative; width: 100%; height: 450px;
        background: #060a10; overflow: hidden;
        display: flex; align-items: flex-end; justify-content: flex-end;
        padding: 0; margin: 0; border: none;
    }

    .full-bleed-collage::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(90deg, #060a10 0%, #0b131e 35%, rgba(11, 19, 30, 0.1) 100%);
        z-index: 10; pointer-events: none;
    }

    .collage-wrapper {
        position: relative; width: 100%; height: 100%;
        transform: skewX(-8deg) scale(1.1);
        display: flex; gap: 1.5rem; align-items: flex-end;
        justify-content: flex-end; padding-right: 5%; padding-bottom: 0;
    }

    .collage-item {
        position: relative; width: 22%;
        border-radius: 12px 12px 0 0; overflow: hidden;
        box-shadow: -15px 20px 50px rgba(0, 0, 0, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: none;
        transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-origin: bottom center;
    }

    .collage-item img { width: 100%; height: 100%; object-fit: cover; transform: skewX(8deg) scale(1.2); }
    .collage-item:nth-child(1) { height: 45%; }
    .collage-item:nth-child(2) { height: 65%; }
    .collage-item:nth-child(3) { height: 85%; }
    .collage-item:nth-child(4) { height: 60%; }
    .collage-item:nth-child(5) { height: 40%; }

    .collage-item:hover {
        transform: scale(1.05) translateY(-5px); z-index: 20;
        border-color: #f1c40f;
        box-shadow: 0 0 30px rgba(241, 196, 15, 0.4);
    }

    /* ============================================================
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

    /* ==================== WHATSAPP ==================== */
    .floating-whatsapp {
        position: fixed; bottom: 30px; right: 30px; z-index: 99999;
        background-color: #25d366; color: #ffffff;
        width: 60px; height: 60px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
    }

    .floating-whatsapp:hover {
        transform: scale(1.1) translateY(-3px);
        box-shadow: 0 12px 30px rgba(37, 211, 102, 0.7);
        color: #ffffff;
    }

    .floating-whatsapp svg { width: 32px; height: 32px; fill: #ffffff; }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 1024px) {
        .pillars-grid { grid-template-columns: 1fr; max-width: 600px; }
        .portfolio-grid { grid-template-columns: repeat(2, 1fr); }
        .process-bar { flex-direction: column; gap: 1.5rem; align-items: flex-start; }
        .process-arrow { display: none; }
        .footer-grid { grid-template-columns: 1fr; gap: 2.5rem; }

        .full-bleed-collage { height: auto; padding: 4rem 0; }
        .collage-wrapper { flex-wrap: wrap; transform: none; justify-content: center; padding: 0 1rem; gap: 1rem; align-items: center; }
        .collage-item { width: 40%; height: 180px !important; margin: 0 !important; transform: none; border-radius: 12px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .collage-item img { transform: none; }
    }

    @media (max-width: 991.98px) {
        .services-hero { height: auto; min-height: 80vh; }
        .services-hero-title { font-size: 3rem; }
        .services-hero-inner { padding: 7rem 0 5rem; }
        .faq-grid { grid-template-columns: 1fr; }

        .experience-header { padding: 0 2rem; }
        .experience-title { font-size: 2rem; }
        .experience-carousel { padding: 0.5rem 2rem 1.5rem; }
        .exp-card { flex: 0 0 320px; }
    }

    @media (max-width: 640px) {
        .services-hero { min-height: 100vh; }
        .services-hero-title { font-size: 2.2rem; }
        .services-hero-tagline { font-size: 1.1rem; }
        .section-title { font-size: 1.9rem; }
        .cta-banner-title { font-size: 1.8rem; }
        .portfolio-grid { grid-template-columns: 1fr; }
        .collage-item { width: 80%; height: 150px !important; }

        .faq-light-box { padding: 2rem 1rem 2.5rem; border-radius: 14px; }
        .faq-title-light { font-size: 1.5rem; }
        .faq-item-q { padding: 1rem 1.1rem; font-size: 0.9rem; }
        .faq-item-a { padding: 0 1.1rem 1rem 1.1rem; font-size: 0.85rem; }

        .experience-header { padding: 0 1rem; margin-bottom: 1.5rem; flex-direction: column; align-items: flex-start; }
        .experience-title { font-size: 1.6rem; }
        .experience-title::after { width: 60px; height: 4px; }
        .exp-progress { max-width: 100%; width: 100%; margin-bottom: 0; }
        .experience-carousel { padding: 0.5rem 1rem 1rem; gap: 1rem; }
        .exp-card { flex: 0 0 85%; height: 400px; }
        .exp-card-image { height: 200px; }
        .exp-nav { display: none; }
        .exp-dots { margin-top: 1.25rem; }
        .footer-bottom { flex-direction: column; gap: 0.75rem; text-align: center; }
    }
</style>

<div class="services-page">

{{-- ==================== HERO ==================== --}}
<section class="services-hero">
    <img src="{{ asset('images/hly.jpeg') }}" alt="Layanan PT Bachri Samudera Indonesia" class="services-hero-bg">
    <div class="services-hero-overlay"></div>

    <div class="services-hero-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <span class="services-hero-eyebrow">Layanan Kami</span>
            <h1 class="services-hero-title">
                <span class="accent">Create.</span> <span class="accent">Build.</span> <span class="accent">Grow.</span>
            </h1>
            <p class="services-hero-tagline">Solusi Kreatif Terintegrasi</p>
            <p class="services-hero-subtitle">
                Kami menghadirkan solusi kreatif di bidang Konstruksi, Exterior &amp; Interior, Event Management, desain, dan periklanan untuk membangun brand, ruang, dan pengalaman yang berdampak.
            </p>
            <div>
                <a href="{{ url('/contact') }}" class="btn-cta">
                    Konsultasikan Kebutuhan Anda
                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ==================== MAIN BG ==================== --}}
<div class="services-unified-bg">

    {{-- PILLARS --}}
    <section class="pillars-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-header">
                <span class="section-badge">Layanan Unggulan</span>
                <h2 class="section-title">Detail &amp; Manfaat <span class="gold">Layanan</span></h2>
            </div>

            <div class="pillars-grid">

                <div class="pillar-card" style="background-image: url('{{ asset('images/Gcreat.png') }}');">
                    <div class="pillar-card-header">
                        <div class="pillar-card-icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18h6M10 22h4"/>
                                <path d="M12 2a7 7 0 00-4.5 12.35c.6.5 1 1.35 1 2.15v.5h7v-.5c0-.8.4-1.65 1-2.15A7 7 0 0012 2z"/>
                            </svg>
                        </div>
                        <div class="pillar-card-titles">
                            <h3>CREATE</h3>
                            <p>Kreasi Tanpa Batas</p>
                        </div>
                    </div>
                    <div class="pillar-card-body">
                        <ul class="service-list">
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Desain Kreatif</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Branding</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Visual Design</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Advertising</li>
                        </ul>
                        <div class="benefits-box">
                            <div class="benefits-title">Manfaat :</div>
                            <ul class="benefits-list">
                                <li>Solusi end-to-end</li>
                                <li>Kualitas hasil terbaik</li>
                                <li>Produksi kreatif mandiri</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="pillar-card" style="background-image: url('{{ asset('images/Gbuild.png') }}');">
                    <div class="pillar-card-header">
                        <div class="pillar-card-icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
                            </svg>
                        </div>
                        <div class="pillar-card-titles">
                            <h3>BUILD</h3>
                            <p>Membangun dengan Kualitas</p>
                        </div>
                    </div>
                    <div class="pillar-card-body">
                        <ul class="service-list">
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Konstruksi</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Eksterior &amp; Interior</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Produksi</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Instalasi</li>
                        </ul>
                        <div class="benefits-box">
                            <div class="benefits-title">Manfaat :</div>
                            <ul class="benefits-list">
                                <li>Tim berpengalaman</li>
                                <li>Standar kualitas tinggi</li>
                                <li>Eksekusi efisien &amp; tepat waktu</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="pillar-card" style="background-image: url('{{ asset('images/Ggrow.png') }}');">
                    <div class="pillar-card-header">
                        <div class="pillar-card-icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                                <polyline points="17 6 23 6 23 12"/>
                            </svg>
                        </div>
                        <div class="pillar-card-titles">
                            <h3>GROW</h3>
                            <p>Bersama untuk Berkembang</p>
                        </div>
                    </div>
                    <div class="pillar-card-body">
                        <ul class="service-list">
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Event Management</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Training / Monitoring</li>
                            <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Community &amp; Business Development</li>
                        </ul>
                        <div class="benefits-box">
                            <div class="benefits-title">Manfaat :</div>
                            <ul class="benefits-list">
                                <li>Solusi end-to-end</li>
                                <li>Tim profesional</li>
                                <li>Hasil berdampak &amp; berkelanjutan</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

        {{-- PROCESS TIMELINE (UPDATED) --}}
    <section class="process-timeline-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-header" style="margin-bottom: 2.5rem;">
                <span class="section-badge">Alur Kerja</span>
                <h2 class="section-title" style="font-size: 1.9rem;">Proses <span class="gold">Kami</span></h2>
            </div>
            
            <div class="process-grid">
                <!-- Step 1 -->
                <div class="process-card">
                    <div class="process-icon-box">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <div class="process-text"><h5>Konsep</h5></div>
                </div>
                <!-- Step 2 -->
                <div class="process-card">
                    <div class="process-icon-box">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="process-text"><h5>Desain</h5></div>
                </div>
                <!-- Step 3 -->
                <div class="process-card">
                    <div class="process-icon-box">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="process-text"><h5>Produksi</h5></div>
                </div>
                <!-- Step 4 -->
                <div class="process-card">
                    <div class="process-icon-box">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div class="process-text"><h5>Instalasi</h5></div>
                </div>
                <!-- Step 5 -->
                <div class="process-card">
                    <div class="process-icon-box">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="process-text"><h5>Pengelolaan</h5></div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ (UPDATED) --}}
    <section class="faq-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="faq-light-box">
                <h2 class="faq-title-light">Pertanyaan Umum</h2>
                <div class="faq-grid">

                    <details class="faq-item">
                        <summary class="faq-item-q">
                            <span>Apa saja layanan utama yang ditawarkan oleh PT Bachri Samudera Indonesia?</span>
                            <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </summary>
                        <p class="faq-item-a">Kami adalah perusahaan multibisnis yang bergerak di bidang Konstruksi, Exterior &amp; Interior, Event Management, Desain, serta Periklanan. Kami hadir memberikan solusi kreatif untuk membangun brand, ruang, dan pengalaman.</p>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item-q">
                            <span>Bagaimana sistem penentuan harga atau biaya untuk sebuah proyek (Interior, Event, atau Konstruksi)?</span>
                            <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </summary>
                        <p class="faq-item-a">Biaya proyek sangat fleksibel dan akan disesuaikan dengan skala proyek, spesifikasi material, dan kebutuhan khusus klien.</p>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item-q">
                            <span>Apakah layanannya hanya sebatas pembuatan desain, atau mencakup tahap produksi dan eksekusi?</span>
                            <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </summary>
                        <p class="faq-item-a">Kami melayani segalanya dari awal hingga akhir. Kami memastikan setiap solusi visual dan branding memiliki kualitas terbaik dari tahap konsep hingga eksekusi. Selain itu, kami juga memiliki kemampuan desain kreatif dan produksi mandiri.</p>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item-q">
                            <span>Apakah PT Bachri Samudera Indonesia dapat menangani proyek yang terintegrasi, misalnya pembuatan booth pameran (konstruksi/interior) sekaligus aktivasi acaranya (event management)?</span>
                            <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </summary>
                        <p class="faq-item-a">Ya, PT Bachri Samudera Indonesia dapat menangani proyek terintegrasi mulai dari pembuatan booth (konstruksi/interior) hingga aktivasi acara (event management). Keunggulan produksi mandiri dan konsep layanan satu pintu membuat seluruh proses dari desain, pembangunan, hingga eksekusi promosi berjalan lebih efisien.</p>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item-q">
                            <span>Bagaimana pengalaman tim dalam menangani Event Organizer, terutama jika terjadi situasi darurat di lapangan?</span>
                            <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </summary>
                        <p class="faq-item-a">Sebagai profesional yang berpengalaman di industri Event Organizer, tim kami senantiasa berinovasi dan sangat cepat tanggap terhadap kebutuhan klien. Kami terbiasa dan mampu mengelola berbagai situasi di lapangan, termasuk kondisi darurat sekalipun.</p>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item-q">
                            <span>Bagaimana tahapan atau alur kerja sama pengerjaan proyek di PT Bachri Samudera Indonesia dari awal hingga selesai?</span>
                            <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </summary>
                        <p class="faq-item-a">Kami berkomitmen untuk memastikan setiap solusi visual dan branding memiliki kualitas terbaik mulai dari tahap konsep hingga tahap eksekusi.</p>
                    </details>

                </div>
            </div>
        </div>
    </section>

    {{-- PORTOFOLIO --}}
    <section class="portfolio-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-header">
                <span class="section-badge">Karya Kami</span>
                <h2 class="section-title">Portofolio <span class="gold">Layanan</span></h2>
            </div>

            <div class="portfolio-grid">

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 8.png') }}" alt="Wifi Corner Container"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">PT Telkom Indonesia</p>
                        <h4 class="portfolio-title">Wifi Corner Container Double Deck Bandung</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 9.png') }}" alt="Wifi Corner Solo"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">PT Telkom Indonesia</p>
                        <h4 class="portfolio-title">Wifi Corner Plasa Telkom Solo</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 10.png') }}" alt="Wifi Corner Jayapura"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">PT Telkom Indonesia</p>
                        <h4 class="portfolio-title">Wifi Corner Jayapura</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 11.png') }}" alt="Interior Lobby iMoto"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">Interior &amp; Eksterior</p>
                        <h4 class="portfolio-title">Interior Lobby iMoto Cikarang</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 12.png') }}" alt="Exhibition Booth"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">Event &amp; Exhibition</p>
                        <h4 class="portfolio-title">Exhibition Booth</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 13.png') }}" alt="Smart Plasa / Kiosk"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">PT Telkom Indonesia</p>
                        <h4 class="portfolio-title">Smart Plasa / Kiosk</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 14.png') }}" alt="Queue Machine"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">Digital Solution</p>
                        <h4 class="portfolio-title">Queue Machine</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 15.png') }}" alt="Signage / Logo"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">Branding &amp; Signage</p>
                        <h4 class="portfolio-title">Signage / Logo</h4>
                    </div>
                </div>

                <div class="portfolio-card">
                    <div class="portfolio-image-wrapper"><img src="{{ asset('images/Group 16.png') }}" alt="Event / Training"></div>
                    <div class="portfolio-content">
                        <p class="portfolio-client">Hewlett-Packard Indonesia</p>
                        <h4 class="portfolio-title">Workshop, Gathering &amp; Training</h4>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ==================== EXPERIENCE CAROUSEL ==================== --}}
    <section class="experience-section">

        <div class="experience-header">
            <h2 class="experience-title">Pengalaman <span class="gold">Klien</span></h2>
            <div class="exp-progress" id="expProgress">
                <div class="exp-progress-bar" id="expProgressBar"></div>
            </div>
        </div>

        <div class="experience-carousel-wrap">

            <div class="experience-carousel" id="expCarousel" tabindex="0" aria-label="Pengalaman Klien Carousel">

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/hp.png') }}" alt="Hewlett-Packard Indonesia"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">Hewlett-Packard Indonesia</h3>
                        <p class="exp-card-desc">Workshop internal, gathering &amp; training untuk mendukung pengembangan tim dan kolaborasi.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/telkom.png') }}" alt="PT Telkom Indonesia"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">PT Telkom Indonesia</h3>
                        <p class="exp-card-desc">Desain, produksi &amp; instalasi berbagai WIFI Corner dan ruang layanan di beberapa lokasi di Indonesia.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/pegadaian.png') }}" alt="Pegadaian"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">Pegadaian</h3>
                        <p class="exp-card-desc">Desain dan produksi media visual, interior ruang layanan, serta kebutuhan branding di berbagai lokasi.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/imoto.png') }}" alt="IMOTO Indonesia"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">IMOTO Indonesia</h3>
                        <p class="exp-card-desc">Interior, showroom, shop sign, serta produksi dan instalasi.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/tvs.png') }}" alt="TVS Indonesia"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">TVS Indonesia</h3>
                        <p class="exp-card-desc">Exterior, interior, façade, shop sign, dan renovasi showroom.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/waskita.png') }}" alt="Waskita Modern Realty"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">Waskita Modern Realty</h3>
                        <p class="exp-card-desc">Pembangunan rumah contoh proyek perumahan AVASTA.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/yl.png') }}" alt="General Electrical"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">General Electrical</h3>
                        <p class="exp-card-desc">Desain dan produksi exhibition booth profesional.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/abda.png') }}" alt="ABDA Insurance"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">ABDA Insurance</h3>
                        <p class="exp-card-desc">Produksi dan instalasi logo galvanis skala besar.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/yl.png') }}" alt="YLC Tax"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">YLC Tax</h3>
                        <p class="exp-card-desc">Produksi dan instalasi logo galvanis skala besar.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/aisin.png') }}" alt="AISIN Indonesia"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">AISIN Indonesia</h3>
                        <p class="exp-card-desc">Produksi dan instalasi signboard di beberapa lokasi.</p>
                    </div>
                </div>

                <div class="exp-card">
                    <div class="exp-card-image"><img src="{{ asset('images/jayaproperty.png') }}" alt="PT Pembangunan Jaya"></div>
                    <div class="exp-card-info">
                        <h3 class="exp-card-title">PT Pembangunan Jaya</h3>
                        <p class="exp-card-desc">Layanan kebersihan dan mobilisasi pengangkutan sampah.</p>
                    </div>
                </div>

            </div>

        </div>

        {{-- DOTS --}}
        <div class="exp-dots" id="expDots" role="tablist" aria-label="Carousel navigation"></div>

    </section>

    

    {{-- CTA --}}
    <section class="cta-banner-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="cta-banner-box">
                <h2 class="cta-banner-title">Siap Mewujudkan Proyek Anda?</h2>
                <p class="cta-banner-desc">Konsultasikan kebutuhan konstruksi, interior, event, atau periklanan Anda bersama tim profesional PT Bachri Samudera Indonesia.</p>
                <a href="{{ url('/contact') }}" class="btn-cta">Hubungi Kami Sekarang</a>
            </div>
        </div>
    </section>

</div>

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
                <span>Telepon: <a href="tel:085714141802" class="footer-contact-link">085714141802</a></span>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} PT Bachri Samudera Indonesia. All rights reserved.</p>
        <p>Professional &amp; Reliable Service</p>
    </div>
</footer>

{{-- WHATSAPP --}}
<a href="https://wa.me/6285714141802?text=Halo%2C%20saya%20ingin%20berkonsultasi%20mengenai%20layanan%20PT%20Bachri%20Samudera%20Indonesia." target="_blank" class="floating-whatsapp" title="Hubungi Kami via WhatsApp">
    <svg viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.00"/>
    </svg>
</a>

{{-- ==================== SCRIPTS ==================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ---------- FAQ Accordion (exclusive) ---------- */
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        item.addEventListener('toggle', function () {
            if (this.open) {
                faqItems.forEach(other => {
                    if (other !== this) other.removeAttribute('open');
                });
            }
        });
    });

    /* ---------- Experience Carousel ---------- */
    const carousel = document.getElementById('expCarousel');
    if (!carousel) return;

    const cards = carousel.querySelectorAll('.exp-card');
    const dotsWrap = document.getElementById('expDots');
    const progressBar = document.getElementById('expProgressBar');
    const progressWrap = document.getElementById('expProgress');

    const AUTOPLAY_MS = 5000;
    let autoplayTimer = null;
    let progressTimer = null;
    let isPaused = false;
    let isDragging = false;
    let dragStartX = 0;
    let dragStartScroll = 0;
    let dragMoved = false;

    /* --- Build dots --- */
    cards.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'exp-dot';
        dot.type = 'button';
        dot.setAttribute('role', 'tab');
        dot.setAttribute('aria-label', 'Slide ' + (i + 1));
        dot.addEventListener('click', () => {
            scrollToCard(i);
            resetAutoplay();
        });
        dotsWrap.appendChild(dot);
    });
    const dots = dotsWrap.querySelectorAll('.exp-dot');

    function getStep() {
        const gap = parseFloat(getComputedStyle(carousel).columnGap) || 0;
        return cards[0].offsetWidth + gap;
    }

    function updateUI() {
        const step = getStep();
        const index = Math.round(carousel.scrollLeft / step);
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
    }

    function updateActiveCard() {
        const carouselRect = carousel.getBoundingClientRect();
        const carouselCenter = carouselRect.left + carouselRect.width / 2;
        let closestCard = null;
        let closestDist = Infinity;

        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const cardCenter = rect.left + rect.width / 2;
            const dist = Math.abs(cardCenter - carouselCenter);
            if (dist < closestDist) {
                closestDist = dist;
                closestCard = card;
            }
        });

        cards.forEach(card => card.classList.toggle('is-active', card === closestCard));
    }

    function scrollToCard(index) {
        const step = getStep();
        carousel.scrollTo({ left: index * step, behavior: 'smooth' });
    }

    function nextCard() {
        const step = getStep();
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        if (carousel.scrollLeft >= maxScroll - 8) {
            carousel.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: step, behavior: 'smooth' });
        }
    }

    function prevCard() {
        const step = getStep();
        if (carousel.scrollLeft <= 8) {
            carousel.scrollTo({ left: carousel.scrollWidth, behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: -step, behavior: 'smooth' });
        }
    }

    /* --- Autoplay + progress bar --- */
    function startAutoplay() {
        stopAutoplay();
        progressBar.style.width = '0%';
        progressWrap.classList.remove('paused');

        let start = performance.now();
        function tick(now) {
            if (isPaused || isDragging) {
                start = now - (progressBar.offsetWidth / progressWrap.offsetWidth) * AUTOPLAY_MS;
            }
            const elapsed = now - start;
            const pct = Math.min((elapsed / AUTOPLAY_MS) * 100, 100);
            progressBar.style.width = pct + '%';
            if (pct < 100) progressTimer = requestAnimationFrame(tick);
        }
        progressTimer = requestAnimationFrame(tick);

        autoplayTimer = setTimeout(() => {
            nextCard();
            startAutoplay();
        }, AUTOPLAY_MS);
    }

    function stopAutoplay() {
        if (autoplayTimer) clearTimeout(autoplayTimer);
        if (progressTimer) cancelAnimationFrame(progressTimer);
    }

    function resetAutoplay() {
        stopAutoplay();
        startAutoplay();
    }

    /* --- Pause on hover / focus / touch --- */
    carousel.addEventListener('mouseenter', () => { isPaused = true; progressWrap.classList.add('paused'); });
    carousel.addEventListener('mouseleave', () => { isPaused = false; progressWrap.classList.remove('paused'); });
    carousel.addEventListener('focusin', () => { isPaused = true; progressWrap.classList.add('paused'); });
    carousel.addEventListener('focusout', () => { isPaused = false; progressWrap.classList.remove('paused'); });

    carousel.addEventListener('touchstart', () => { isPaused = true; }, { passive: true });
    carousel.addEventListener('touchend', () => { setTimeout(() => { isPaused = false; resetAutoplay(); }, 2500); }, { passive: true });

    let scrollEndTimer;
    carousel.addEventListener('scroll', () => {
        requestAnimationFrame(() => {
            updateUI();
            updateActiveCard();
        });

        clearTimeout(scrollEndTimer);
        if (!isDragging) {
            scrollEndTimer = setTimeout(() => resetAutoplay(), 800);
        }
    }, { passive: true });

    /* --- Drag to scroll (mouse) --- */
    carousel.addEventListener('mousedown', (e) => {
        if (e.button !== 0) return;
        isDragging = true;
        dragMoved = false;
        dragStartX = e.pageX;
        dragStartScroll = carousel.scrollLeft;
        carousel.classList.add('dragging');
        stopAutoplay();
        progressWrap.classList.add('paused');
    });

    document.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        const walk = e.pageX - dragStartX;
        if (Math.abs(walk) > 3) dragMoved = true;
        carousel.scrollLeft = dragStartScroll - walk;
    });

    document.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;
        carousel.classList.remove('dragging');
        progressWrap.classList.remove('paused');
        if (dragMoved) resetAutoplay();
    });

    carousel.addEventListener('click', (e) => {
        if (dragMoved) {
            e.preventDefault();
            e.stopPropagation();
            dragMoved = false;
        }
    }, true);

    /* --- Keyboard navigation --- */
    carousel.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') { e.preventDefault(); nextCard(); resetAutoplay(); }
        if (e.key === 'ArrowLeft') { e.preventDefault(); prevCard(); resetAutoplay(); }
    });

    /* --- Pause when tab hidden --- */
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) stopAutoplay();
        else startAutoplay();
    });

    /* --- Init --- */
    updateUI();
    updateActiveCard();
    startAutoplay();

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            updateUI();
            updateActiveCard();
        }, 150);
    });

});
</script>

@endsection