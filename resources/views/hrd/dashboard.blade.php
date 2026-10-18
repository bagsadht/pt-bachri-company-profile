@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

{{-- ============================================================
     DATA PREPARATION
     ============================================================ --}}
@php
    /* ---------- BAR CHART: Lamaran per Bulan ---------- */
    $chartData = $chartData ?? [];
    $counts    = array_column($chartData, 'count');
    $barMax    = !empty($counts) ? max($counts) : 0;
    $barTotal  = array_sum($counts);
    $barAvg    = count($chartData) ? round($barTotal / count($chartData), 1) : 0;
    $barLast   = !empty($chartData) ? end($chartData)['count'] : 0;

    /* Nice grid untuk Y-axis */
    if ($barMax <= 0) {
        $gridMax  = 5;
        $gridStep = 1;
    } else {
        $magnitude  = pow(10, floor(log10($barMax)));
        $normalized = $barMax / $magnitude;
        if ($normalized <= 1)      $nice = 1;
        elseif ($normalized <= 2)  $nice = 2;
        elseif ($normalized <= 5)  $nice = 5;
        else                       $nice = 10;
        $gridMax  = $nice * $magnitude;
        if ($gridMax < $barMax) $gridMax = $barMax * 1.15;
        $gridStep = $gridMax / 4;
    }

    /* ---------- DONUT: Distribusi Status Seleksi ---------- */
    $stAktif    = (int) ($stats['aktif']    ?? $stats['active']    ?? 0);
    $stDiterima = (int) ($stats['diterima'] ?? $stats['hired']     ?? 0);
    $stDitolak  = (int) ($stats['ditolak']  ?? $stats['rejected']  ?? 0);
    $stTotal    = $stAktif + $stDiterima + $stDitolak;

    $pAktif    = $stTotal ? round($stAktif    / $stTotal * 100, 1) : 0;
    $pDiterima = $stTotal ? round($stDiterima / $stTotal * 100, 1) : 0;
    $pDitolak  = $stTotal ? round($stDitolak  / $stTotal * 100, 1) : 0;

    /* SVG donut math */
    $r = 70;
    $c = 2 * M_PI * $r;
    $aAktif    = ($pAktif    / 100) * $c;
    $aDiterima = ($pDiterima / 100) * $c;
    $aDitolak  = ($pDitolak  / 100) * $c;

    /* ---------- SUB-METRICS untuk Stat Cards ---------- */
    $totalApps   = $stats['total_applicants'] ?? 0;
    $successRate = $totalApps > 0
        ? round(($stats['hired'] / $totalApps) * 100, 1)
        : 0;
@endphp


{{-- ============================================================
     STYLE
     ============================================================ --}}
