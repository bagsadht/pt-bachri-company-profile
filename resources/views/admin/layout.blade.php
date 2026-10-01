<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') - PT Bachri Samudera Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0b131e; --navy2: #14213d; --gold: #f1c40f; --gold2: #e67e22;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: #f5f6f8; }
        h1,h2,h3,.font-display { font-family: 'Outfit', sans-serif; }

        .admin-shell { display: flex; min-height: 100vh; }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: 264px; flex-shrink: 0; background: linear-gradient(180deg, var(--navy) 0%, var(--navy2) 100%);
            color: #fff; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0;
            z-index: 1040; transition: transform .3s ease;
        }
        .sidebar-brand { padding: 1.5rem 1.5rem 1.25rem; display: flex; align-items: center; gap: .7rem; border-bottom: 1px solid rgba(255,255,255,.08); }
        .sidebar-brand-icon {
            width: 38px; height: 38px; border-radius: 11px; background: linear-gradient(135deg, var(--gold), var(--gold2));
            display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--navy); flex-shrink: 0;
        }
        .sidebar-brand-text { line-height: 1.2; }
        .sidebar-brand-text strong { font-family: 'Outfit', sans-serif; font-size: .92rem; font-weight: 700; display: block; }
        .sidebar-brand-text span { font-size: .7rem; color: rgba(255,255,255,.5); }

        .sidebar-nav { flex: 1; padding: 1.25rem .9rem; overflow-y: auto; }
        .sidebar-section-label { font-size: .68rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.35); padding: 0 .75rem; margin: 1.1rem 0 .5rem; }
        .sidebar-section-label:first-child { margin-top: 0; }

        .sidebar-link {
            display: flex; align-items: center; gap: .8rem; padding: .68rem .85rem; border-radius: 11px;
            color: rgba(255,255,255,.72); text-decoration: none; font-size: .875rem; font-weight: 500;
            margin-bottom: .2rem; transition: all .2s; position: relative;
        }
        .sidebar-link svg { width: 19px; height: 19px; flex-shrink: 0; opacity: .8; }
        .sidebar-link:hover { background: rgba(255,255,255,.06); color: #fff; }
        .sidebar-link.active { background: rgba(241,196,15,.14); color: #f1c40f; font-weight: 700; }
        .sidebar-link.active svg { opacity: 1; }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: -.9rem; top: 50%; transform: translateY(-50%);
            width: 3px; height: 60%; background: var(--gold); border-radius: 0 3px 3px 0;
        }
        .sidebar-link-badge {
            margin-left: auto; background: var(--gold); color: var(--navy); font-size: .68rem; font-weight: 800;
            padding: .1rem .45rem; border-radius: 50px; min-width: 20px; text-align: center;
        }

        .sidebar-footer { padding: 1rem .9rem 1.4rem; border-top: 1px solid rgba(255,255,255,.08); }
        .sidebar-logout-btn {
            width: 100%; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); color: rgba(255,255,255,.8);
            padding: .65rem .85rem; border-radius: 11px; font-size: .85rem; font-weight: 600;
            display: flex; align-items: center; gap: .7rem; transition: all .2s;
        }
        .sidebar-logout-btn:hover { background: rgba(239,68,68,.15); border-color: rgba(239,68,68,.3); color: #fca5a5; }
        .sidebar-logout-btn svg { width: 18px; height: 18px; }

        /* ===== MAIN AREA ===== */
        .admin-main { flex: 1; margin-left: 264px; display: flex; flex-direction: column; min-width: 0; }

        .admin-topbar {
            height: 68px; background: #fff; border-bottom: 1px solid #eef0f3; display: flex; align-items: center;
            justify-content: space-between; padding: 0 1.75rem; position: sticky; top: 0; z-index: 1020;
        }
        .sidebar-toggle-btn {
            display: none; background: none; border: 0; width: 38px; height: 38px; border-radius: 10px;
            align-items: center; justify-content: center; color: #334155;
        }
        .sidebar-toggle-btn:hover { background: #f1f4f8; }

        .topbar-right { display: flex; align-items: center; gap: 1.1rem; }
        .topbar-icon-btn {
            width: 40px; height: 40px; border-radius: 11px; background: #f7f8fa; border: 1px solid #eef0f3;
            display: flex; align-items: center; justify-content: center; color: #475569; text-decoration: none;
            position: relative; transition: all .2s;
        }
        .topbar-icon-btn:hover { background: #eef1f5; color: #0b131e; }
        .topbar-icon-btn svg { width: 19px; height: 19px; }
        .topbar-icon-badge {
            position: absolute; top: -4px; right: -4px; background: #ef4444; color: #fff; font-size: .62rem; font-weight: 800;
            width: 17px; height: 17px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            border: 2px solid #fff;
        }
        .topbar-user { display: flex; align-items: center; gap: .65rem; padding-left: 1rem; border-left: 1px solid #eef0f3; }
        .topbar-user-avatar {
            width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold2));
            display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--navy); font-size: .85rem;
        }
        .topbar-user-text { line-height: 1.15; }
        .topbar-user-text strong { display: block; font-size: .82rem; color: #0b131e; }
        .topbar-user-text span { font-size: .7rem; color: #94a3b8; }

        .admin-content { padding: 1.75rem; flex: 1; }

        .sidebar-backdrop {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 1030;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .sidebar-toggle-btn { display: flex; }
            .sidebar-backdrop.show { display: block; }
            .admin-content { padding: 1.1rem; }
            .topbar-user-text { display: none; }
        }
    </style>
</head>
<body>

<div class="admin-shell">

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">B</div>
            <div class="sidebar-brand-text">
                <strong>Admin Karir</strong>
                <span>Bachri Samudera</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-label">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.vacancies.index') }}" class="sidebar-link {{ request()->routeIs('admin.vacancies.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Lowongan
            </a>

            @php($newCount = \App\Models\JobApplication::where('status', 'baru')->count())
            <a href="{{ route('admin.applications.index') }}" class="sidebar-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Lamaran
                @if($newCount > 0)<span class="sidebar-link-badge">{{ $newCount }}</span>@endif
            </a>

            <div class="sidebar-section-label">Lainnya</div>

            <a href="{{ route('careers.index') }}" target="_blank" class="sidebar-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Situs
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <button class="sidebar-toggle-btn" id="sidebarToggle">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <div class="d-none d-lg-block"></div>

            <div class="topbar-right">
                <a href="{{ route('admin.applications.index', ['status' => 'baru']) }}" class="topbar-icon-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @if($newCount > 0)<span class="topbar-icon-badge">{{ $newCount }}</span>@endif
                </a>

                <div class="topbar-user">
                    <div class="topbar-user-avatar">A</div>
                    <div class="topbar-user-text">
                        <strong>Admin</strong>
                        <span>Panel Karir</span>
                    </div>
                </div>
            </div>
        </header>

        <main class="admin-content">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2" style="border-radius:12px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" style="border-radius:12px;">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" style="border-radius:12px;">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById('adminSidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    const toggleBtn = document.getElementById('sidebarToggle');
    function openSidebar() { sidebar.classList.add('open'); backdrop.classList.add('show'); }
    function closeSidebar() { sidebar.classList.remove('open'); backdrop.classList.remove('show'); }
    toggleBtn?.addEventListener('click', () => sidebar.classList.contains('open') ? closeSidebar() : openSidebar());
    backdrop?.addEventListener('click', closeSidebar);
</script>
</body>
</html>