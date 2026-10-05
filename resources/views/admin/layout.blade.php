<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') - RecruitHub | PT Bachri Samudera Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --sb:#0b1222; --primary:#0d6efd; --active:#4f46e5; --ink:#1e293b; --muted:#64748b; --line:#e8ecf2; }
        * { font-family:'Plus Jakarta Sans',sans-serif; }
        body { background:#f8fafc; color:var(--ink); }

        /* Sidebar */
        .sb { width:195px; background:var(--sb); color:#fff; position:fixed; inset:0 auto 0 0; z-index:1040;
              display:flex; flex-direction:column; padding:1rem .8rem; transition:transform .3s; }
        .sb-brand { display:flex; align-items:center; gap:.65rem; padding:0 .3rem 1rem; border-bottom:1px solid rgba(255,255,255,.08); margin-bottom:1rem; }
        .sb-logo { width:30px; height:30px; border-radius:8px; background:var(--primary); display:flex; align-items:center; justify-content:center; font-size:.8rem; }
        .sb-brand strong { display:block; font-size:.85rem; line-height:1.1; }
        .sb-brand span { font-size:.62rem; color:rgba(255,255,255,.3); }
        .sb-nav { flex:1; overflow-y:auto; }
        .sb-link { display:flex; align-items:center; gap:.7rem; padding:.72rem .8rem; border-radius:9px; color:#94a3b8; text-decoration:none;
                   font-size:.8rem; font-weight:500; margin-bottom:.35rem; transition:.2s; }
        .sb-link i { width:16px; text-align:center; font-size:.82rem; }
        .sb-link:hover { background:rgba(255,255,255,.06); color:#fff; }
        .sb-link.active { background:var(--active); color:#fff; font-weight:600; box-shadow:0 6px 14px -6px rgba(79,70,229,.8); }
        .sb-badge { margin-left:auto; background:#ef4444; color:#fff; font-size:.62rem; font-weight:700; padding:.08rem .42rem; border-radius:50px; }
        .sb-user { background:rgba(255,255,255,.05); border-radius:10px; padding:.7rem .75rem; display:flex; align-items:center; gap:.6rem; margin:0; }
        .sb-user strong { font-size:.75rem; flex:1; }
        .sb-user button { background:none; border:0; color:#f43f5e; padding:0; }

        /* Main */
        .main { margin-left:195px; min-height:100vh; display:flex; flex-direction:column; transition:margin .3s; }
        .topbar { height:54px; background:#fff; border-bottom:1px solid var(--line); display:flex; align-items:center; justify-content:space-between;
                  padding:0 1.5rem; position:sticky; top:0; z-index:1020; }
        .tg { width:34px; height:34px; border:1px solid var(--line); background:#fff; border-radius:8px; color:var(--ink); box-shadow:0 2px 6px -3px rgba(0,0,0,.2); }
        .mode { background:#dbeafe; color:#1d4ed8; font-size:.65rem; font-weight:600; padding:.3rem .75rem; border-radius:50px; }
        .content { padding:1.6rem 1.5rem; flex:1; }
        .backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:1030; }
        body.collapsed .sb { transform:translateX(-100%); }
        body.collapsed .main { margin-left:0; }
        @media (max-width:991.98px) {
            .sb { transform:translateX(-100%); } .sb.open { transform:none; }
            .main { margin-left:0 !important; } .backdrop.show { display:block; } .content { padding:1rem; }
        }

        /* Komponen bersama */
        .page-title { font-weight:700; font-size:1.3rem; margin:0; }
        .page-sub { font-size:.78rem; color:var(--muted); margin:.15rem 0 0; }
        .box { background:#fff; border:1px solid var(--line); border-radius:14px; box-shadow:0 4px 14px -10px rgba(15,23,42,.18); }
        .tbl { margin:0; }
        .tbl th { font-size:.72rem; text-transform:uppercase; font-weight:700; color:var(--ink); background:#f8fafc; border-bottom:1px solid var(--line); padding:.85rem 1rem; white-space:nowrap; }
        .tbl td { font-size:.82rem; padding:.8rem 1rem; vertical-align:middle; border-color:#f1f4f8; }
        .tag { font-size:.66rem; font-weight:600; padding:.2rem .55rem; border-radius:6px; background:#dbeafe; color:#1d4ed8; display:inline-block; }
        .pill { font-size:.68rem; font-weight:600; padding:.25rem .75rem; border-radius:50px; display:inline-block; }
        .pill.green { background:#198754; color:#fff; } .pill.red { background:#dc3545; color:#fff; }
        .pill.yellow { background:#fff3cd; color:#664d03; } .pill.gray { background:#e2e8f0; color:#475569; }
        .btn-s { font-size:.72rem; font-weight:600; padding:.3rem .75rem; border-radius:8px; border:1px solid var(--primary); color:var(--primary);
                 background:#fff; text-decoration:none; display:inline-flex; align-items:center; gap:.35rem; cursor:pointer; }
        .btn-s:hover { background:var(--primary); color:#fff; }
        .btn-s.red { border-color:#dc3545; color:#dc3545; } .btn-s.red:hover { background:#dc3545; color:#fff; }
        .btn-s.green { background:#198754; border-color:#198754; color:#fff; } .btn-s.green:hover { background:#146c43; }
        .btn-s.gray { border-color:#cbd5e1; color:#475569; } .btn-s.gray:hover { background:#475569; color:#fff; }
        .empty { text-align:center; color:var(--muted); padding:1.6rem 1rem !important; font-size:.82rem; }
        .chip { display:inline-flex; align-items:center; gap:.45rem; padding:.45rem 1rem; border-radius:50px; border:1px solid #cbd5e1; background:#fff;
                color:#475569; font-size:.78rem; font-weight:500; text-decoration:none; }
        .chip:hover { border-color:var(--primary); color:var(--primary); }
        .chip.on { background:var(--primary); border-color:var(--primary); color:#fff; font-weight:600; }
        .chip.on.green { background:#198754; border-color:#198754; } .chip.on.red { background:#dc3545; border-color:#dc3545; }
        .chip .n { background:#fff; color:#1e293b; font-size:.65rem; font-weight:700; padding:.05rem .45rem; border-radius:50px; }
        .chip:not(.on) .n { background:#eef1f5; }
    </style>
</head>
<body>
@php($newCount = \App\Models\JobApplication::where('status', 'baru')->count())

<div class="backdrop" id="backdrop"></div>

<aside class="sb" id="sb">
    <div class="sb-brand">
        <div class="sb-logo"><i class="fa-solid fa-briefcase"></i></div>
        <div><strong>RecruitHub</strong><span>Admin Panel</span></div>
    </div>

    <nav class="sb-nav">
        <a href="{{ route('admin.vacancies.index') }}" class="sb-link {{ request()->routeIs('admin.vacancies.*') ? 'active' : '' }}">
            <i class="fa-solid fa-table-cells-large"></i> Kelola Lowongan
        </a>
        <a href="{{ route('admin.applications.index') }}" class="sb-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <i class="fa-solid fa-inbox"></i> Kontak Masuk
            @if($newCount > 0)<span class="sb-badge">{{ $newCount }}</span>@endif
        </a>
        <a href="{{ route('admin.selection.index') }}" class="sb-link {{ request()->routeIs('admin.selection.*') ? 'active' : '' }}">
            <i class="fa-solid fa-sitemap"></i> Proses Seleksi
        </a>
        <a href="{{ route('admin.applicants.index') }}" class="sb-link {{ request()->routeIs('admin.applicants.*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-group"></i> Daftar Pelamar
        </a>
        <a href="{{ route('admin.report.index') }}" class="sb-link {{ request()->routeIs('admin.report.*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-column"></i> Rekap &amp; Analisis
        </a>
    </nav>

    <form action="{{ route('admin.logout') }}" method="POST" class="sb-user">
        @csrf
        <i class="fa-regular fa-circle-user"></i>
        <strong>Admin HRD</strong>
        <button type="submit" title="Keluar"><i class="fa-solid fa-right-from-bracket"></i></button>
    </form>
</aside>

<div class="main">
    <header class="topbar">
        <button class="tg" id="tg" type="button" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
        <span class="mode"><i class="fa-solid fa-shield-halved me-1"></i>Mode Admin</span>
    </header>

    <main class="content">
        @if(session('success'))<div class="alert alert-success py-2" style="border-radius:10px;font-size:.85rem;"><i class="fa-solid fa-check me-2"></i>{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger py-2" style="border-radius:10px;font-size:.85rem;">{{ session('error') }}</div>@endif
        @if($errors->any())
            <div class="alert alert-danger py-2" style="border-radius:10px;font-size:.85rem;">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sb = document.getElementById('sb'), bd = document.getElementById('backdrop');
    document.getElementById('tg').addEventListener('click', () => {
        if (window.matchMedia('(max-width: 991.98px)').matches) { sb.classList.toggle('open'); bd.classList.toggle('show'); }
        else { document.body.classList.toggle('collapsed'); }
    });
    bd.addEventListener('click', () => { sb.classList.remove('open'); bd.classList.remove('show'); });
</script>
@stack('scripts')
</body>
</html>