<style>
/* ---------- VARIABEL & RESET ---------- */
.hrd-page {
    --h-bg:     #0b1222;
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

    position: relative;
    isolation: isolate;
    padding: 1.75rem;
    border-radius: 24px;
    min-height: 100%;
    overflow: hidden;
    color: var(--h-text);
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    background:
        radial-gradient(1200px 700px at 15% 0%,    #17275a 0%, transparent 55%),
        radial-gradient(900px  600px at 100% 100%, #1b1a5e 0%, transparent 55%),
        var(--h-bg);
}
.hrd-page > * { position: relative; z-index: 1; }

.hrd-page::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    background-image: radial-gradient(rgba(255,255,255,.045) 1px, transparent 1px);
    background-size: 26px 26px;
    -webkit-mask-image: radial-gradient(ellipse at center, #000 25%, transparent 80%);
            mask-image: radial-gradient(ellipse at center, #000 25%, transparent 80%);
}

/* ---------- BLOB DEKORATIF ---------- */
.hrd-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: .38;
    pointer-events: none;
    z-index: 0;
}
.hrd-blob.b1 { width: 380px; height: 380px; background: var(--h-blue);   top: -150px;    left: -110px;  animation: hb1 18s ease-in-out infinite; }
.hrd-blob.b2 { width: 340px; height: 340px; background: var(--h-indigo); bottom: -170px; right: -90px;  animation: hb2 22s ease-in-out infinite; }
.hrd-blob.b3 { width: 240px; height: 240px; background: var(--h-cyan);   top: 45%;       left: 55%;     opacity: .16; animation: hb3 26s ease-in-out infinite; }

@keyframes hb1 { 50% { transform: translate(80px, 60px)   scale(1.15); } }
@keyframes hb2 { 50% { transform: translate(-90px, -55px) scale(1.12); } }
@keyframes hb3 { 50% { transform: translate(-50px, 70px)  scale(.9);   } }

/* ---------- HEADER ---------- */
.hrd-head { margin-bottom: 1.75rem; animation: h-enter .5s cubic-bezier(.2,.7,.2,1) both; }
.hrd-title {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 800;
    letter-spacing: -.03em;
    background: linear-gradient(120deg, #fff 15%, #a5c4ff 55%, #67e8f9 100%);
    -webkit-background-clip: text;
            background-clip: text;
    color: transparent;
}
.hrd-sub { margin: .4rem 0 0; font-size: .9rem; color: var(--h-muted); }

/* ---------- GLASS CARD ---------- */
.glass-card {
    padding: 1.75rem;
    border-radius: 20px;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 24px 60px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.08);
    animation: h-enter .5s .1s cubic-bezier(.2,.7,.2,1) both;
    height: 100%;
}
.glass-card h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: -.01em;
    color: #f1f5f9;
}
.glass-card .card-meta {
    display: block;
    margin-top: .25rem;
    font-size: .78rem;
    color: var(--h-soft);
}

/* ---------- STAT CARDS ---------- */
.stat-card {
    position: relative;
    height: 100%;
    padding: 1.75rem;
    border-radius: 20px;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 24px 60px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.08);
    overflow: hidden;
    transition: transform .25s, box-shadow .25s;
    animation: h-enter .5s cubic-bezier(.2,.7,.2,1) both;
}
.stat-card::before {
    content: "";
    position: absolute;
    inset: 0 auto 0 0;
    width: 4px;
    background: var(--accent, var(--h-blue));
    box-shadow: 0 0 24px var(--accent, var(--h-blue));
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 32px 70px -30px rgba(0,0,0,.9), inset 0 1px 0 rgba(255,255,255,.10);
}
.stat-head { display: flex; justify-content: space-between; align-items: flex-start; }
.stat-num {
    font-size: 2.6rem;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -.04em;
    color: #f8fafc;
}
.stat-label { margin-top: .85rem; font-size: .95rem; font-weight: 500; color: var(--h-muted); }
.stat-ico {
    width: 52px;
    height: 52px;
    display: grid;
    place-items: center;
    font-size: 1.5rem;
    color: #fff;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--accent, var(--h-blue)), var(--h-indigo));
    box-shadow: 0 12px 26px -10px var(--accent, var(--h-blue));
}
.stat-foot {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    margin-top: 1rem;
    font-size: .82rem;
    font-weight: 600;
    color: var(--h-soft);
}
.stat-foot i { color: var(--accent, var(--h-blue)); }

/* ============================================================
   BAR CHART
   ============================================================ */
