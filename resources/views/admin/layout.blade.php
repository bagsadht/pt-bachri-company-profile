<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Bachri Samudera</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    /* ============================================================
       RESET & VARIABEL
       ============================================================ */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    :root {
        --h-bg:     #0b1222;
        --h-blue:   #0d6efd;
        --h-indigo: #4f46e5;
        --h-cyan:   #22d3ee;
        --h-text:   #e8eeff;
        --h-muted:  #94a3c4;
        --h-soft:   #7f95c9;
        --h-line:   rgba(255,255,255,.10);
        --h-line-2: rgba(255,255,255,.06);
        --h-green:  #10b981;
        --h-red:    #fb7185;
        --h-amber:  #f59e0b;
        --sidebar-w: 240px;
    }
    html, body { height: 100%; }
    body {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        font-size: 14px;
        color: var(--h-text);
        background: var(--h-bg);
        -webkit-font-smoothing: antialiased;
    }

    /* Background global: blob + grid */
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background:
            radial-gradient(1200px 700px at 15% 0%,    #17275a 0%, transparent 55%),
            radial-gradient(900px  600px at 100% 100%, #1b1a5e 0%, transparent 55%),
            var(--h-bg);
    }
    body::after {
        content: "";
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background-image: radial-gradient(rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 26px 26px;
        -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
                mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
    }

    /* ============================================================
       SIDEBAR
       ============================================================ */
    .sidebar {
        position: fixed;
        top: 0; left: 0; bottom: 0;
        z-index: 1040;
        width: var(--sidebar-w);
        display: flex;
        flex-direction: column;
        background: rgba(11,18,34,.72);
        border-right: 1px solid var(--h-line);
        backdrop-filter: blur(20px) saturate(140%);
        -webkit-backdrop-filter: blur(20px) saturate(140%);
        transition: transform .3s ease;
    }

    .sb-brand {
        display: flex;
        align-items: center;
        gap: .85rem;
        padding: 1.75rem 1.5rem 1.5rem;
        color: var(--h-text);
        text-decoration: none;
    }
    .sb-logo {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
        box-shadow: 0 12px 26px -10px rgba(79,70,229,.9);
        overflow: hidden;
    }
    .sb-logo img { width: 100%; height: 100%; object-fit: contain; }
    .sb-brand-text strong {
        display: block;
        font-size: 1.35rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -.03em;
        line-height: 1.1;
    }

    .sb-nav {
        flex: 1;
        padding: 1.25rem 1rem;
        overflow-y: auto;
    }
    .sb-nav::-webkit-scrollbar { width: 4px; }
    .sb-nav::-webkit-scrollbar-track { background: transparent; }
    .sb-nav::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,.08);
        border-radius: 3px;
    }
    .sb-nav::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,.15); }

    .sb-section-label {
        padding: 1.1rem 1rem .5rem;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--h-soft);
    }

    .sb-link {
        position: relative;
        display: flex;
        align-items: center;
        gap: .95rem;
        width: 100%;
        margin-bottom: .25rem;
        padding: .75rem 1rem;
        font-family: inherit;
        font-size: .9rem;
        font-weight: 500;
        color: var(--h-muted);
        text-align: left;
        text-decoration: none;
        background: transparent;
        border: 1px solid transparent;
        border-radius: 11px;
        cursor: pointer;
        transition: all .18s ease;
    }
    .sb-link i {
        width: 20px;
        font-size: 1.05rem;
        text-align: center;
        color: var(--h-soft);
        transition: color .18s ease;
    }
    .sb-link:hover {
        color: #fff;
        background: rgba(255,255,255,.05);
        border-color: var(--h-line);
    }
    .sb-link:hover i { color: #67e8f9; }
    .sb-link.active {
        color: #fff;
        font-weight: 700;
        background: linear-gradient(135deg, rgba(13,110,253,.24), rgba(79,70,229,.18));
        border-color: rgba(96,165,250,.35);
        box-shadow: 0 8px 22px -12px rgba(79,70,229,.9), inset 0 1px 0 rgba(255,255,255,.06);
    }
    .sb-link.active i { color: #67e8f9; }
    .sb-link.active::before {
        content: "";
        position: absolute;
        left: -1px;
        top: 20%;
        bottom: 20%;
        width: 3px;
        background: linear-gradient(180deg, var(--h-cyan), var(--h-blue));
        border-radius: 3px;
        box-shadow: 0 0 12px var(--h-cyan);
    }

    .sb-badge {
        min-width: 22px;
        margin-left: auto;
        padding: .12rem .5rem;
        font-size: .68rem;
        font-weight: 700;
        text-align: center;
        color: #fff;
        background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
        border-radius: 50px;
        box-shadow: 0 4px 12px -4px rgba(79,70,229,.9);
    }

    /* ============================================================
       MAIN AREA
       ============================================================ */
    .main {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin-left: var(--sidebar-w);
        transition: margin .3s ease;
    }

    /* ---------- TOPBAR ---------- */
    .topbar {
        display: flex;
        align-items: center;
        gap: 1rem;
        height: 78px;
        padding: 0 2rem;
        background: transparent;
    }
    .nav-toggle {
        display: none;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        color: var(--h-text);
        background: rgba(255,255,255,.04);
        border: 1px solid var(--h-line);
        border-radius: 10px;
        cursor: pointer;
    }

    .topbar-greeting { flex: 1; min-width: 0; }
    .topbar-greeting h1 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #f1f5f9;
    }
    .topbar-greeting p {
        margin: 3px 0 0;
        font-size: .75rem;
        color: var(--h-soft);
    }

    .topbar-actions {
        display: flex;
        align-items: center;
        gap: .55rem;
    }
    .topbar-icon-btn {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        color: var(--h-muted);
        text-decoration: none;
        background: rgba(255,255,255,.04);
        border: 1px solid var(--h-line);
        border-radius: 50%;
        cursor: pointer;
        transition: all .18s ease;
    }
    .topbar-icon-btn:hover {
        color: #fff;
        background: rgba(96,165,250,.14);
        border-color: rgba(96,165,250,.4);
        transform: translateY(-1px);
    }
    .notif-dot {
        position: absolute;
        top: 9px; right: 10px;
        width: 7px; height: 7px;
        border-radius: 50%;
        background: var(--h-red);
        box-shadow: 0 0 8px var(--h-red);
        border: 2px solid var(--h-bg);
    }

    /* ---------- USER MENU ---------- */
    .user-menu { position: relative; }
    .topbar-user {
        display: flex;
        align-items: center;
        gap: .55rem;
        padding: .25rem .8rem .25rem .25rem;
        font-family: inherit;
        background: rgba(255,255,255,.04);
        border: 1px solid var(--h-line);
        border-radius: 50px;
        cursor: pointer;
        transition: all .18s ease;
    }
    .topbar-user:hover {
        background: rgba(96,165,250,.12);
        border-color: rgba(96,165,250,.35);
    }
    .topbar-user-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        font-size: .72rem;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
        border-radius: 50%;
        box-shadow: 0 0 0 2px rgba(255,255,255,.08);
        overflow: hidden;
    }
    .topbar-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .topbar-user-name {
        font-size: .82rem;
        font-weight: 600;
        color: #e2e8f0;
    }
    .topbar-user .chev {
        font-size: .6rem;
        color: var(--h-soft);
    }

    .user-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        z-index: 1050;
        min-width: 230px;
        padding: .4rem;
        background: rgba(11,18,34,.96);
        border: 1px solid var(--h-line);
        border-radius: 14px;
        box-shadow: 0 24px 60px -20px rgba(0,0,0,.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-6px);
        transition: all .2s ease;
    }
    .user-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .user-dropdown-header {
        padding: .75rem .85rem;
        margin-bottom: .25rem;
        border-bottom: 1px solid var(--h-line);
    }
    .user-dropdown-header strong {
        display: block;
        font-size: .84rem;
        font-weight: 700;
        color: #f1f5f9;
    }
    .user-dropdown-header span {
        font-size: .72rem;
        color: var(--h-soft);
    }
    .user-dropdown-item {
        display: flex;
        align-items: center;
        gap: .6rem;
        width: 100%;
        padding: .6rem .85rem;
        font-family: inherit;
        font-size: .82rem;
        font-weight: 500;
        color: #cbd5e1;
        text-align: left;
        background: transparent;
        border: 0;
        border-radius: 9px;
        cursor: pointer;
        text-decoration: none;
        transition: all .15s ease;
    }
    .user-dropdown-item:hover {
        color: #fff;
        background: rgba(96,165,250,.14);
    }
    .user-dropdown-item i {
        width: 16px;
        color: var(--h-soft);
    }
    .user-dropdown-item.danger { color: #fda4af; }
    .user-dropdown-item.danger:hover {
        background: rgba(251,113,133,.14);
        color: #fecdd3;
    }
    .user-dropdown-item.danger i { color: var(--h-red); }

    /* ---------- CONTENT ---------- */
    .content {
        flex: 1;
        padding: 0 2rem 2rem;
    }

    /* ============================================================
       KOMPONEN BERSAMA
       ============================================================ */
    .page-title {
        margin: 0;
        font-size: 1.35rem;
        font-weight: 700;
        color: #f1f5f9;
    }
    .page-sub {
        margin: 3px 0 0;
        font-size: .82rem;
        color: var(--h-soft);
    }

    .box {
        padding: 1.5rem;
        background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
        border: 1px solid var(--h-line);
        border-radius: 16px;
        backdrop-filter: blur(18px) saturate(140%);
        -webkit-backdrop-filter: blur(18px) saturate(140%);
        box-shadow: 0 20px 50px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.06);
    }

    .btn-s {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .5rem .9rem;
        font-family: inherit;
        font-size: .8rem;
        font-weight: 600;
        color: #cbd5e1;
        text-decoration: none;
        background: rgba(255,255,255,.04);
        border: 1px solid var(--h-line);
        border-radius: 9px;
        cursor: pointer;
        transition: all .18s ease;
    }
    .btn-s:hover {
        color: #fff;
        background: rgba(96,165,250,.14);
        border-color: rgba(96,165,250,.4);
    }
    .btn-s.green {
        color: #fff;
        background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
        border-color: transparent;
        box-shadow: 0 10px 22px -10px rgba(79,70,229,.9);
    }
    .btn-s.green:hover { filter: brightness(1.1); }
    .btn-s.red {
        color: #fda4af;
        border-color: rgba(251,113,133,.35);
    }
    .btn-s.red:hover {
        background: rgba(251,113,133,.14);
        color: #fecdd3;
    }
    .btn-s.gray { color: var(--h-soft); }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .3rem .75rem;
        font-size: .72rem;
        font-weight: 600;
        border-radius: 50px;
    }
    .pill.green  { color: #6ee7b7; background: rgba(16,185,129,.12);  border: 1px solid rgba(16,185,129,.3); }
    .pill.orange { color: #fcd34d; background: rgba(245,158,11,.12);  border: 1px solid rgba(245,158,11,.3); }
    .pill.red    { color: #fda4af; background: rgba(251,113,133,.12); border: 1px solid rgba(251,113,133,.3); }
    .pill.gray   { color: #cbd5e1; background: rgba(148,163,184,.12); border: 1px solid rgba(148,163,184,.3); }

    .tag {
        display: inline-block;
        padding: .22rem .6rem;
        font-size: .7rem;
        font-weight: 600;
        color: #a5c4ff;
        background: rgba(96,165,250,.14);
        border: 1px solid rgba(96,165,250,.28);
        border-radius: 6px;
    }

    /* Form controls */
    .form-control,
    .form-select {
        color: #fff !important;
        background: rgba(7,12,28,.55) !important;
        border: 1px solid var(--h-line) !important;
        border-radius: 10px !important;
        font-family: inherit !important;
        font-size: .88rem !important;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: #60a5fa !important;
        background: rgba(7,12,28,.85) !important;
        box-shadow: 0 0 0 4px rgba(59,130,246,.18) !important;
    }
    .form-control::placeholder { color: #5f739f !important; }
    .form-select option { background: #0e1a3a; color: #e8eeff; }
    .form-label {
        font-size: .8rem;
        font-weight: 600;
        color: var(--h-muted);
    }
    .form-check-input {
        background-color: rgba(7,12,28,.55);
        border-color: var(--h-line);
    }
    .form-check-input:checked {
        background-color: var(--h-blue);
        border-color: var(--h-blue);
    }
    .form-check-label { color: var(--h-muted); font-size: .85rem; }
    .text-muted { color: var(--h-soft) !important; }

    .alert {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .75rem 1rem;
        font-size: .85rem;
        border: 1px solid;
        border-radius: 12px;
    }
    .alert-success {
        color: #a7f3d0 !important;
        background: rgba(16,185,129,.12) !important;
        border-color: rgba(16,185,129,.35) !important;
    }
    .alert-danger {
        color: #fecdd3 !important;
        background: rgba(251,113,133,.12) !important;
        border-color: rgba(251,113,133,.35) !important;
    }

    /* ============================================================
       GLOBAL: Custom Confirm + Toast
       ============================================================ */
    .gc-overlay {
        position: fixed; inset: 0; z-index: 9500;
        display: none; align-items: center; justify-content: center;
        padding: 1rem;
        background: rgba(3,7,18,.72);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        animation: gc-fade .2s ease;
    }
    .gc-overlay.open { display: flex; }
    @keyframes gc-fade { from { opacity: 0; } to { opacity: 1; } }

    .gc-box {
        width: 100%; max-width: 460px;
        padding: 1.75rem 1.75rem 1.5rem;
        background: linear-gradient(160deg, #131c33, #0f1730);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 20px;
        box-shadow: 0 30px 80px -20px rgba(0,0,0,.95), inset 0 1px 0 rgba(255,255,255,.06);
        animation: gc-up .3s cubic-bezier(.2,.7,.2,1);
    }
    @keyframes gc-up {
        from { opacity: 0; transform: translateY(20px) scale(.97); }
        to   { opacity: 1; transform: none; }
    }

    .gc-icon {
        width: 56px; height: 56px;
        display: grid; place-items: center;
        margin-bottom: 1.1rem;
        font-size: 1.5rem;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(13,110,253,.2), rgba(79,70,229,.2));
        color: #67e8f9;
        border: 1px solid rgba(96,165,250,.3);
    }
    .gc-icon.success {
        background: linear-gradient(135deg, rgba(16,185,129,.2), rgba(5,150,105,.15));
        color: #6ee7b7; border-color: rgba(16,185,129,.4);
    }
    .gc-icon.danger {
        background: linear-gradient(135deg, rgba(251,113,133,.2), rgba(190,18,60,.15));
        color: #fda4af; border-color: rgba(251,113,133,.4);
    }
    .gc-icon.warning {
        background: linear-gradient(135deg, rgba(245,158,11,.2), rgba(217,119,6,.15));
        color: #fcd34d; border-color: rgba(245,158,11,.4);
    }

    .gc-title {
        margin: 0 0 .5rem;
        font-size: 1.15rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -.02em;
    }
    .gc-message {
        margin: 0 0 1.5rem;
        font-size: .9rem;
        line-height: 1.65;
        color: #cbd5e1;
        white-space: pre-line;
    }

    .gc-actions {
        display: flex;
        gap: .6rem;
        justify-content: flex-end;
    }
    .gc-btn {
        position: relative;
        overflow: hidden;
        min-width: 100px;
        height: 42px;
        padding: 0 1.25rem;
        font-family: inherit;
        font-size: .85rem;
        font-weight: 700;
        border-radius: 11px;
        border: 0;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        transition: all .18s ease;
    }
    .gc-btn.ghost {
        color: #cbd5e1;
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,255,255,.12);
    }
    .gc-btn.ghost:hover { color: #fff; background: rgba(255,255,255,.1); }
    .gc-btn.primary {
        color: #fff;
        background: linear-gradient(135deg, #0d6efd, #4f46e5);
        box-shadow: 0 10px 22px -10px rgba(79,70,229,.9);
    }
    .gc-btn.primary:hover { transform: translateY(-2px); filter: brightness(1.08); }
    .gc-btn.danger {
        color: #fff;
        background: linear-gradient(135deg, #e11d48, #fb7185);
        box-shadow: 0 10px 22px -10px rgba(251,113,133,.9);
    }
    .gc-btn.danger:hover { transform: translateY(-2px); filter: brightness(1.08); }
    .gc-btn.success {
        color: #fff;
        background: linear-gradient(135deg, #059669, #10b981);
        box-shadow: 0 10px 22px -10px rgba(16,185,129,.9);
    }
    .gc-btn.success:hover { transform: translateY(-2px); filter: brightness(1.08); }
    .gc-btn:focus-visible { outline: 3px solid rgba(96,165,250,.6); outline-offset: 2px; }

    /* ============================================================
       RESPONSIVE
       ============================================================ */
    .backdrop {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1035;
        background: rgba(3,7,18,.7);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
    }
    .backdrop.show { display: block; }

    @media (max-width: 991.98px) {
        .sidebar { transform: translateX(-100%); }
        .sidebar.open { transform: translateX(0); }
        .main { margin-left: 0; }
        .nav-toggle { display: flex; }
        .topbar {
            height: 68px;
            padding: 0 1rem;
        }
        .content { padding: 0 1rem 1.5rem; }
        .topbar-user-name { display: none; }
        .topbar-greeting p { display: none; }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: .01ms !important;
            transition-duration: .01ms !important;
        }
    }
    </style>
</head>

<body>

@php
    $authUser = auth()->user();
    $isHrd    = $authUser?->isHrd();
    $newCount = $isHrd
        ? \App\Models\JobApplication::where('status', 'baru')->count()
        : 0;
    $home = $isHrd
        ? route('hrd.dashboard')
        : route('admin.vacancies.index');
@endphp

{{-- ============ SIDEBAR ============ --}}
<aside class="sidebar" id="sidebar">

    <a href="{{ $home }}" class="sb-brand">
        <div class="sb-logo">
            <img src="{{ asset('images/logo2.png') }}" alt="Bachri">
        </div>
        <div class="sb-brand-text">
            <strong>Bachri</strong>
        </div>
    </a>

    <nav class="sb-nav">

        @if ($isHrd)
            <a href="{{ route('hrd.dashboard') }}"
               class="sb-link {{ request()->routeIs('hrd.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('hrd.vacancies.index') }}"
               class="sb-link {{ request()->routeIs('hrd.vacancies.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i>
                <span>Daftar Lowongan</span>
            </a>

            <a href="{{ route('hrd.applications.index') }}"
               class="sb-link {{ request()->routeIs('hrd.applications.*') ? 'active' : '' }}">
                <i class="fa-regular fa-envelope"></i>
                <span>Lamaran Masuk</span>
                @if ($newCount > 0)
                    <span class="sb-badge">{{ $newCount }}</span>
                @endif
            </a>

            <a href="{{ route('hrd.applicants.index') }}"
               class="sb-link {{ request()->routeIs('hrd.applicants.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Manajemen Pelamar</span>
            </a>

            <div class="sb-section-label">Laporan</div>

            <a href="{{ route('hrd.report.index') }}"
               class="sb-link {{ request()->routeIs('hrd.report.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-simple"></i>
                <span>Rekap &amp; Laporan</span>
            </a>
        @else
            <a href="{{ route('admin.vacancies.index') }}"
               class="sb-link {{ request()->routeIs('admin.vacancies.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i>
                <span>Kelola Lowongan</span>
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="sb-link" style="margin-bottom:0;">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>

    </nav>
</aside>

<div class="backdrop" id="backdrop"></div>

{{-- ============ MAIN ============ --}}
<div class="main">

    <header class="topbar">
        <button class="nav-toggle" id="navToggle">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="topbar-greeting">
            <h1>Selamat Datang, {{ $authUser->name }} 👋</h1>
            <p>Semoga harimu cerah</p>
        </div>

        <div class="topbar-actions">
            <button class="topbar-icon-btn" aria-label="Cari">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            @if ($isHrd)
                <a href="{{ route('hrd.applications.index') }}" class="topbar-icon-btn" aria-label="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    @if ($newCount > 0)
                        <span class="notif-dot"></span>
                    @endif
                </a>
            @endif

            <div class="user-menu">
                <button type="button" class="topbar-user" id="userBtn">
                    <div class="topbar-user-avatar">
                        {{ strtoupper(substr($authUser->name, 0, 1)) }}
                    </div>
                    <span class="topbar-user-name">{{ $authUser->name }}</span>
                    <i class="fa-solid fa-chevron-right chev"></i>
                </button>

                <div class="user-dropdown" id="userDropdown">
                    <div class="user-dropdown-header">
                        <strong>{{ $authUser->name }}</strong>
                        <span>{{ $authUser->email }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="user-dropdown-item danger">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main class="content">

        @if (session('success'))
            <div class="alert alert-success py-2 mb-3">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger py-2 mb-3">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger py-2 mb-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>
</div>

{{-- ============================================================
     GLOBAL: Custom Confirm Modal + Toast
     ============================================================ --}}
<div class="gc-overlay" id="gcOverlay" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="gc-box">
        <div class="gc-icon" id="gcIcon">?</div>
        <h3 class="gc-title" id="gcTitle">Konfirmasi</h3>
        <p class="gc-message" id="gcMessage"></p>
        <div class="gc-actions">
            <button type="button" class="gc-btn ghost" id="gcCancel">Batal</button>
            <button type="button" class="gc-btn primary" id="gcConfirm">OK</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- 1. Toggle sidebar mobile ---------- */
    const sidebar   = document.getElementById('sidebar');
    const backdrop  = document.getElementById('backdrop');
    const navToggle = document.getElementById('navToggle');

    if (navToggle) {
        navToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            backdrop.classList.toggle('show');
        });
    }
    if (backdrop) {
        backdrop.addEventListener('click', () => {
            sidebar.classList.remove('open');
            backdrop.classList.remove('show');
        });
    }

    /* ---------- 2. Dropdown user ---------- */
    const userBtn      = document.getElementById('userBtn');
    const userDropdown = document.getElementById('userDropdown');

    if (userBtn && userDropdown) {
        userBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        document.addEventListener('click', () => userDropdown.classList.remove('show'));
        userDropdown.addEventListener('click', (e) => e.stopPropagation());
    }

    /* ---------- 3. Custom Confirm + Toast ---------- */
    const overlay = document.getElementById('gcOverlay');
    const iconEl  = document.getElementById('gcIcon');
    const titleEl = document.getElementById('gcTitle');
    const msgEl   = document.getElementById('gcMessage');
    const btnOk   = document.getElementById('gcConfirm');
    const btnNo   = document.getElementById('gcCancel');

    let resolver = null;

    window.gcConfirm = function (opts) {
        return new Promise(function (resolve) {
            resolver = resolve;

            titleEl.textContent = opts.title || 'Konfirmasi';
            msgEl.textContent   = opts.message || '';

            btnOk.textContent = opts.confirmText || 'OK';
            btnNo.textContent = opts.cancelText  || 'Batal';

            btnOk.classList.remove('primary', 'danger', 'success');
            const type = opts.type || 'question';
            if (type === 'danger')       btnOk.classList.add('danger');
            else if (type === 'success') btnOk.classList.add('success');
            else                         btnOk.classList.add('primary');

            iconEl.className = 'gc-icon';
            if (type === 'danger')        { iconEl.classList.add('danger');  iconEl.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>'; }
            else if (type === 'warning')  { iconEl.classList.add('warning'); iconEl.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i>'; }
            else if (type === 'success')  { iconEl.classList.add('success'); iconEl.innerHTML = '<i class="fa-solid fa-circle-check"></i>'; }
            else                          { iconEl.innerHTML = '<i class="fa-solid fa-question"></i>'; }

            btnNo.style.display = opts.hideCancel ? 'none' : '';
            btnOk.disabled = false;
            btnNo.disabled = false;

            overlay.classList.add('open');
            overlay.setAttribute('aria-hidden', 'false');
            setTimeout(() => btnOk.focus(), 100);
        });
    };

    function close(result) {
        overlay.classList.remove('open');
        overlay.setAttribute('aria-hidden', 'true');
        if (resolver) {
            resolver(result);
            resolver = null;
        }
    }

    if (btnOk) btnOk.addEventListener('click', () => close(true));
    if (btnNo) btnNo.addEventListener('click', () => close(false));
    if (overlay) {
        overlay.addEventListener('click', (e) => { if (e.target === overlay) close(false); });
    }
    document.addEventListener('keydown', (e) => {
        if (!overlay || !overlay.classList.contains('open')) return;
        if (e.key === 'Escape') close(false);
        if (e.key === 'Enter' && document.activeElement !== btnNo) close(true);
    });

    /* Auto-intercept forms dengan data-confirm="..." */
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (!form.dataset.confirm) return;
        if (form.dataset.gcBypass === '1') return;

        e.preventDefault();
        e.stopPropagation();

        const message = form.dataset.confirm;
        const type    = form.dataset.confirmType || 'question';

        window.gcConfirm({
            title:   'Konfirmasi',
            message: message,
            type:    type,
            confirmText: form.dataset.confirmText || 'Ya, Lanjutkan',
            cancelText:  'Batal',
        }).then(function (ok) {
            if (!ok) return;
            form.dataset.gcBypass = '1';
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.submit();
            }
            setTimeout(() => { delete form.dataset.gcBypass; }, 3000);
        });
    }, true);

    /* ---------- Toast ---------- */
    window.gcToast = function (msg, type) {
        type = type || 'success';
        const bg = type === 'success'
            ? 'linear-gradient(135deg,#059669,#10b981)'
            : type === 'error'
                ? 'linear-gradient(135deg,#e11d48,#fb7185)'
                : 'linear-gradient(135deg,#0d6efd,#4f46e5)';
        const ic = type === 'success' ? 'fa-circle-check'
                 : type === 'error'   ? 'fa-circle-exclamation'
                 : 'fa-circle-info';

        const el = document.createElement('div');
        el.style.cssText =
            'position:fixed;top:24px;right:24px;z-index:9999;padding:14px 20px;' +
            'border-radius:12px;color:#fff;font-family:inherit;font-size:.88rem;font-weight:600;' +
            'box-shadow:0 14px 34px -10px rgba(0,0,0,.7);background:' + bg + ';' +
            'transform:translateY(-20px);opacity:0;transition:all .35s cubic-bezier(.2,.7,.2,1);' +
            'max-width:400px;line-height:1.4;display:flex;align-items:center;gap:.65rem;';
        el.innerHTML = '<i class="fa-solid ' + ic + '"></i><span>' + msg + '</span>';
        document.body.appendChild(el);

        requestAnimationFrame(function () {
            el.style.transform = 'translateY(0)';
            el.style.opacity = '1';
        });
        setTimeout(function () {
            el.style.opacity = '0';
            el.style.transform = 'translateY(-20px)';
            setTimeout(function () { el.remove(); }, 400);
        }, 3500);
    };
})();
</script>

@stack('scripts')
</body>
</html>