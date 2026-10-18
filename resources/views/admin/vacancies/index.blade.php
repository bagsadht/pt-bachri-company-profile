@extends('admin.layout')
@section('title', 'Kelola Lowongan')

@section('content')

{{-- ============================================================
     STYLE
     ============================================================ --}}
<style>
/* ---------- VARIABEL ---------- */
.vl-page {
    --h-blue:   #0d6efd;
    --h-indigo: #4f46e5;
    --h-cyan:   #22d3ee;
    --h-text:   #e8eeff;
    --h-muted:  #94a3c4;
    --h-soft:   #7f95c9;
    --h-line:   rgba(255,255,255,.10);
    --h-green:  #10b981;
    --h-red:    #fb7185;
    --h-amber:  #f59e0b;

    animation: vl-enter .5s cubic-bezier(.2,.7,.2,1) both;
}
@keyframes vl-enter {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: none; }
}

/* ---------- PAGE HEADER ---------- */
.vl-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.vl-title {
    margin: 0 0 4px;
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: -.02em;
    background: linear-gradient(120deg, #fff 15%, #a5c4ff 55%, #67e8f9 100%);
    -webkit-background-clip: text;
            background-clip: text;
    color: transparent;
}
.vl-sub {
    margin: 0;
    font-size: .85rem;
    color: var(--h-muted);
}
.vl-btn-primary {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .65rem 1.25rem;
    font-family: inherit;
    font-size: .85rem;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    border: 0;
    border-radius: 11px;
    cursor: pointer;
    box-shadow: 0 12px 26px -12px rgba(79,70,229,.9);
    transition: all .22s cubic-bezier(.4,0,.2,1);
}
.vl-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 32px -12px rgba(79,70,229,1);
    filter: brightness(1.08);
    color: #fff;
}
.vl-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,.4);
    transform: scale(0);
    animation: vl-ripple .6s ease-out;
    pointer-events: none;
}
@keyframes vl-ripple { to { transform: scale(4); opacity: 0; } }

/* ---------- STAT CARDS ---------- */
.vl-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
@media (max-width: 991.98px) { .vl-stats { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575.98px) { .vl-stats { grid-template-columns: 1fr 1fr; gap: .75rem; } }

.vl-stat {
    position: relative;
    padding: 1.1rem 1.15rem;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 20px 50px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.06);
    transition: all .3s cubic-bezier(.4,0,.2,1);
}
.vl-stat::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--accent);
    box-shadow: 0 0 20px var(--accent);
}
.vl-stat:hover {
    transform: translateY(-3px);
    border-color: rgba(255,255,255,.18);
}
.vl-stat-inner {
    display: flex;
    align-items: center;
    gap: .9rem;
}
.vl-stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    font-size: 1.05rem;
    color: var(--accent);
    background: var(--accent-bg);
    border: 1px solid var(--accent-border);
    border-radius: 11px;
}
.vl-stat-meta { flex: 1; min-width: 0; }
.vl-stat-label {
    margin-bottom: 3px;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--h-soft);
}
.vl-stat-value {
    font-size: 1.5rem;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -.03em;
    color: #f8fafc;
}
@media (max-width: 575.98px) {
    .vl-stat-value { font-size: 1.2rem; }
    .vl-stat-icon  { width: 38px; height: 38px; font-size: .95rem; }
}

