@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
@php
    $statusColors = [
        'baru'      => '#f59e0b',
        'diproses'  => '#3b82f6',
        'wawancara' => '#8b5cf6',
        'diterima'  => '#10b981',
        'ditolak'   => '#64748b',
    ];

    $maxDay       = max(1, collect($chart)->max('total'));
    $totalStatus  = max(1, collect($statusCounts)->sum('total'));

    // Donut Chart Calculations
    $radius        = 60; 
    $circumference = 2 * M_PI * $radius;
    $cumulative    = 0;
    $donutSegments = [];

    foreach ($statusCounts as $key => $row) {
        $pct = $row['total'] / $totalStatus;
        $len = $pct * $circumference;
        $donutSegments[] = [
            'key'       => $key, 
            'label'     => $row['label'], 
            'total'     => $row['total'],
            'pct'       => round($pct * 100),
            'color'     => $statusColors[$key] ?? '#94a3b8',
            'dasharray' => $len . ' ' . ($circumference - $len),
            'offset'    => -$cumulative,
        ];
        $cumulative += $len;
    }

    // Line Chart Calculations
    $chartCount = max(count($chart) - 1, 1);
    $points     = [];

    foreach ($chart as $i => $bar) {
        $x = round(($i / $chartCount) * 560) + 20;
        $y = 170 - round(($bar['total'] / $maxDay) * 150);
        $points[] = ['x' => $x, 'y' => $y, 'total' => $bar['total'], 'label' => $bar['label']];
    }
    
    $polyline = collect($points)->map(fn($p) => $p['x'] . ',' . $p['y'])->implode(' ');
    $areaPath = 'M ' . $points[0]['x'] . ',170 L ' . $polyline . ' L ' . end($points)['x'] . ',170 Z';

    // Greeting Logic
    $hour     = now()->hour;
    $greeting = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 19 ? 'Selamat sore' : 'Selamat malam'));
@endphp