.chart-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: .25rem;
}
.chart-legend {
    display: flex;
    gap: 1.25rem;
    font-size: .82rem;
    color: var(--h-muted);
}
.chart-legend span { display: inline-flex; align-items: center; gap: .5rem; }
.chart-legend i {
    width: 11px;
    height: 11px;
    border-radius: 3px;
    display: inline-block;
}
.chart-legend .c-bar {
    background: linear-gradient(180deg, #60a5fa, #4f46e5);
    box-shadow: 0 0 8px rgba(96,165,250,.6);
}

/* Summary chips di atas chart */
.chart-summary {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
    margin-top: 1rem;
}
.summary-chip {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .45rem .85rem;
    font-size: .78rem;
    color: var(--h-muted);
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 10px;
}
.summary-chip strong { color: #fff; font-weight: 700; }

/* Chart body */
.chart-wrap {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
    padding-top: 1.25rem;
}
.chart-y {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-end;
    height: 320px;
    padding-bottom: 4px;
    font-size: .74rem;
    color: var(--h-soft);
    font-variant-numeric: tabular-nums;
    min-width: 34px;
}
.chart-area {
    flex: 1;
    position: relative;
    height: 320px;
    border-bottom: 1px solid var(--h-line);
    border-left: 1px solid var(--h-line-2);
}
.chart-area .grid {
    position: absolute;
    left: 0;
    right: 0;
    border-top: 1px dashed rgba(255,255,255,.07);
}
.chart-area .grid:first-child { border-top: 0; }

.chart-bars {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: flex-end;
    gap: .65rem;
    padding: 0 .85rem;
}
.bar-group {
    flex: 1;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    position: relative;
    min-width: 0;
}
.bar {
    width: 100%;
    max-width: 46px;
    min-height: 4px;
    border-radius: 6px 6px 0 0;
    background: linear-gradient(180deg, #60a5fa, #4f46e5);
    box-shadow: 0 6px 20px -6px rgba(96,165,250,.7), inset 0 1px 0 rgba(255,255,255,.25);
    position: relative;
    cursor: pointer;
    transition: filter .2s, transform .2s;
}
.bar:hover {
    filter: brightness(1.2);
    transform: translateY(-2px);
}
.bar-value {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: .72rem;
    font-weight: 700;
    color: #e0e7ff;
    white-space: nowrap;
}
.bar:hover .bar-value { color: #fff; }

/* Tooltip */
.bar[data-tip]::after {
    content: attr(data-tip);
    position: absolute;
    bottom: calc(100% + 8px);
    left: 50%;
    transform: translateX(-50%) translateY(4px);
    padding: .4rem .7rem;
    font-size: .72rem;
    font-weight: 600;
    color: #fff;
    background: rgba(11,19,30,.98);
    border: 1px solid rgba(96,165,250,.4);
    border-radius: 8px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity .18s, transform .18s;
    z-index: 5;
}
.bar[data-tip]:hover::after {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

/* X-axis labels */
.chart-x {
    display: flex;
    margin-left: calc(34px + 1rem);
    margin-top: .85rem;
    gap: .65rem;
    padding: 0 .85rem;
}
.chart-x > div {
    flex: 1;
    text-align: center;
    font-size: .74rem;
    color: var(--h-soft);
    font-weight: 500;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Empty chart */
.chart-empty {
    padding: 4rem 1rem;
    text-align: center;
    color: var(--h-muted);
    font-size: .88rem;
}
.chart-empty i {
    display: block;
    font-size: 2rem;
    margin-bottom: .75rem;
    opacity: .35;
}

/* ============================================================
   DONUT CHART
   ============================================================ */
.donut-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 1.5rem 0 .5rem;
    position: relative;
}
.donut-wrap svg {
    transform: rotate(-90deg);
    filter: drop-shadow(0 12px 30px rgba(59,130,246,.25));
}
.donut-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    pointer-events: none;
}
.donut-center small {
    display: block;
    font-size: .72rem;
    color: var(--h-soft);
    font-weight: 500;
    letter-spacing: .05em;
    text-transform: uppercase;
}
.donut-center b {
    display: block;
    font-size: 2.1rem;
    font-weight: 800;
    line-height: 1.1;
    color: #f8fafc;
    letter-spacing: -.03em;
}

/* Legend donut */
.donut-legend {
    display: grid;
    gap: .65rem;
    margin-top: 1.5rem;
}
.donut-legend-item {
    display: flex;
    align-items: center;
    gap: .65rem;
    font-size: .85rem;
    color: #cbd5e1;
}
.donut-legend-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
    box-shadow: 0 0 8px currentColor;
    background: currentColor;
}
.donut-legend-item .lbl { flex: 1; }
.donut-legend-item .pct {
    font-weight: 700;
    color: #fff;
    font-variant-numeric: tabular-nums;
}
.donut-legend-item .num {
    font-size: .75rem;
    color: var(--h-soft);
    margin-left: .35rem;
    font-weight: 500;
}

/* ============================================================
   REVIEW TABLE
   ============================================================ */
.review-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: .75rem;
    margin-bottom: 1.25rem;
}
.review-search {
    position: relative;
    width: 280px;
}
.review-search input {
    width: 100%;
    height: 42px;
    padding: 0 1rem 0 2.6rem;
    font: inherit;
    font-size: .88rem;
    color: #fff;
    background: rgba(7,12,28,.55);
    border: 1.5px solid var(--h-line);
    border-radius: 12px;
    outline: none;
    transition: all .2s;
}
.review-search input::placeholder { color: #5f739f; }
.review-search input:focus {
    border-color: #60a5fa;
    background: rgba(7,12,28,.85);
    box-shadow: 0 0 0 4px rgba(59,130,246,.18);
}
.review-search i {
    position: absolute;
    left: .95rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: .82rem;
    color: #6f84b3;
    pointer-events: none;
}

.dark-table { width: 100%; border-collapse: collapse; }
.dark-table thead th {
    padding: .9rem 1rem;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--h-soft);
    text-align: left;
    border-bottom: 1px solid var(--h-line);
}
.dark-table thead th.r { text-align: right; }
.dark-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.05);
    transition: background .18s;
}
.dark-table tbody tr:last-child { border-bottom: 0; }
.dark-table tbody tr:hover      { background: rgba(96,165,250,.06); }
.dark-table td {
    padding: 1.05rem 1rem;
    font-size: .88rem;
    color: #cbd5e1;
    vertical-align: middle;
}