/* Variasi accent */
.vl-stat.is-total    { --accent: #60a5fa; --accent-bg: rgba(96,165,250,.12);  --accent-border: rgba(96,165,250,.3); }
.vl-stat.is-active   { --accent: #34d399; --accent-bg: rgba(16,185,129,.12);  --accent-border: rgba(16,185,129,.3); }
.vl-stat.is-inactive { --accent: #cbd5e1; --accent-bg: rgba(148,163,184,.12); --accent-border: rgba(148,163,184,.3); }
.vl-stat.is-expired  { --accent: #fb7185; --accent-bg: rgba(251,113,133,.12); --accent-border: rgba(251,113,133,.3); }

/* ---------- TOOLBAR ---------- */
.vl-toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: .85rem;
    padding: .9rem 1rem;
    margin-bottom: 1rem;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    border-radius: 14px;
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
}

/* ---------- TABS ---------- */
.vl-tabs {
    display: flex;
    gap: .35rem;
    flex-wrap: wrap;
}
.vl-tab {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    padding: .5rem .95rem;
    font-size: .8rem;
    font-weight: 600;
    color: var(--h-muted);
    text-decoration: none;
    background: rgba(255,255,255,.03);
    border: 1px solid var(--h-line);
    border-radius: 10px;
    transition: all .2s ease;
}
.vl-tab:hover {
    color: #fff;
    background: rgba(255,255,255,.08);
    border-color: rgba(255,255,255,.2);
    transform: translateY(-1px);
}
.vl-tab i { font-size: .75rem; }
.vl-tab .count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 22px;
    height: 20px;
    padding: 0 .4rem;
    font-size: .66rem;
    font-weight: 700;
    color: #cbd5e1;
    background: rgba(255,255,255,.08);
    border-radius: 6px;
}
.vl-tab.is-active {
    color: #fff;
    border-color: transparent;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 10px 22px -10px rgba(79,70,229,.9);
}
.vl-tab.is-active .count { background: rgba(255,255,255,.22); color: #fff; }
.vl-tab.is-active.tone-green { background: linear-gradient(135deg, #059669, #10b981); box-shadow: 0 10px 22px -10px rgba(16,185,129,.9); }
.vl-tab.is-active.tone-red   { background: linear-gradient(135deg, #e11d48, #fb7185); box-shadow: 0 10px 22px -10px rgba(251,113,133,.9); }
.vl-tab.is-active.tone-slate { background: linear-gradient(135deg, #334155, #475569); box-shadow: 0 10px 22px -10px rgba(0,0,0,.6); }

/* ---------- SEARCH ---------- */
.vl-search {
    position: relative;
    display: flex;
    align-items: center;
    flex: 1;
    min-width: 260px;
    max-width: 380px;
}
.vl-search > i {
    position: absolute;
    left: .95rem;
    font-size: .8rem;
    color: var(--h-soft);
    pointer-events: none;
    transition: color .2s;
}
.vl-search input {
    width: 100%;
    padding: .6rem .9rem .6rem 2.5rem;
    font-family: inherit;
    font-size: .85rem;
    color: #fff;
    background: rgba(7,12,28,.55);
    border: 1.5px solid var(--h-line);
    border-radius: 10px;
    outline: none;
    transition: all .2s ease;
}
.vl-search input::placeholder { color: #5f739f; }
.vl-search input:hover        { border-color: rgba(255,255,255,.22); }
.vl-search input:focus {
    border-color: #60a5fa;
    background: rgba(7,12,28,.85);
    box-shadow: 0 0 0 4px rgba(59,130,246,.18);
}
.vl-search:focus-within > i { color: #60a5fa; }
.vl-search-clear {
    position: absolute;
    right: .55rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    color: var(--h-soft);
    background: transparent;
    border: 0;
    border-radius: 6px;
    cursor: pointer;
    transition: all .15s ease;
}
.vl-search-clear:hover {
    color: #fda4af;
    background: rgba(251,113,133,.15);
}

/* ---------- TABLE CARD ---------- */
.vl-table-card {
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 20px 50px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.06);
}
.vl-table {
    width: 100%;
    border-collapse: collapse;
}
.vl-table thead th {
    padding: .9rem 1.1rem;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    text-align: left;
    color: var(--h-soft);
    background: rgba(255,255,255,.03);
    border-bottom: 1px solid var(--h-line);
    white-space: nowrap;
}
.vl-table tbody td {
    padding: 1rem 1.1rem;
    font-size: .85rem;
    color: #cbd5e1;
    vertical-align: middle;
    border-bottom: 1px solid rgba(255,255,255,.05);
}
.vl-table tbody tr {
    transition: background .18s ease;
}
.vl-table tbody tr:hover      { background: rgba(96,165,250,.06); }
.vl-table tbody tr:last-child td { border-bottom: none; }

/* ---------- POSITION CELL ---------- */
.vl-position {
    display: flex;
    align-items: center;
    gap: .85rem;
    min-width: 0;
}
.vl-thumb {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid var(--h-line);
}
.vl-thumb-fallback {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    font-size: .9rem;
    color: #a5c4ff;
    background: rgba(96,165,250,.14);
    border: 1px solid rgba(96,165,250,.28);
    border-radius: 10px;
}
.vl-position-body { min-width: 0; flex: 1; }
.vl-position-title {
    display: block;
    margin-bottom: 3px;
    font-size: .88rem;
    font-weight: 700;
    color: #f1f5f9;
    text-decoration: none;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    transition: color .15s ease;
}
.vl-position-title:hover { color: #67e8f9; }
.vl-position-title i { margin-left: 4px; font-size: .6rem; opacity: .5; }
.vl-position-meta {
    display: flex;
    gap: .6rem;
    flex-wrap: wrap;
    font-size: .72rem;
    color: var(--h-soft);
}
.vl-position-meta span { display: inline-flex; align-items: center; gap: 3px; }
.vl-position-meta i { font-size: .68rem; opacity: .8; }

/* ---------- BADGES ---------- */
.vl-tag {
    display: inline-block;
    padding: .22rem .6rem;
    font-size: .7rem;
    font-weight: 600;
    color: #a5c4ff;
    background: rgba(96,165,250,.14);
    border: 1px solid rgba(96,165,250,.28);
    border-radius: 6px;
    white-space: nowrap;
}
.vl-pill {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .3rem .75rem;
    font-size: .72rem;
    font-weight: 600;
    border-radius: 50px;
    white-space: nowrap;
}
.vl-pill::before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    box-shadow: 0 0 8px currentColor;
}
.vl-pill.is-active   { color: #6ee7b7; background: rgba(16,185,129,.12);  border: 1px solid rgba(16,185,129,.32); }
.vl-pill.is-inactive { color: #cbd5e1; background: rgba(148,163,184,.12); border: 1px solid rgba(148,163,184,.3); }
.vl-pill.is-expired  { color: #fda4af; background: rgba(251,113,133,.12); border: 1px solid rgba(251,113,133,.32); }

/* ---------- DEADLINE ---------- */
.vl-deadline {
    font-size: .84rem;
    font-weight: 500;
    color: #e2e8f0;
}
.vl-deadline.is-past {
    color: #fda4af;
    font-weight: 600;
}

/* ---------- APPLICANT BADGE ---------- */
.vl-applicant {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .32rem .75rem;
    font-size: .74rem;
    font-weight: 700;
    color: #a5c4ff;
    text-decoration: none;
    background: rgba(96,165,250,.14);
    border: 1px solid rgba(96,165,250,.3);
    border-radius: 50px;
    transition: all .2s ease;
}
.vl-applicant:hover {
    color: #fff;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    border-color: transparent;
    transform: scale(1.05);
}

/* ---------- ACTION BUTTONS ---------- */
.vl-actions {
    display: inline-flex;
    gap: .35rem;
}
.vl-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    font-size: .78rem;
    color: #a9b8d8;
    text-decoration: none;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 9px;
    cursor: pointer;
    transition: all .18s ease;
}
.vl-action:hover { transform: translateY(-2px); }
.vl-action.action-toggle.active-mode:hover   { color: #fcd34d; background: rgba(245,158,11,.16);  border-color: rgba(245,158,11,.45); }
.vl-action.action-toggle.inactive-mode:hover { color: #6ee7b7; background: rgba(16,185,129,.16);  border-color: rgba(16,185,129,.45); }
.vl-action.action-edit:hover                 { color: #a5c4ff; background: rgba(96,165,250,.16);  border-color: rgba(96,165,250,.45); }
.vl-action.action-delete:hover               { color: #fda4af; background: rgba(251,113,133,.16); border-color: rgba(251,113,133,.45); }

/* ---------- EMPTY STATE ---------- */
.vl-empty {
    padding: 3.5rem 1.5rem;
    text-align: center;
    color: var(--h-muted);
}
.vl-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 68px;
    height: 68px;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: #60a5fa;
    background: rgba(96,165,250,.10);
    border: 1px solid rgba(96,165,250,.22);
    border-radius: 50%;
    animation: vl-pulse 3s ease-in-out infinite;
}
@keyframes vl-pulse { 50% { box-shadow: 0 0 0 12px rgba(96,165,250,.08); } }
.vl-empty-title {
    margin-bottom: .35rem;
    font-size: .98rem;
    font-weight: 700;
    color: #cbd5e1;
}
.vl-empty-text {
    margin-bottom: 1.25rem;
    font-size: .82rem;
}

/* ---------- PAGINATION ---------- */
.vl-pagination {
    display: flex;
    justify-content: center;
    margin-top: 1.5rem;
}
.vl-pagination nav > div:first-child { display: none; }
.vl-pagination .pagination {
    gap: .3rem;
    margin: 0;
}
.vl-pagination .page-item .page-link {
    min-width: 38px;
    padding: .5rem .8rem;
    font-size: .8rem;
    font-weight: 600;
    text-align: center;
    color: #a9b8d8;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 9px;
    transition: all .18s ease;
}
.vl-pagination .page-item .page-link:hover {
    color: #fff;
    background: rgba(96,165,250,.14);
    border-color: rgba(96,165,250,.4);
}
.vl-pagination .page-item.active .page-link {
    color: #fff;
    border-color: transparent;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 10px 22px -10px rgba(79,70,229,.9);
}
.vl-pagination .page-item.disabled .page-link { opacity: .4; }

/* ---------- RESPONSIVE ---------- */
@media (prefers-reduced-motion: reduce) {
    .vl-page *, .vl-page *::before, .vl-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
@media (max-width: 768px) {
    .vl-title { font-size: 1.25rem; }
    .vl-table thead th,
    .vl-table tbody td { padding: .85rem .9rem; }
}
</style>


{{-- ============================================================
     KONTEN
     ============================================================ --}}
<div class="vl-page">

    {{-- ---------- PAGE HEADER ---------- --}}
    <div class="vl-header">
        <div>
            <h1 class="vl-title">Kelola Lowongan</h1>
            <p class="vl-sub">Pantau performa dan status setiap lowongan kerja.</p>
        </div>
        <a href="{{ route('admin.vacancies.create') }}" class="vl-btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Lowongan
        </a>
    </div>

    {{-- ---------- STAT CARDS ---------- --}}
    <div class="vl-stats">

        <div class="vl-stat is-total">
            <div class="vl-stat-inner">
                <div class="vl-stat-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div class="vl-stat-meta">
                    <div class="vl-stat-label">Total Lowongan</div>
                    <div class="vl-stat-value">{{ $stats['all'] }}</div>
                </div>
            </div>
        </div>

        <div class="vl-stat is-active">
            <div class="vl-stat-inner">
                <div class="vl-stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                <div class="vl-stat-meta">
                    <div class="vl-stat-label">Aktif</div>
                    <div class="vl-stat-value">{{ $stats['active'] }}</div>
                </div>
            </div>
        </div>

        <div class="vl-stat is-inactive">
            <div class="vl-stat-inner">
                <div class="vl-stat-icon"><i class="fa-solid fa-eye-slash"></i></div>
                <div class="vl-stat-meta">
                    <div class="vl-stat-label">Nonaktif</div>
                    <div class="vl-stat-value">{{ $stats['inactive'] }}</div>
                </div>
            </div>
        </div>

        <div class="vl-stat is-expired">
            <div class="vl-stat-inner">
                <div class="vl-stat-icon"><i class="fa-solid fa-clock"></i></div>
                <div class="vl-stat-meta">
                    <div class="vl-stat-label">Kedaluwarsa</div>
                    <div class="vl-stat-value">{{ $stats['expired'] }}</div>
                </div>
            </div>
        </div>

    </div>

    {{-- ---------- TOOLBAR: TABS + SEARCH ---------- --}}
    <div class="vl-toolbar">

        <div class="vl-tabs">
            <a href="{{ route('admin.vacancies.index', array_merge(request()->except('tab', 'page'), ['tab' => 'all'])) }}"
               class="vl-tab {{ $tab === 'all' ? 'is-active' : '' }}">
                <i class="fa-solid fa-layer-group"></i>
                Semua <span class="count">{{ $stats['all'] }}</span>
            </a>
            <a href="{{ route('admin.vacancies.index', array_merge(request()->except('tab', 'page'), ['tab' => 'active'])) }}"
               class="vl-tab {{ $tab === 'active' ? 'is-active tone-green' : '' }}">
                <i class="fa-solid fa-circle-check"></i>
                Aktif <span class="count">{{ $stats['active'] }}</span>
            </a>
            <a href="{{ route('admin.vacancies.index', array_merge(request()->except('tab', 'page'), ['tab' => 'inactive'])) }}"
               class="vl-tab {{ $tab === 'inactive' ? 'is-active tone-slate' : '' }}">
                <i class="fa-solid fa-eye-slash"></i>
                Nonaktif <span class="count">{{ $stats['inactive'] }}</span>
            </a>
            <a href="{{ route('admin.vacancies.index', array_merge(request()->except('tab', 'page'), ['tab' => 'expired'])) }}"
               class="vl-tab {{ $tab === 'expired' ? 'is-active tone-red' : '' }}">
                <i class="fa-solid fa-clock"></i>
                Kedaluwarsa <span class="count">{{ $stats['expired'] }}</span>
            </a>
        </div>

        <form action="{{ route('admin.vacancies.index') }}" method="GET" class="vl-search">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" placeholder="Cari posisi, departemen, lokasi..." value="{{ request('q') }}">
            @if (request('q'))
                <a href="{{ route('admin.vacancies.index', ['tab' => $tab]) }}" class="vl-search-clear" title="Reset">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>

    </div>

    {{-- ---------- TABLE ---------- --}}
    <div class="vl-table-card">
        <div class="table-responsive">
            <table class="vl-table">

                <thead>
                    <tr>
                        <th style="width:42%;">Posisi</th>
                        <th>Tipe</th>
                        <th>Batas Lamaran</th>
                        <th>Status</th>
                        <th class="text-center">Pelamar</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($vacancies as $v)
                    <tr>
                        <td>
                            <div class="vl-position">
                                @if ($v->path_gambar)
                                    <img src="{{ asset('storage/'.$v->path_gambar) }}"
                                         alt="{{ $v->judul }}"
                                         class="vl-thumb">
                                @else
                                    <div class="vl-thumb-fallback">
                                        <i class="fa-solid fa-briefcase"></i>
                                    </div>
                                @endif

                                <div class="vl-position-body">
                                    <a href="{{ route('careers.show', $v) }}"
                                       target="_blank"
                                       class="vl-position-title">
                                        {{ $v->judul }}
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <div class="vl-position-meta">
                                        <span><i class="fa-solid fa-building"></i> {{ $v->departemen ?? '-' }}</span>
                                        <span><i class="fa-solid fa-location-dot"></i> {{ $v->lokasi }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td><span class="vl-tag">{{ $v->jenis_pekerjaan }}</span></td>

                        <td>
                            @if ($v->batas_lamaran)
                                <span class="vl-deadline {{ $v->batas_lamaran->isPast() ? 'is-past' : '' }}">
                                    {{ $v->batas_lamaran->format('d M Y') }}
                                </span>
                            @else
                                <span style="color:#7f95c9;font-size:.8rem;">Tanpa batas</span>
                            @endif
                        </td>

                        <td>
                            @if ($v->isOpen())
                                <span class="vl-pill is-active">Aktif</span>
                            @elseif (! $v->aktif)
                                <span class="vl-pill is-inactive">Nonaktif</span>
                            @else
                                <span class="vl-pill is-expired">Kedaluwarsa</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <span class="vl-applicant">
                                <i class="fa-solid fa-user-group" style="font-size:.65rem;"></i>
                                {{ $v->applications_count }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="vl-actions">

                                <form action="{{ route('admin.vacancies.toggle', $v) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="vl-action action-toggle {{ $v->aktif ? 'active-mode' : 'inactive-mode' }}"
                                            title="{{ $v->aktif ? 'Sembunyikan dari publik' : 'Tampilkan ke publik' }}">
                                        <i class="fa-solid {{ $v->aktif ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>

                                <a href="{{ route('admin.vacancies.edit', $v) }}"
                                   class="vl-action action-edit"
                                   title="Edit Lowongan">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.vacancies.destroy', $v) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus lowongan ini beserta seluruh lamarannya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="vl-action action-delete"
                                            title="Hapus Lowongan">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="vl-empty">
                                <div class="vl-empty-icon">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <div class="vl-empty-title">
                                    @if (request('q'))
                                        Tidak Ada Hasil Ditemukan
                                    @elseif ($tab === 'active')
                                        Belum Ada Lowongan Aktif
                                    @elseif ($tab === 'inactive')
                                        Belum Ada Lowongan Nonaktif
                                    @elseif ($tab === 'expired')
                                        Tidak Ada Lowongan Kedaluwarsa
                                    @else
                                        Belum Ada Lowongan
                                    @endif
                                </div>
                                <div class="vl-empty-text">
                                    @if (request('q'))
                                        Coba kata kunci lain atau reset pencarian Anda.
                                    @elseif ($tab === 'all')
                                        Mulai dengan menambahkan lowongan pertama Anda.
                                    @else
                                        Tidak ada data pada kategori ini saat ini.
                                    @endif
                                </div>
                                @if ($tab === 'all' && ! request('q'))
                                    <a href="{{ route('admin.vacancies.create') }}" class="vl-btn-primary">
                                        <i class="fa-solid fa-plus"></i> Tambah Lowongan Pertama
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

    {{-- ---------- PAGINATION ---------- --}}
    @if ($vacancies->hasPages())
        <div class="vl-pagination">
            {{ $vacancies->withQueryString()->links() }}
        </div>
    @endif

</div>


{{-- ============================================================
     SCRIPT
     ============================================================ --}}
<script>
(function () {
    'use strict';

    /* Ripple pada tombol utama & action */
    document.querySelectorAll('.vl-btn-primary, .vl-action, .vl-tab').forEach(function (el) {
        el.addEventListener('click', function (e) {
            const r = el.getBoundingClientRect();
            const s = Math.max(r.width, r.height);
            const span = document.createElement('span');

            span.className = 'vl-ripple';
            span.style.cssText =
                'width:'  + s + 'px;' +
                'height:' + s + 'px;' +
                'left:'   + (e.clientX - r.left - s / 2) + 'px;' +
                'top:'    + (e.clientY - r.top  - s / 2) + 'px;';

            el.appendChild(span);
            setTimeout(function () { span.remove(); }, 600);
        });
    });
})();
</script>

@endsection