<style>
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { opacity: 0; animation: fadeSlideUp .55s cubic-bezier(0.22, 1, 0.36, 1) forwards; }

    .dash-header {
        background: linear-gradient(135deg, #0b131e 0%, #1a365d 100%);
        border-radius: 20px; padding: 2rem 2.25rem; margin-bottom: 1.75rem; color: #fff;
        position: relative; overflow: hidden;
    }
    .dash-header::before {
        content: ''; position: absolute; top: -60%; right: -10%; width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(241,196,15,.18) 0%, transparent 70%); border-radius: 50%;
        animation: pulseGlow 5s ease-in-out infinite;
    }
    @keyframes pulseGlow { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: .7; transform: scale(1.08); } }
    .dash-header-inner { position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
    .dash-header h1 { font-weight: 800; font-size: 1.5rem; margin-bottom: .25rem; }
    .dash-header p { color: rgba(255,255,255,.65); font-size: .9rem; margin: 0; display: flex; align-items: center; gap: .5rem; }

    .live-dot { width: 7px; height: 7px; border-radius: 50%; background: #34d399; display: inline-block; animation: livePulse 2s ease-in-out infinite; }
    @keyframes livePulse { 0%, 100% { box-shadow: 0 0 0 0 rgba(52,211,153,.6); } 70% { box-shadow: 0 0 0 6px rgba(52,211,153,0); } }

    .btn-dash-primary {
        background: #f1c40f; color: #0b131e; font-weight: 700; border: 0; padding: .65rem 1.4rem;
        border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: .5rem;
        transition: all .25s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 8px 20px -8px rgba(241,196,15,.6);
    }
    .btn-dash-primary:hover { transform: translateY(-2px) scale(1.03); color: #0b131e; box-shadow: 0 14px 30px -8px rgba(241,196,15,.8); }
    .btn-dash-primary svg { transition: transform .3s; }
    .btn-dash-primary:hover svg { transform: rotate(90deg); }

    .stat-card {
        background: #fff; border-radius: 18px; padding: 1.5rem; border: 1px solid #eef0f3;
        text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;
        transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 8px 24px -16px rgba(11,19,30,.15);
        position: relative; overflow: hidden;
    }
    .stat-card::before {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: var(--stat-color);
        transform: scaleX(0); transform-origin: left; transition: transform .4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .stat-card:hover::before { transform: scaleX(1); }
    .stat-card:hover { transform: translateY(-6px); box-shadow: 0 22px 44px -18px rgba(11,19,30,.28); color: inherit; }
    .stat-card-top { display: flex; justify-content: space-between; align-items: flex-start; }

    .stat-icon {
        width: 46px; height: 46px; border-radius: 13px; display: flex; align-items: center; justify-content: center;
        background: var(--stat-bg); color: var(--stat-color); margin-bottom: 1rem; transition: transform .35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .stat-card:hover .stat-icon { transform: rotate(-8deg) scale(1.08); }
    .stat-icon svg { width: 22px; height: 22px; }

    .stat-trend {
        font-size: .72rem; font-weight: 700; padding: .22rem .55rem; border-radius: 50px;
        display: inline-flex; align-items: center; gap: 3px; margin-top: .15rem;
    }
    .stat-trend.up { background: #10b9811a; color: #10b981; }
    .stat-trend.down { background: #ef44441a; color: #ef4444; }
    .stat-trend.flat { background: #94a3b81a; color: #64748b; }

    .stat-value { font-size: 2rem; font-weight: 800; color: #0b131e; line-height: 1; margin-bottom: .3rem; font-family: 'Outfit', sans-serif; }
    .stat-label { font-size: .85rem; font-weight: 600; color: #334155; margin-bottom: .2rem; }
    .stat-hint { font-size: .78rem; color: #94a3b8; }

    .panel-card { background: #fff; border-radius: 18px; border: 1px solid #eef0f3; box-shadow: 0 8px 24px -18px rgba(11,19,30,.15); height: 100%; }
    .panel-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f4f8; display: flex; justify-content: space-between; align-items: center; }
    .panel-card-header h2 { font-size: .95rem; font-weight: 700; color: #0b131e; margin: 0; }
    .panel-card-body { padding: 1.5rem; }

    .line-chart-svg { width: 100%; height: auto; overflow: visible; }
    .line-chart-area { fill: url(#areaGradient); opacity: 0; transition: opacity .8s ease .3s; }
    .line-chart-area.shown { opacity: 1; }
    .line-chart-path {
        fill: none; stroke: #f1c40f; stroke-width: 3; stroke-linecap: round; stroke-linejoin: round;
        stroke-dasharray: 900; stroke-dashoffset: 900; transition: stroke-dashoffset 1.2s cubic-bezier(0.65, 0, 0.35, 1);
    }
    .line-chart-path.shown { stroke-dashoffset: 0; }
    .line-chart-dot { fill: #fff; stroke: #f1c40f; stroke-width: 3; r: 5; transition: r .2s, stroke-width .2s; cursor: pointer; }
    .line-chart-dot:hover { r: 8; stroke-width: 4; }
    .line-chart-label { font-size: 11px; fill: #94a3b8; font-family: 'Inter', sans-serif; }

    .donut-wrap { display: flex; align-items: center; gap: 1.75rem; flex-wrap: wrap; justify-content: center; }
    .donut-svg { transform: rotate(-90deg); flex-shrink: 0; }
    .donut-seg { transition: stroke-dasharray 1s cubic-bezier(0.34, 1.56, 0.64, 1), stroke-width .2s, opacity .2s; cursor: pointer; }
    .donut-seg:hover { stroke-width: 19; }
    .donut-seg.dim { opacity: .3; }
    .donut-center-text { transform: rotate(90deg); }
    .donut-center-total { font-size: 1.6rem; font-weight: 800; fill: #0b131e; font-family: 'Outfit', sans-serif; }
    .donut-center-label { font-size: .68rem; fill: #94a3b8; }

    .legend-list { display: flex; flex-direction: column; gap: .4rem; flex: 1; min-width: 175px; }
    .legend-item {
        display: flex; align-items: center; justify-content: space-between; gap: .6rem; padding: .5rem .65rem;
        border-radius: 10px; cursor: pointer; transition: background .2s, transform .2s;
    }
    .legend-item:hover, .legend-item.active-legend { background: #f7f8fa; transform: translateX(3px); }
    .legend-item-left { display: flex; align-items: center; gap: .6rem; font-size: .82rem; font-weight: 600; color: #334155; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .legend-item-right { display: flex; align-items: center; gap: .5rem; }
    .legend-item-value { font-size: .82rem; font-weight: 700; color: #0b131e; }
    .legend-item-pct { font-size: .68rem; color: #94a3b8; min-width: 32px; text-align: right; }

    .dash-table thead th {
        font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: #94a3b8;
        border-bottom: 1px solid #f1f4f8; padding: .9rem 1rem; background: #fafbfc;
    }
    .dash-table tbody td { padding: .9rem 1rem; vertical-align: middle; border-bottom: 1px solid #f6f7f9; }
    .dash-table tbody tr { transition: background .18s; }
    .dash-table tbody tr:hover { background: #fafbfc; }
    .dash-table tbody tr:last-child td { border-bottom: none; }

    .avatar-circle {
        width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #f1c40f, #e67e22);
        color: #0b131e; font-weight: 800; font-size: .85rem; display: flex; align-items: center; justify-content: center;
    }
    .pill-badge { display: inline-flex; align-items: center; gap: 6px; padding: .3rem .75rem; border-radius: 50px; font-size: .74rem; font-weight: 700; }
    .status-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
    .status-dot.pulse { animation: dotPulse 1.6s ease-in-out infinite; }
    @keyframes dotPulse { 0%, 100% { box-shadow: 0 0 0 0 currentColor; opacity: 1; } 70% { box-shadow: 0 0 0 4px transparent; opacity: .7; } }

    .btn-soft {
        background: #f1f4f8; color: #334155; border: 0; padding: .4rem .9rem; border-radius: 8px; font-size: .8rem;
        font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: all .2s;
    }
    .btn-soft:hover { background: #0b131e; color: #fff; }
    .btn-soft-outline {
        background: #fff; color: #64748b; border: 1px solid #e2e8f0; padding: .38rem .85rem; border-radius: 8px;
        font-size: .8rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: all .2s;
    }
    .btn-soft-outline:hover { background: #f1f4f8; color: #334155; border-color: #cbd5e1; }
    .empty-state { text-align: center; padding: 3rem 1.5rem; color: #94a3b8; }
    .empty-state svg { width: 40px; height: 40px; margin-bottom: .75rem; opacity: .5; }

    @media (max-width: 767.98px) {
        .dash-header { padding: 1.5rem; }
        .dash-header-inner { flex-direction: column; align-items: flex-start; }
        .stat-value { font-size: 1.6rem; }
        .donut-wrap { flex-direction: column; }
    }
</style>

<!-- Header Section -->
<div class="dash-header fade-in">
    <div class="dash-header-inner">
        <div>
            <h1>{{ $greeting }}, Admin 👋</h1>
            <p><span class="live-dot"></span> {{ now()->translatedFormat('l, d F Y \p\u\k\u\l H:i') }}</p>
        </div>
        <a href="{{ route('admin.vacancies.create') }}" class="btn-dash-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Lowongan
        </a>
    </div>
</div>

<!-- Stat Cards Row -->
<div class="row g-3 mb-4">
    @php
        $statCards = [
            [
                'label' => 'Lowongan Dibuka', 
                'value' => $stats['open_vacancies'], 
                'hint'  => 'dari ' . $stats['total_vacancies'] . ' lowongan', 
                'link'  => route('admin.vacancies.index'), 
                'color' => '#10b981', 
                'bg'    => 'rgba(16,185,129,.12)', 
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>', 
                'trend' => null
            ],
            [
                'label' => 'Lamaran Baru', 
                'value' => $stats['new_applications'], 
                'hint'  => 'belum ditinjau', 
                'link'  => route('admin.applications.index', ['status' => 'baru']), 
                'color' => '#f59e0b', 
                'bg'    => 'rgba(245,158,11,.12)', 
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>', 
                'trend' => null
            ],
            [
                'label' => 'Status Pelamar', 
                'value' => $stats['total_applications'], 
                'hint'  => 'CV yang pernah masuk', 
                'link'  => route('admin.applications.index'), 
                'color' => '#3b82f6', 
                'bg'    => 'rgba(59,130,246,.12)', 
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>', 
                'trend' => $weeklyTrend
            ],
            [
                'label' => 'Bulan Ini', 
                'value' => $stats['this_month'], 
                'hint'  => 'lamaran sejak tgl 1', 
                'link'  => route('admin.applications.index'), 
                'color' => '#8b5cf6', 
                'bg'    => 'rgba(139,92,246,.12)', 
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>', 
                'trend' => null
            ],
        ];
    @endphp

    @foreach($statCards as $i => $s)
        <div class="col-6 col-lg-3">
            <a href="{{ $s['link'] }}" class="stat-card fade-in" style="--stat-color: {{ $s['color'] }}; --stat-bg: {{ $s['bg'] }}; animation-delay: {{ $i * 80 }}ms;">
                <div class="stat-card-top">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $s['icon'] !!}</svg>
                    </div>
                    @if(!is_null($s['trend']))
                        @php $t = $s['trend']; @endphp
                        <span class="stat-trend {{ $t > 0 ? 'up' : ($t < 0 ? 'down' : 'flat') }}">
                            @if($t > 0)&uarr;@elseif($t < 0)&darr;@else &middot; @endif
                            {{ abs($t) }}%
                        </span>
                    @endif
                </div>
                <div class="stat-value" data-count="{{ $s['value'] }}">0</div>
                <div class="stat-label">{{ $s['label'] }}</div>
                <div class="stat-hint">
                    {{ $s['hint'] }}
                    @if(!is_null($s['trend'])) &middot; vs minggu lalu @endif
                </div>
            </a>
        </div>
    @endforeach
</div>

<!-- Charts Row -->
<div class="row g-3 mb-4">
    <!-- Line Chart -->
    <div class="col-lg-7">
        <div class="panel-card fade-in" style="animation-delay: 320ms;">
            <div class="panel-card-header">
                <h2>📈 Tren Lamaran 7 Hari Terakhir</h2>
                <span class="pill-badge" style="background:rgba(241,196,15,.12);color:#a3720a;">
                    Total {{ collect($chart)->sum('total') }}
                </span>
            </div>
            <div class="panel-card-body">
                <svg class="line-chart-svg" viewBox="0 0 600 200" id="lineChart">
                    <defs>
                        <linearGradient id="areaGradient" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#f1c40f" stop-opacity="0.28"/>
                            <stop offset="100%" stop-color="#f1c40f" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    @for($g = 0; $g < 4; $g++)
                        <line x1="20" y1="{{ 20 + $g * 45 }}" x2="580" y2="{{ 20 + $g * 45 }}" stroke="#f1f4f8" stroke-width="1"/>
                    @endfor
                    <path class="line-chart-area" id="chartArea" d="{{ $areaPath }}"></path>
                    <polyline class="line-chart-path" id="chartLine" points="{{ $polyline }}"></polyline>
                    @foreach($points as $p)
                        <circle class="line-chart-dot" cx="{{ $p['x'] }}" cy="{{ $p['y'] }}">
                            <title>{{ $p['label'] }}: {{ $p['total'] }} lamaran</title>
                        </circle>
                        <text class="line-chart-label" x="{{ $p['x'] }}" y="192" text-anchor="middle">{{ $p['label'] }}</text>
                    @endforeach
                </svg>
            </div>
        </div>
    </div>

    <!-- Donut Chart -->
    <div class="col-lg-5">
        <div class="panel-card fade-in" style="animation-delay: 380ms;">
            <div class="panel-card-header"><h2>🗂️ Status Lamaran</h2></div>
            <div class="panel-card-body">
                <div class="donut-wrap">
                    <svg width="150" height="150" viewBox="0 0 150 150" class="donut-svg" id="donutSvg">
                        <circle cx="75" cy="75" r="60" fill="none" stroke="#f1f4f8" stroke-width="16"/>
                        @foreach($donutSegments as $i => $seg)
                            <circle class="donut-seg" data-index="{{ $i }}" cx="75" cy="75" r="60" fill="none"
                                    stroke="{{ $seg['color'] }}" stroke-width="16"
                                    stroke-dasharray="{{ $seg['dasharray'] }}" stroke-dashoffset="{{ $seg['offset'] }}">
                                <title>{{ $seg['label'] }}: {{ $seg['total'] }} ({{ $seg['pct'] }}%)</title>
                            </circle>
                        @endforeach
                        <g class="donut-center-text">
                            <text x="75" y="72" text-anchor="middle" class="donut-center-total">{{ $totalStatus }}</text>
                            <text x="75" y="90" text-anchor="middle" class="donut-center-label">Total</text>
                        </g>
                    </svg>

                    <div class="legend-list" id="legendList">
                        @foreach($donutSegments as $i => $seg)
                            <a href="{{ route('admin.applications.index', ['status' => $seg['key']]) }}"
                               class="legend-item" data-index="{{ $i }}" style="text-decoration:none;">
                                <span class="legend-item-left">
                                    <span class="legend-dot" style="background:{{ $seg['color'] }};"></span>
                                    {{ $seg['label'] }}
                                </span>
                                <span class="legend-item-right">
                                    <span class="legend-item-value">{{ $seg['total'] }}</span>
                                    <span class="legend-item-pct">{{ $seg['pct'] }}%</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Applications Table -->
<div class="panel-card mb-4 fade-in" style="animation-delay: 440ms;">
    <div class="panel-card-header">
        <h2>📨 CV Masuk Terbaru</h2>
        <a href="{{ route('admin.applications.index') }}" class="btn-soft-outline">Lihat semua &rarr;</a>
    </div>
    <div class="table-responsive">
        <table class="table dash-table mb-0">
            <thead>
                <tr>
                    <th>Pelamar</th>
                    <th>Posisi</th>
                    <th>Masuk</th>
                    <th>Status</th>
                    <th class="text-end">CV</th>
                </tr>
            </thead>
            <tbody>
            @forelse($recentApplications as $a)
                @php $c = $statusColors[$a->status] ?? '#94a3b8'; @endphp
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-circle">{{ strtoupper(substr($a->name, 0, 1)) }}</div>
                            <div>
                                <div class="fw-semibold" style="color:#0b131e;">{{ $a->name }}</div>
                                <div class="small text-muted">{{ $a->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="small">{{ $a->vacancy->title }}</td>
                    <td class="small text-muted">{{ $a->created_at->diffForHumans() }}</td>
                    <td>
                        <span class="pill-badge" style="background:{{ $c }}1a; color:{{ $c }};">
                            <span class="status-dot {{ $a->status === 'baru' ? 'pulse' : '' }}" style="background:{{ $c }};"></span>
                            {{ \App\Models\JobApplication::STATUSES[$a->status] ?? $a->status }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.applications.cv', $a) }}" class="btn-soft">⬇ Unduh</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div>Belum ada CV yang masuk.</div>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Vacancies Table -->
<div class="panel-card fade-in" style="animation-delay: 500ms;">
    <div class="panel-card-header">
        <h2>💼 Lowongan</h2>
        <a href="{{ route('admin.vacancies.index') }}" class="btn-soft-outline">Kelola semua &rarr;</a>
    </div>
    <div class="table-responsive">
        <table class="table dash-table mb-0">
            <thead>
                <tr>
                    <th>Posisi</th>
                    <th>Batas</th>
                    <th>Status</th>
                    <th>Pelamar</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($vacancies as $v)
                <tr>
                    <td>
                        <a href="{{ route('admin.applications.index', ['vacancy' => $v->id]) }}" class="fw-semibold text-decoration-none" style="color:#0b131e;">
                            {{ $v->title }}
                        </a>
                        <div class="small text-muted">{{ $v->employment_type }} &middot; {{ $v->location }}</div>
                    </td>
                    <td class="small">{{ $v->deadline?->format('d M Y') ?? '-' }}</td>
                    <td>
                        @if($v->isOpen())
                            <span class="pill-badge" style="background:#10b9811a;color:#10b981;"><span class="status-dot" style="background:#10b981;"></span>Dibuka</span>
                        @elseif(!$v->is_active)
                            <span class="pill-badge" style="background:#94a3b81a;color:#64748b;"><span class="status-dot" style="background:#94a3b8;"></span>Disembunyikan</span>
                        @else
                            <span class="pill-badge" style="background:#ef44441a;color:#ef4444;"><span class="status-dot" style="background:#ef4444;"></span>Kedaluwarsa</span>
                        @endif
                    </td>
                    <td>
                        {{ $v->applications_count }}
                        @if($v->new_applications_count > 0)
                            <span class="pill-badge" style="background:#f59e0b1a;color:#f59e0b;margin-left:4px;">+{{ $v->new_applications_count }} baru</span>
                        @endif
                    </td>
                    <td class="text-end text-nowrap">
                        <form action="{{ route('admin.vacancies.toggle', $v) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn-soft-outline" style="border:1px solid #e2e8f0;">{{ $v->is_active ? 'Sembunyikan' : 'Tampilkan' }}</button>
                        </form>
                        <a href="{{ route('admin.vacancies.edit', $v) }}" class="btn-soft">✎ Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <div>Belum ada lowongan. <a href="{{ route('admin.vacancies.create') }}" style="color:#f1c40f;font-weight:600;">Buat yang pertama</a>.</div>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Stat Counter Animation
    document.querySelectorAll('.stat-value').forEach(function (el) {
        const target = parseInt(el.getAttribute('data-count'), 10) || 0;
        const start = performance.now();
        function tick(now) {
            const progress = Math.min((now - start) / 900, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(eased * target);
            if (progress < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    });

    // Chart Animation Trigger
    setTimeout(function () {
        document.getElementById('chartLine')?.classList.add('shown');
        document.getElementById('chartArea')?.classList.add('shown');
    }, 150);

    // Donut Legend Interaction
    const legendItems = document.querySelectorAll('.legend-item');
    const donutSegs = document.querySelectorAll('.donut-seg');
    legendItems.forEach(function (item) {
        const idx = item.getAttribute('data-index');
        item.addEventListener('mouseenter', function () {
            legendItems.forEach(li => li.classList.remove('active-legend'));
            item.classList.add('active-legend');
            donutSegs.forEach(seg => seg.classList.toggle('dim', seg.getAttribute('data-index') !== idx));
        });
        item.addEventListener('mouseleave', function () {
            item.classList.remove('active-legend');
            donutSegs.forEach(seg => seg.classList.remove('dim'));
        });
    });
});
</script>
@endsection