.cell-user { display: flex; align-items: center; gap: .9rem; }
.avatar {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    font-weight: 800;
    color: #fff;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 0 0 2px rgba(255,255,255,.10), 0 8px 18px -8px rgba(79,70,229,.85);
}
.user-name  { font-size: .92rem; font-weight: 700; color: #f1f5f9; }
.user-mail  { margin-top: 2px; font-size: .75rem; color: var(--h-soft); }

/* ---------- PILL ---------- */
.pill {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .35rem .85rem;
    font-size: .75rem;
    font-weight: 600;
    border-radius: 999px;
    white-space: nowrap;
}
.pill .dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    box-shadow: 0 0 8px currentColor;
}
.pill.green  { color: #6ee7b7; background: rgba(16,185,129,.12);  border: 1px solid rgba(16,185,129,.3); }
.pill.red    { color: #fda4af; background: rgba(251,113,133,.12); border: 1px solid rgba(251,113,133,.3); }
.pill.orange { color: #fcd34d; background: rgba(245,158,11,.12);  border: 1px solid rgba(245,158,11,.3); }
.pill.gray   { color: #cbd5e1; background: rgba(148,163,184,.12); border: 1px solid rgba(148,163,184,.3); }

/* ---------- BUTTONS ---------- */
.btn-primary {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    height: 42px;
    padding: 0 1.1rem;
    font: inherit;
    font-size: .85rem;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    border: 0;
    border-radius: 12px;
    cursor: pointer;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 12px 26px -12px rgba(79,70,229,.9);
    transition: transform .18s, box-shadow .18s, filter .18s;
}
.btn-primary:hover  { transform: translateY(-2px); box-shadow: 0 18px 32px -12px rgba(79,70,229,1); filter: brightness(1.08); }
.btn-primary:active { transform: translateY(0); }

.icon-btn {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .85rem;
    color: #a9b8d8;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    transition: all .18s;
}
.icon-btn:hover {
    color: #fff;
    transform: translateY(-2px);
    background: rgba(96,165,250,.16);
    border-color: rgba(96,165,250,.42);
    box-shadow: 0 8px 18px -8px rgba(96,165,250,.7);
}

.h-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,.4);
    transform: scale(0);
    animation: h-ripple .6s ease-out;
    pointer-events: none;
}
@keyframes h-ripple { to { transform: scale(4); opacity: 0; } }

/* ---------- EMPTY ---------- */
.empty { padding: 4rem 1rem; text-align: center; color: var(--h-muted); }
.empty i { display: block; font-size: 2.5rem; margin-bottom: .85rem; opacity: .35; }
.empty strong { display: block; font-size: 1rem; font-weight: 700; color: #cbd5e1; margin-bottom: .35rem; }

/* ---------- ANIMASI & RESPONSIF ---------- */
@keyframes h-enter {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: none; }
}

@media (prefers-reduced-motion: reduce) {
    .hrd-page *,
    .hrd-page *::before,
    .hrd-page *::after {
        animation: none !important;
        transition: none !important;
    }
}

@media (max-width: 768px) {
    .hrd-page       { padding: 1.25rem; border-radius: 18px; }
    .hrd-title      { font-size: 1.4rem; }
    .stat-num       { font-size: 2.1rem; }
    .stat-ico       { width: 44px; height: 44px; font-size: 1.2rem; }
    .review-search  { width: 100%; }
    .chart-y        { font-size: .68rem; min-width: 26px; }
    .chart-x,
    .chart-x > div  { font-size: .65rem; }
    .chart-bars     { gap: .35rem; padding: 0 .4rem; }
    .bar-value      { font-size: .6rem; top: -16px; }
    .chart-x        { margin-left: calc(26px + 1rem); padding: 0 .4rem; }
}
</style>


{{-- ============================================================
     KONTEN
     ============================================================ --}}
<div class="hrd-page">

    <span class="hrd-blob b1" aria-hidden="true"></span>
    <span class="hrd-blob b2" aria-hidden="true"></span>
    <span class="hrd-blob b3" aria-hidden="true"></span>

    {{-- ---------- HEADER ---------- --}}
    <div class="hrd-head">
        <h1 class="hrd-title">Dashboard</h1>
        <p class="hrd-sub">HrisApps / index — ringkasan aktivitas rekrutmen hari ini.</p>
    </div>

    {{-- ---------- STAT CARDS ---------- --}}
    <div class="row g-4 mb-4">

        {{-- Total Pelamar --}}
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" style="--accent:#60a5fa;">
                <div class="stat-head">
                    <div>
                        <div class="stat-num">{{ number_format($stats['total_applicants']) }}</div>
                        <div class="stat-label">Total Pelamar</div>
                    </div>
                    <div class="stat-ico"><i class="fa-solid fa-users"></i></div>
                </div>
                <div class="stat-foot">
                    <i class="fa-solid fa-calendar-day"></i>
                    {{ $barLast }} lamaran bulan ini
                </div>
            </div>
        </div>

        {{-- Total Lowongan --}}
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" style="--accent:#a78bfa;">
                <div class="stat-head">
                    <div>
                        <div class="stat-num">{{ number_format($stats['total_vacancies']) }}</div>
                        <div class="stat-label">Lowongan</div>
                    </div>
                    <div class="stat-ico"><i class="fa-solid fa-gauge"></i></div>
                </div>
                <div class="stat-foot">
                    <i class="fa-solid fa-layer-group"></i>
                    Total dipublikasikan
                </div>
            </div>
        </div>

        {{-- Total Perekrutan --}}
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" style="--accent:#34d399;">
                <div class="stat-head">
                    <div>
                        <div class="stat-num">{{ number_format($stats['hired']) }}</div>
                        <div class="stat-label">Total Perekrutan</div>
                    </div>
                    <div class="stat-ico"><i class="fa-solid fa-arrow-up-wide-short"></i></div>
                </div>
                <div class="stat-foot">
                    <i class="fa-solid fa-percent"></i>
                    Rasio sukses {{ $successRate }}%
                </div>
            </div>
        </div>

        {{-- Kandidat Terpilih --}}
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" style="--accent:#22d3ee;">
                <div class="stat-head">
                    <div>
                        <div class="stat-num">{{ number_format($stats['new_applicants']) }}</div>
                        <div class="stat-label">Kandidat Terpilih</div>
                    </div>
                    <div class="stat-ico"><i class="fa-solid fa-user-check"></i></div>
                </div>
                <div class="stat-foot">
                    <i class="fa-solid fa-clock"></i>
                    Sedang berjalan
                </div>
            </div>
        </div>

    </div>

    {{-- ---------- CHART ROW ---------- --}}
    <div class="row g-4 mb-4">

        {{-- ============================================
             BAR CHART: Lamaran per Bulan
             ============================================ --}}
        <div class="col-lg-8">
            <div class="glass-card">
                <div class="chart-toolbar">
                    <div>
                        <h3>Tren Lamaran Masuk</h3>
                        <span class="card-meta">Jumlah pelamar per bulan</span>
                    </div>
                    <div class="chart-legend">
                        <span><i class="c-bar"></i> Lamaran</span>
                    </div>
                </div>

                {{-- Summary chips --}}
                <div class="chart-summary">
                    <span class="summary-chip">
                        Total <strong>{{ number_format($barTotal) }}</strong>
                    </span>
                    <span class="summary-chip">
                        Rata-rata <strong>{{ $barAvg }}/bulan</strong>
                    </span>
                    <span class="summary-chip">
                        Puncak <strong>{{ $barMax }}</strong>
                    </span>
                </div>

                @if (empty($chartData))
                    <div class="chart-empty">
                        <i class="fa-solid fa-chart-column"></i>
                        Belum ada data lamaran untuk ditampilkan.
                    </div>
                @else
                    {{-- Chart body --}}
                    <div class="chart-wrap">

                        {{-- Y-axis --}}
                        <div class="chart-y">
                            @for ($i = 4; $i >= 0; $i--)
                                <span>{{ round($gridStep * $i) }}</span>
                            @endfor
                        </div>

                        {{-- Area grafik --}}
                        <div class="chart-area">

                            {{-- Grid lines --}}
                            @for ($i = 0; $i <= 4; $i++)
                                <div class="grid" style="top: {{ $i * 25 }}%;"></div>
                            @endfor

                            {{-- Bars --}}
                            <div class="chart-bars">
                                @foreach ($chartData as $data)
                                    @php
                                        $count   = (int) $data['count'];
                                        $heightP = $gridMax > 0
                                            ? min(100, ($count / $gridMax) * 100)
                                            : 0;
                                    @endphp
                                    <div class="bar-group">
                                        <div class="bar"
                                             style="height: {{ max($heightP, 1.5) }}%;"
                                             data-tip="{{ $data['label'] }}: {{ $count }} lamaran">
                                            <span class="bar-value">{{ $count }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    {{-- X-axis --}}
                    <div class="chart-x">
                        @foreach ($chartData as $data)
                            <div>{{ $data['label'] }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- ============================================
             DONUT: Distribusi Status Seleksi
             ============================================ --}}
        <div class="col-lg-4">
            <div class="glass-card">
                <h3>Status Seleksi</h3>
                <span class="card-meta">Distribusi kandidat saat ini</span>

                <div class="donut-wrap">
                    <svg width="220" height="220" viewBox="0 0 180 180">
                        <defs>
                            <linearGradient id="gradAktif" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="#fcd34d"/>
                                <stop offset="1" stop-color="#f59e0b"/>
                            </linearGradient>
                            <linearGradient id="gradDiterima" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="#34d399"/>
                                <stop offset="1" stop-color="#10b981"/>
                            </linearGradient>
                            <linearGradient id="gradDitolak" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="#fb7185"/>
                                <stop offset="1" stop-color="#be123c"/>
                            </linearGradient>
                        </defs>

                        {{-- Background ring --}}
                        <circle cx="90" cy="90" r="{{ $r }}"
                                fill="none"
                                stroke="rgba(255,255,255,.04)"
                                stroke-width="24"/>

                        @if ($stTotal > 0)
                            {{-- Segmen 1: Aktif --}}
                            @if ($aAktif > 0)
                                <circle cx="90" cy="90" r="{{ $r }}"
                                        fill="none"
                                        stroke="url(#gradAktif)"
                                        stroke-width="24"
                                        stroke-dasharray="{{ $aAktif }} {{ $c }}"
                                        stroke-dashoffset="0"/>
                            @endif

                            {{-- Segmen 2: Diterima --}}
                            @if ($aDiterima > 0)
                                <circle cx="90" cy="90" r="{{ $r }}"
                                        fill="none"
                                        stroke="url(#gradDiterima)"
                                        stroke-width="24"
                                        stroke-dasharray="{{ $aDiterima }} {{ $c }}"
                                        stroke-dashoffset="{{ -$aAktif }}"/>
                            @endif

                            {{-- Segmen 3: Ditolak --}}
                            @if ($aDitolak > 0)
                                <circle cx="90" cy="90" r="{{ $r }}"
                                        fill="none"
                                        stroke="url(#gradDitolak)"
                                        stroke-width="24"
                                        stroke-dasharray="{{ $aDitolak }} {{ $c }}"
                                        stroke-dashoffset="{{ -($aAktif + $aDiterima) }}"/>
                            @endif
                        @endif
                    </svg>

                    <div class="donut-center">
                        <small>Total</small>
                        <b>{{ $stTotal }}</b>
                        <small>Kandidat</small>
                    </div>
                </div>

                <div class="donut-legend">
                    <div class="donut-legend-item" style="color:#f59e0b;">
                        <span class="donut-legend-dot"></span>
                        <span class="lbl">Aktif Seleksi</span>
                        <span class="num">({{ $stAktif }})</span>
                        <span class="pct">{{ $pAktif }}%</span>
                    </div>
                    <div class="donut-legend-item" style="color:#10b981;">
                        <span class="donut-legend-dot"></span>
                        <span class="lbl">Diterima</span>
                        <span class="num">({{ $stDiterima }})</span>
                        <span class="pct">{{ $pDiterima }}%</span>
                    </div>
                    <div class="donut-legend-item" style="color:#fb7185;">
                        <span class="donut-legend-dot"></span>
                        <span class="lbl">Ditolak</span>
                        <span class="num">({{ $stDitolak }})</span>
                        <span class="pct">{{ $pDitolak }}%</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ---------- REVIEW TABLE ---------- --}}
    <div class="glass-card">
        <div class="review-head">
            <h3>Review</h3>
            <div class="review-search">
                <input type="text" placeholder="Cari pelamar..." id="reviewSearch">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>

        <div class="table-responsive">
            <table class="dark-table" id="reviewTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Department</th>
                        <th>Posisi</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th class="r">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($recentApplicants as $a)
                    <tr>
                        <td>
                            <div class="cell-user">
                                <div class="avatar">{{ strtoupper(substr($a->nama ?? 'A', 0, 1)) }}</div>
                                <div>
                                    <div class="user-name">{{ $a->nama ?? 'Anonim' }}</div>
                                    <div class="user-mail">{{ $a->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $a->vacancy->departemen ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($a->vacancy->judul ?? '-', 30) }}</td>
                        <td>
                            {{ $a->created_at->format('d M Y') }}
                            <div class="user-mail">{{ $a->created_at->format('H.i') }} WIB</div>
                        </td>
                        <td>
                            @php
                                $statusMap = [
                                    'baru'     => ['label' => 'Pending Interview', 'class' => 'orange'],
                                    'diterima' => ['label' => 'Diterima',          'class' => 'green'],
                                    'ditolak'  => ['label' => 'Ditolak',           'class' => 'gray'],
                                ];
                                $st = $statusMap[$a->status] ?? ['label' => ucfirst($a->status ?? '-'), 'class' => 'gray'];
                            @endphp
                            <span class="pill {{ $st['class'] }}">
                                <span class="dot"></span> {{ $st['label'] }}
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <a href="{{ route('hrd.applications.index') }}" class="icon-btn" title="Lihat Portfolio">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="border:0;">
                            <div class="empty">
                                <i class="fa-solid fa-folder-open"></i>
                                <strong>Belum Ada Data Pelamar</strong>
                                Data akan muncul setelah ada yang melamar.
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>


{{-- ============================================================
     SCRIPT
     ============================================================ --}}
<script>
(function () {
    'use strict';

    /* ---------- 1. Ripple pada semua tombol ---------- */
    document.querySelectorAll('.btn-primary, .icon-btn').forEach(function (el) {
        el.addEventListener('click', function (e) {
            const r = el.getBoundingClientRect();
            const s = Math.max(r.width, r.height);
            const span = document.createElement('span');

            span.className = 'h-ripple';
            span.style.cssText =
                'width:'  + s + 'px;' +
                'height:' + s + 'px;' +
                'left:'   + (e.clientX - r.left - s / 2) + 'px;' +
                'top:'    + (e.clientY - r.top  - s / 2) + 'px;';

            el.appendChild(span);
            setTimeout(function () { span.remove(); }, 600);
        });
    });

    /* ---------- 2. Pencarian di tabel Review ---------- */
    const search = document.getElementById('reviewSearch');
    const table  = document.getElementById('reviewTable');

    if (search && table) {
        search.addEventListener('input', function () {
            const q = search.value.toLowerCase().trim();
            table.querySelectorAll('tbody tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }
})();
</script>

@endsection