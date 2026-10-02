@extends('layouts.app')

@section('title', $vacancy->title . ' - Karir PT Bachri Samudera Indonesia')

@php
    $daysLeft = $vacancy->deadline
        ? (int) now()->startOfDay()->diffInDays($vacancy->deadline->startOfDay(), false)
        : null;

    $urgency = 'normal';
    if ($daysLeft !== null) {
        if ($daysLeft < 0)       $urgency = 'expired';
        elseif ($daysLeft <= 3)  $urgency = 'critical';
        elseif ($daysLeft <= 7)  $urgency = 'warning';
    }
@endphp

@section('content')
<style>
    :root {
        --brand: #f1c40f;
        --brand-2: #e67e22;
        --brand-soft: rgba(241,196,15,.12);
        --ink: #0b131e;
        --surface: rgba(255,255,255,.035);
        --surface-2: rgba(255,255,255,.055);
        --stroke: rgba(255,255,255,.08);
        --stroke-2: rgba(255,255,255,.15);
        --muted: rgba(255,255,255,.58);
        --muted-2: rgba(255,255,255,.82);
        --ok: #10b981;
        --warn: #f59e0b;
        --danger: #ef4444;
        --radius-lg: 22px;
        --radius-md: 16px;
        --radius-sm: 12px;
    }

    /* ============ READING PROGRESS ============ */
    .read-progress {
        position: fixed; top: 0; left: 0; right: 0;
        height: 3px; z-index: 1000;
        background: transparent; pointer-events: none;
    }
    .read-progress__bar {
        height: 100%; width: 0;
        background: linear-gradient(90deg, var(--brand), var(--brand-2));
        box-shadow: 0 0 12px rgba(241,196,15,.6);
        transition: width .12s linear;
    }

    /* ============ LAYOUT ============ */
    .detail-wrap {
        max-width: 1100px; margin: 0 auto;
        padding: 1.75rem 1rem 6rem;
    }

    /* ============ BREADCRUMB ============ */
    .crumb {
        display: flex; align-items: center; flex-wrap: wrap;
        gap: .5rem; font-size: .82rem;
        color: var(--muted); margin-bottom: 1.25rem;
    }
    .crumb a {
        color: var(--muted); text-decoration: none;
        transition: color .2s; display: inline-flex; align-items: center; gap: .35rem;
    }
    .crumb a:hover { color: var(--brand); }
    .crumb .sep { opacity: .4; }
    .crumb .current {
        color: #fff; font-weight: 600;
        max-width: 260px; overflow: hidden;
        text-overflow: ellipsis; white-space: nowrap;
    }

    /* ============ HERO ============ */
    .hero {
        position: relative;
        background:
            radial-gradient(1000px 240px at -5% -30%, rgba(241,196,15,.13), transparent 60%),
            radial-gradient(700px 200px at 105% 130%, rgba(230,126,34,.10), transparent 60%),
            linear-gradient(135deg, rgba(241,196,15,.05), rgba(255,255,255,.015));
        border: 1px solid var(--stroke);
        border-radius: var(--radius-lg);
        padding: 2.25rem 2rem 2rem;
        margin-bottom: 1.5rem;
        overflow: hidden;
        animation: fadeUp .55s cubic-bezier(.2,.8,.3,1) both;
    }
    .hero__media {
        width: 100%; max-height: 300px; object-fit: cover;
        border-radius: var(--radius-lg);
        border: 1px solid var(--stroke);
        margin-bottom: 1.5rem;
        display: block;
    }

    .hero__top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 1rem; margin-bottom: 1rem;
    }
    .status-chip {
        display: inline-flex; align-items: center; gap: .5rem;
        font-size: .72rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .14em;
        padding: .4rem .85rem; border-radius: 50px;
        border: 1px solid rgba(16,185,129,.32);
        background: rgba(16,185,129,.08);
        color: #6ee7b7;
    }
    .status-chip.closed {
        border-color: rgba(239,68,68,.32);
        background: rgba(239,68,68,.08);
        color: #fca5a5;
    }
    .status-chip .dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: currentColor;
        box-shadow: 0 0 0 4px rgba(16,185,129,.18);
        animation: pulse 2s infinite;
    }
    .status-chip.closed .dot { animation: none; }

    .share-group { display: flex; gap: .4rem; flex-shrink: 0; }
    .icon-btn {
        width: 36px; height: 36px;
        display: grid; place-items: center;
        border-radius: 10px;
        background: rgba(255,255,255,.04);
        border: 1px solid var(--stroke);
        color: var(--muted-2);
        cursor: pointer;
        transition: all .22s ease;
        text-decoration: none;
        position: relative;
    }
    .icon-btn:hover {
        background: var(--brand-soft);
        border-color: rgba(241,196,15,.35);
        color: var(--brand);
        transform: translateY(-2px);
    }
    .icon-btn[data-tooltip]::after {
        content: attr(data-tooltip);
        position: absolute; bottom: -32px; left: 50%;
        transform: translateX(-50%) translateY(4px);
        background: rgba(11,19,30,.95);
        border: 1px solid var(--stroke-2);
        color: #fff; font-size: .7rem; font-weight: 600;
        padding: .3rem .55rem; border-radius: 6px;
        white-space: nowrap;
        opacity: 0; pointer-events: none;
        transition: opacity .2s, transform .2s;
        z-index: 5;
    }
    .icon-btn[data-tooltip]:hover::after {
        opacity: 1; transform: translateX(-50%) translateY(0);
    }
    .icon-btn.copied {
        background: rgba(16,185,129,.15);
        border-color: rgba(16,185,129,.5);
        color: #6ee7b7;
    }

    .hero__title {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: clamp(1.65rem, 4.5vw, 2.35rem);
        line-height: 1.15; letter-spacing: -.015em;
        margin-bottom: .5rem;
    }
    .hero__dept {
        color: var(--muted); font-size: .92rem;
        display: inline-flex; align-items: center; gap: .45rem;
        margin-bottom: 1.35rem;
    }

    /* ============ META GRID ============ */
    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(155px, 1fr));
        gap: .6rem;
    }
    .meta-item {
        display: flex; align-items: center; gap: .7rem;
        padding: .7rem .85rem;
        background: rgba(255,255,255,.03);
        border: 1px solid var(--stroke);
        border-radius: var(--radius-sm);
        transition: all .25s ease;
        animation: fadeUp .5s cubic-bezier(.2,.8,.3,1) both;
    }
    .meta-item:nth-child(1) { animation-delay: .05s; }
    .meta-item:nth-child(2) { animation-delay: .10s; }
    .meta-item:nth-child(3) { animation-delay: .15s; }
    .meta-item:nth-child(4) { animation-delay: .20s; }
    .meta-item:hover {
        background: rgba(241,196,15,.05);
        border-color: rgba(241,196,15,.25);
        transform: translateY(-2px);
    }
    .meta-icon {
        width: 34px; height: 34px; flex-shrink: 0;
        display: grid; place-items: center;
        background: var(--brand-soft);
        color: var(--brand);
        border-radius: 10px;
    }
    .meta-body { min-width: 0; flex: 1; }
    .meta-label {
        display: block; font-size: .68rem; font-weight: 600;
        text-transform: uppercase; letter-spacing: .1em;
        color: var(--muted); margin-bottom: .1rem;
    }
    .meta-value {
        display: block; font-size: .88rem; font-weight: 600;
        color: #fff; white-space: nowrap;
        overflow: hidden; text-overflow: ellipsis;
    }

    /* Deadline urgency colors */
    .meta-item.urgency-warning .meta-icon  { background: rgba(245,158,11,.15);  color: var(--warn); }
    .meta-item.urgency-critical .meta-icon { background: rgba(239,68,68,.15);   color: var(--danger); }
    .meta-item.urgency-critical { border-color: rgba(239,68,68,.3); animation: fadeUp .5s both, glowRed 2s infinite; }
    .meta-item.urgency-expired .meta-icon  { background: rgba(120,113,108,.15); color: #a8a29e; }

    .urgency-hint {
        display: block; font-size: .68rem; margin-top: .1rem;
        font-weight: 600;
    }
    .urgency-warning .urgency-hint  { color: var(--warn); }
    .urgency-critical .urgency-hint { color: var(--danger); }
    .urgency-expired .urgency-hint  { color: #a8a29e; }

    /* ============ ALERT ============ */
    .alert {
        display: flex; gap: .75rem; align-items: flex-start;
        padding: 1rem 1.15rem; border-radius: var(--radius-sm);
        margin-bottom: 1.25rem; font-size: .9rem; font-weight: 500;
        animation: fadeUp .4s ease both;
    }
    .alert .ico { font-size: 1rem; line-height: 1.35; flex-shrink: 0; }
    .alert-ok {
        background: linear-gradient(135deg, rgba(16,185,129,.18), rgba(5,150,105,.08));
        border: 1px solid rgba(16,185,129,.38); color: #a7f3d0;
    }
    .alert-err {
        background: linear-gradient(135deg, rgba(239,68,68,.18), rgba(220,38,38,.08));
        border: 1px solid rgba(239,68,68,.38); color: #fecaca;
    }
    .alert ul { margin: 0; padding-left: 1.05rem; }

    /* ============ PANEL ============ */
    .panel {
        background: var(--surface);
        border: 1px solid var(--stroke);
        border-radius: 20px;
        padding: 1.75rem;
        margin-bottom: 1.25rem;
        animation: fadeUp .6s cubic-bezier(.2,.8,.3,1) both;
        transition: border-color .3s ease;
    }
    .panel:hover { border-color: rgba(255,255,255,.13); }
    .panel-head {
        display: flex; align-items: center; gap: .7rem;
        margin-bottom: 1.15rem; padding-bottom: 1rem;
        border-bottom: 1px dashed rgba(255,255,255,.08);
    }
    .panel-head .ico {
        width: 34px; height: 34px; flex-shrink: 0;
        display: grid; place-items: center;
        border-radius: 10px;
        background: var(--brand-soft); color: var(--brand);
        font-size: 1rem;
    }
    .panel h2 {
        font-size: 1.02rem; font-weight: 700;
        color: #fff; margin: 0; letter-spacing: -.005em;
    }
    .panel p, .panel li {
        color: var(--muted-2); line-height: 1.8; font-size: .94rem;
    }
    .panel ul { padding-left: 0; margin: 0; list-style: none; }
    .panel ul li {
        position: relative;
        padding: .55rem .55rem .55rem 2rem;
        margin-bottom: .15rem; border-radius: 8px;
        transition: background .2s ease;
    }
    .panel ul li:hover { background: rgba(241,196,15,.04); }
    .panel ul li::before {
        content: '';
        position: absolute; left: .5rem; top: 1.02rem;
        width: 14px; height: 14px;
        background:
            url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23f1c40f' stroke-width='3.4' stroke-linecap='round' stroke-linejoin='round'><polyline points='20 6 9 17 4 12'/></svg>")
            center/contain no-repeat;
    }
    .empty-hint {
        text-align: center; padding: 1.5rem 1rem;
        color: var(--muted); font-size: .88rem;
        border: 1px dashed var(--stroke-2); border-radius: 12px;
    }

    /* ============ APPLY PANEL ============ */
    .apply-panel {
        position: sticky; top: 1.5rem;
        background:
            radial-gradient(400px 200px at 100% 0%, rgba(241,196,15,.06), transparent 60%),
            var(--surface);
    }

    /* Progress bar */
    .form-progress {
        margin-bottom: 1.15rem;
    }
    .form-progress__meta {
        display: flex; justify-content: space-between;
        font-size: .72rem; color: var(--muted);
        margin-bottom: .4rem; font-weight: 600;
    }
    .form-progress__meta strong { color: var(--brand); }
    .form-progress__track {
        height: 5px; background: rgba(255,255,255,.06);
        border-radius: 50px; overflow: hidden;
    }
    .form-progress__bar {
        height: 100%; width: 0%;
        background: linear-gradient(90deg, var(--brand), var(--brand-2));
        border-radius: 50px;
        transition: width .35s cubic-bezier(.2,.8,.3,1);
        box-shadow: 0 0 10px rgba(241,196,15,.4);
    }

    /* Form field */
    .form-label {
        display: flex; align-items: center; justify-content: space-between;
        font-weight: 600; font-size: .82rem;
        color: var(--muted-2); margin-bottom: .45rem;
    }
    .form-label .opt {
        font-weight: 400; font-size: .72rem;
        color: var(--muted); font-style: italic;
    }
    .field { position: relative; }
    .field .field-icon {
        position: absolute; left: .95rem; top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,.35);
        pointer-events: none; font-size: .95rem;
        transition: color .2s ease;
        display: flex;
    }
    .field:focus-within .field-icon { color: var(--brand); }

    .apply-input {
        width: 100%;
        background: rgba(255,255,255,.05) !important;
        border: 1px solid var(--stroke-2) !important;
        color: #fff !important;
        border-radius: var(--radius-sm) !important;
        padding: .72rem .95rem !important;
        font-size: .92rem !important;
        transition: all .2s ease !important;
    }
    .field.has-icon .apply-input { padding-left: 2.6rem !important; padding-right: 2.4rem !important; }
    .field.has-textarea .apply-input { padding-right: 3.4rem !important; }
    .apply-input:focus {
        background: rgba(255,255,255,.07) !important;
        border-color: var(--brand) !important;
        box-shadow: 0 0 0 4px rgba(241,196,15,.13) !important;
        outline: none !important;
    }
    .apply-input::placeholder { color: rgba(255,255,255,.32); }
    textarea.apply-input { resize: vertical; min-height: 84px; }

    /* Inline validation */
    .field.valid .apply-input {
        border-color: rgba(16,185,129,.55) !important;
        background: rgba(16,185,129,.04) !important;
    }
    .field.invalid .apply-input {
        border-color: rgba(239,68,68,.6) !important;
        background: rgba(239,68,68,.04) !important;
    }
    .field-status {
        position: absolute; right: .8rem; top: 50%;
        transform: translateY(-50%);
        width: 18px; height: 18px;
        opacity: 0; pointer-events: none;
        transition: opacity .25s ease, transform .25s ease;
        display: grid; place-items: center;
    }
    .field.valid .field-status,
    .field.invalid .field-status {
        opacity: 1;
        animation: popIn .3s cubic-bezier(.2,.8,.3,1) both;
    }
    .field.valid .field-status svg { color: var(--ok); }
    .field.invalid .field-status svg { color: var(--danger); }

    .char-count {
        position: absolute; right: .8rem; bottom: .55rem;
        font-size: .68rem; color: var(--muted);
        background: rgba(11,19,30,.85);
        padding: .1rem .45rem; border-radius: 6px;
        pointer-events: none;
        transition: color .2s ease;
        font-variant-numeric: tabular-nums;
    }
    .char-count.warn { color: var(--warn); }
    .char-count.over { color: var(--danger); }

    /* ============ FILE DROP ============ */
    .file-drop {
        display: block; position: relative;
        border: 1.5px dashed rgba(255,255,255,.22);
        border-radius: 14px; padding: 1.25rem 1rem;
        text-align: center; cursor: pointer;
        background: rgba(255,255,255,.02);
        transition: all .25s cubic-bezier(.2,.8,.3,1);
    }
    .file-drop:hover {
        border-color: var(--brand);
        background: rgba(241,196,15,.05);
        transform: translateY(-1px);
    }
    .file-drop.dragover {
        border-color: var(--brand);
        background: rgba(241,196,15,.1);
        transform: scale(1.015);
    }
    .file-drop.has-file {
        border-color: rgba(16,185,129,.55);
        border-style: solid;
        background: rgba(16,185,129,.05);
    }
    .file-drop input[type="file"] {
        position: absolute; inset: 0; opacity: 0;
        cursor: pointer; width: 100%; height: 100%;
        z-index: 2;
    }
    .file-drop.has-file input[type="file"] { pointer-events: none; }

    .file-drop__icon {
        width: 42px; height: 42px;
        margin: 0 auto .55rem;
        display: grid; place-items: center;
        border-radius: 12px;
        background: var(--brand-soft); color: var(--brand);
        transition: all .3s ease;
    }
    .file-drop.has-file .file-drop__icon {
        background: rgba(16,185,129,.15); color: var(--ok);
        transform: scale(1.05);
    }
    .file-drop__text { font-size: .85rem; color: var(--muted); line-height: 1.5; }
    .file-drop__text strong { color: var(--brand); font-weight: 600; }
    .file-drop.has-file .file-drop__text { color: #a7f3d0; }
    .file-drop.has-file .file-drop__text strong { color: #6ee7b7; word-break: break-all; }
    .file-hint { font-size: .72rem; color: var(--muted); margin-top: .5rem; display: block; }

    .file-remove {
        position: absolute; top: .55rem; right: .55rem;
        width: 24px; height: 24px;
        display: none; place-items: center;
        background: rgba(239,68,68,.15);
        border: 1px solid rgba(239,68,68,.4);
        color: #fca5a5;
        border-radius: 8px; cursor: pointer;
        z-index: 3;
        transition: all .2s ease;
    }
    .file-drop.has-file .file-remove { display: grid; }
    .file-remove:hover {
        background: rgba(239,68,68,.3);
        transform: scale(1.1);
    }

    /* ============ BUTTON ============ */
    .btn-apply {
        position: relative;
        background: linear-gradient(135deg, var(--brand), var(--brand-2));
        color: var(--ink);
        border: 0; border-radius: 50px;
        padding: .95rem 2rem;
        font-weight: 800; width: 100%;
        font-size: .95rem; letter-spacing: .01em;
        display: inline-flex; align-items: center; justify-content: center;
        gap: .55rem;
        overflow: hidden;
        transition: all .3s cubic-bezier(.2,.8,.3,1);
        box-shadow: 0 8px 20px -8px rgba(241,196,15,.5);
    }
    .btn-apply::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,.35), transparent 60%);
        opacity: 0; transition: opacity .3s ease;
    }
    .btn-apply:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 16px 32px -10px rgba(241,196,15,.55);
    }
    .btn-apply:hover:not(:disabled)::before { opacity: 1; }
    .btn-apply:active:not(:disabled) { transform: translateY(0); }
    .btn-apply:disabled { opacity: .65; cursor: not-allowed; }
    .btn-apply .spinner {
        width: 15px; height: 15px;
        border: 2px solid rgba(11,19,30,.3);
        border-top-color: var(--ink);
        border-radius: 50%;
        animation: spin .8s linear infinite;
        display: none;
    }
    .btn-apply.loading .spinner { display: inline-block; }
    .btn-apply.loading .arrow { display: none; }

    /* ============ CLOSED ============ */
    .closed-note {
        display: flex; flex-direction: column; align-items: center;
        gap: .65rem; text-align: center;
        padding: 1.75rem 1.25rem;
        background: rgba(239,68,68,.06);
        border: 1px solid rgba(239,68,68,.28);
        border-radius: 14px;
        color: #fca5a5; font-size: .9rem;
    }
    .closed-note .ico { font-size: 1.9rem; opacity: .85; }

    /* ============ MOBILE STICKY CTA ============ */
    .mobile-cta {
        position: fixed;
        left: 0; right: 0; bottom: 0;
        padding: .75rem .9rem calc(.75rem + env(safe-area-inset-bottom));
        background: rgba(11,19,30,.92);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-top: 1px solid var(--stroke);
        display: none;
        z-index: 900;
        transform: translateY(100%);
        transition: transform .35s cubic-bezier(.2,.8,.3,1);
    }
    .mobile-cta.show { transform: translateY(0); }
    .mobile-cta .cta-btn {
        width: 100%;
        background: linear-gradient(135deg, var(--brand), var(--brand-2));
        color: var(--ink);
        border: 0; border-radius: 50px;
        padding: .85rem 1.5rem;
        font-weight: 800; font-size: .92rem;
        display: inline-flex; align-items: center; justify-content: center;
        gap: .5rem;
    }

    /* ============ ANIMATIONS ============ */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 4px rgba(16,185,129,.18); }
        50%      { box-shadow: 0 0 0 8px rgba(16,185,129,.06); }
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes popIn {
        from { transform: translateY(-50%) scale(.5); opacity: 0; }
        to   { transform: translateY(-50%) scale(1); opacity: 1; }
    }
    @keyframes glowRed {
        0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0); }
        50%      { box-shadow: 0 0 0 4px rgba(239,68,68,.12); }
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 991.98px) {
        .apply-panel { position: static; }
        .mobile-cta { display: block; }
        .detail-wrap { padding-bottom: 5.5rem; }
    }
    @media (max-width: 575.98px) {
        .detail-wrap { padding: 1.25rem .85rem 6rem; }
        .hero { padding: 1.5rem 1.25rem; border-radius: 18px; }
        .hero__title { font-size: 1.55rem; }
        .hero__top { flex-direction: column; gap: .75rem; }
        .share-group { align-self: flex-start; }
        .panel { padding: 1.35rem 1.15rem; border-radius: var(--radius-md); }
        .meta-grid { grid-template-columns: 1fr 1fr; gap: .5rem; }
        .meta-item { padding: .6rem .7rem; }
        .meta-icon { width: 30px; height: 30px; }
        .icon-btn[data-tooltip]::after { display: none; }
    }

    /* ============ REDUCED MOTION ============ */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: .01ms !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="read-progress"><div class="read-progress__bar" id="readBar"></div></div>

<section class="detail-wrap">
    {{-- ============ BREADCRUMB ============ --}}
    <nav class="crumb" aria-label="Breadcrumb">
        <a href="{{ route('careers.index') }}">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Karir
        </a>
        <span class="sep">/</span>
        <a href="{{ route('careers.index') }}">Semua Lowongan</a>
        <span class="sep">/</span>
        <span class="current">{{ $vacancy->title }}</span>
    </nav>

    @if($vacancy->imageUrl())
        <img src="{{ $vacancy->imageUrl() }}" alt="{{ $vacancy->title }}" class="hero__media">
    @endif

    {{-- ============ HERO ============ --}}
    <div class="hero">
        <div class="hero__top">
            <span class="status-chip {{ $vacancy->isOpen() ? '' : 'closed' }}">
                <span class="dot"></span>
                {{ $vacancy->isOpen() ? 'Sedang Dibuka' : 'Ditutup' }}
            </span>

            <div class="share-group">
                <button type="button" class="icon-btn" id="copyLink"
                        data-tooltip="Salin tautan" aria-label="Salin tautan">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                </button>
                <a href="https://wa.me/?text={{ urlencode($vacancy->title . ' - ' . url()->current()) }}"
                   target="_blank" rel="noopener" class="icon-btn"
                   data-tooltip="Bagikan via WhatsApp" aria-label="Bagikan via WhatsApp">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                </a>
                <button type="button" class="icon-btn" id="printBtn"
                        data-tooltip="Cetak" aria-label="Cetak">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                </button>
            </div>
        </div>

        <h1 class="hero__title">{{ $vacancy->title }}</h1>

        @if($vacancy->department)
            <div class="hero__dept">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/></svg>
                {{ $vacancy->department }}
            </div>
        @endif

        <div class="meta-grid">
            <div class="meta-item">
                <div class="meta-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
                <div class="meta-body">
                    <span class="meta-label">Tipe</span>
                    <span class="meta-value">{{ $vacancy->employment_type }}</span>
                </div>
            </div>

            <div class="meta-item">
                <div class="meta-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div class="meta-body">
                    <span class="meta-label">Lokasi</span>
                    <span class="meta-value">{{ $vacancy->location }}</span>
                </div>
            </div>

            @if($vacancy->salary_range)
                <div class="meta-item">
                    <div class="meta-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <div class="meta-body">
                        <span class="meta-label">Gaji</span>
                        <span class="meta-value">{{ $vacancy->salary_range }}</span>
                    </div>
                </div>
            @endif

            @if($vacancy->deadline)
                <div class="meta-item urgency-{{ $urgency }}">
                    <div class="meta-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="meta-body">
                        <span class="meta-label">Batas Lamaran</span>
                        <span class="meta-value">{{ $vacancy->deadline->translatedFormat('d M Y') }}</span>
                        @if($daysLeft !== null)
                            <span class="urgency-hint">
                                @if($daysLeft < 0)
                                    Sudah berakhir
                                @elseif($daysLeft === 0)
                                    Hari terakhir!
                                @elseif($daysLeft === 1)
                                    Tersisa 1 hari
                                @else
                                    Tersisa {{ $daysLeft }} hari
                                @endif
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- ============ FLASH ============ --}}
    @if(session('success'))
        <div class="alert alert-ok">
            <span class="ico">✓</span><span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-err">
            <span class="ico">✕</span><span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="row g-4">
        {{-- ============ LEFT ============ --}}
        <div class="col-lg-7">
            <div class="panel">
                <div class="panel-head">
                    <span class="ico">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </span>
                    <h2>Deskripsi Pekerjaan</h2>
                </div>
                @if(trim($vacancy->description))
                    <p class="mb-0">{!! nl2br(e($vacancy->description)) !!}</p>
                @else
                    <div class="empty-hint">Deskripsi belum tersedia untuk lowongan ini.</div>
                @endif
            </div>

            <div class="panel mb-0">
                <div class="panel-head">
                    <span class="ico">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </span>
                    <h2>Persyaratan</h2>
                </div>
                @if(count($vacancy->requirementList()))
                    <ul>
                        @foreach($vacancy->requirementList() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @else
                    <div class="empty-hint">Tidak ada persyaratan khusus yang tercantum.</div>
                @endif
            </div>
        </div>

        {{-- ============ RIGHT : APPLY ============ --}}
        <div class="col-lg-5">
            <div class="panel apply-panel" id="lamar">
                <div class="panel-head">
                    <span class="ico">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </span>
                    <h2>Lamar Posisi Ini</h2>
                </div>

                @if(! $vacancy->isOpen())
                    <div class="closed-note">
                        <span class="ico">🔒</span>
                        <div>
                            <strong>Lowongan Telah Ditutup</strong><br>
                            <span style="font-size:.82rem;opacity:.85;">Silakan jelajahi lowongan lain yang masih tersedia.</span>
                        </div>
                    </div>
                @else
                    @if($errors->any())
                        <div class="alert alert-err">
                            <span class="ico">✕</span>
                            <ul>
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Progress --}}
                    <div class="form-progress" id="formProgress">
                        <div class="form-progress__meta">
                            <span>Kelengkapan berkas</span>
                            <span><strong id="progressCount">0</strong>/4</span>
                        </div>
                        <div class="form-progress__track">
                            <div class="form-progress__bar" id="progressBar"></div>
                        </div>
                    </div>

                    <form action="{{ route('careers.apply', $vacancy) }}#lamar" method="POST"
                          enctype="multipart/form-data" id="applyForm" novalidate autocomplete="on">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <div class="field has-icon" data-field="name">
                                <span class="field-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                <input type="text" id="name" name="name" class="form-control apply-input"
                                       value="{{ old('name') }}" maxlength="100"
                                       placeholder="Nama sesuai KTP" required autocomplete="name">
                                <span class="field-status"></span>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <div class="field has-icon" data-field="email">
                                <span class="field-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <input type="email" id="email" name="email" class="form-control apply-input"
                                       value="{{ old('email') }}" maxlength="100"
                                       placeholder="nama@email.com" required autocomplete="email">
                                <span class="field-status"></span>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label" for="phone">No. Telepon / WhatsApp</label>
                            <div class="field has-icon" data-field="phone">
                                <span class="field-icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <input type="tel" id="phone" name="phone" class="form-control apply-input"
                                       value="{{ old('phone') }}" maxlength="20"
                                       placeholder="08xxxxxxxxxx" required autocomplete="tel"
                                       inputmode="tel" pattern="[0-9+\-\s()]{8,20}">
                                <span class="field-status"></span>
                            </div>
                        </div>

                        {{-- Cover letter --}}
                        <div class="mb-3">
                            <label class="form-label" for="cover_letter">
                                Surat Lamaran <span class="opt">opsional</span>
                            </label>
                            <div class="field has-textarea">
                                <textarea id="cover_letter" name="cover_letter" rows="3" maxlength="2000"
                                          class="form-control apply-input"
                                          placeholder="Ceritakan singkat mengapa Anda cocok untuk posisi ini...">{{ old('cover_letter') }}</textarea>
                                <span class="char-count" id="charCount">0 / 2000</span>
                            </div>
                        </div>

                        {{-- CV --}}
                        <div class="mb-4">
                            <label class="form-label">Unggah CV</label>
                            <label class="file-drop" id="fileDropLabel">
                                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                <button type="button" class="file-remove" id="fileRemove" aria-label="Hapus file">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                                <div class="file-drop__icon" id="fileIcon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                </div>
                                <div class="file-drop__text" id="fileName">
                                    <strong>Klik untuk memilih</strong> atau seret file ke sini
                                </div>
                            </label>
                            <small class="file-hint">Format PDF, DOC, DOCX · Maksimal 2 MB</small>
                        </div>

                        <button type="submit" class="btn-apply" id="submitBtn">
                            <span class="spinner"></span>
                            <span class="btn-label">Kirim Lamaran</span>
                            <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ============ MOBILE STICKY CTA ============ --}}
@if($vacancy->isOpen())
<div class="mobile-cta" id="mobileCta">
    <button type="button" class="cta-btn" id="scrollToForm">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        Lamar Sekarang
    </button>
</div>
@endif

@include('partials.footer')

<script>
(function () {
    'use strict';

    /* ================= READING PROGRESS ================= */
    const bar = document.getElementById('readBar');
    if (bar) {
        const update = () => {
            const h = document.documentElement;
            const scrolled = h.scrollTop / (h.scrollHeight - h.clientHeight || 1);
            bar.style.width = Math.min(100, Math.max(0, scrolled * 100)) + '%';
        };
        document.addEventListener('scroll', update, { passive: true });
        update();
    }

    /* ================= COPY LINK ================= */
    const copyBtn = document.getElementById('copyLink');
    if (copyBtn) {
        copyBtn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(window.location.href);
                copyBtn.classList.add('copied');
                copyBtn.dataset.tooltip = 'Tersalin!';
                setTimeout(() => {
                    copyBtn.classList.remove('copied');
                    copyBtn.dataset.tooltip = 'Salin tautan';
                }, 1600);
            } catch (e) {}
        });
    }

    /* ================= PRINT ================= */
    const printBtn = document.getElementById('printBtn');
    if (printBtn) printBtn.addEventListener('click', () => window.print());

    /* ================= CHARACTER COUNTER ================= */
    const ta = document.getElementById('cover_letter');
    const cc = document.getElementById('charCount');
    if (ta && cc) {
        const upd = () => {
            const len = ta.value.length;
            cc.textContent = len + ' / 2000';
            cc.classList.toggle('warn', len > 1500 && len <= 1900);
            cc.classList.toggle('over', len > 1900);
        };
        ta.addEventListener('input', upd);
        upd();
    }

    /* ================= FORM VALIDATION ================= */
    const ICON_OK = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
    const ICON_ERR = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>';

    const validators = {
        name: v => v.trim().length >= 2,
        email: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()),
        phone: v => /^[0-9+\-\s()]{8,20}$/.test(v.trim())
    };

    function setFieldState(fieldWrap, valid, touched) {
        if (!fieldWrap) return;
        const status = fieldWrap.querySelector('.field-status');
        fieldWrap.classList.remove('valid', 'invalid');
        if (!touched) { if (status) status.innerHTML = ''; return; }
        if (valid) {
            fieldWrap.classList.add('valid');
            if (status) status.innerHTML = ICON_OK;
        } else {
            fieldWrap.classList.add('invalid');
            if (status) status.innerHTML = ICON_ERR;
        }
    }

    function updateProgress() {
        const bar = document.getElementById('progressBar');
        const cnt = document.getElementById('progressCount');
        if (!bar || !cnt) return;

        let filled = 0;
        ['name', 'email', 'phone'].forEach(id => {
            const el = document.getElementById(id);
            if (el && validators[id] && validators[id](el.value)) filled++;
        });
        const cv = document.getElementById('cv');
        if (cv && cv.files && cv.files.length) filled++;

        cnt.textContent = filled;
        bar.style.width = (filled / 4 * 100) + '%';
    }

    ['name', 'email', 'phone'].forEach(id => {
        const el = document.getElementById(id);
        const wrap = el && el.closest('.field');
        if (!el || !wrap) return;

        el.addEventListener('blur', () => {
            if (!el.value.trim()) { setFieldState(wrap, false, false); return; }
            setFieldState(wrap, validators[id](el.value), true);
            updateProgress();
        });
        el.addEventListener('input', () => {
            if (wrap.classList.contains('invalid') || wrap.classList.contains('valid')) {
                setFieldState(wrap, validators[id](el.value), true);
            }
            updateProgress();
        });
    });

    /* ================= FILE DROP ================= */
    const drop = document.getElementById('fileDropLabel');
    const input = document.getElementById('cv');
    const nameEl = document.getElementById('fileName');
    const removeBtn = document.getElementById('fileRemove');

    if (drop && input && nameEl) {
        const resetFile = () => {
            input.value = '';
            drop.classList.remove('has-file');
            nameEl.innerHTML = '<strong>Klik untuk memilih</strong> atau seret file ke sini';
            updateProgress();
        };

        const setFile = (file) => {
            if (!file) return resetFile();
            const okExt = /\.(pdf|doc|docx)$/i.test(file.name);
            const okSize = file.size <= 2 * 1024 * 1024;

            if (!okExt) {
                nameEl.innerHTML = '<span style="color:#fca5a5">Format tidak didukung.</span> Gunakan PDF/DOC/DOCX.';
                drop.classList.remove('has-file');
                input.value = '';
                updateProgress();
                return;
            }
            if (!okSize) {
                nameEl.innerHTML = '<span style="color:#fca5a5">Ukuran terlalu besar.</span> Maksimal 2 MB.';
                drop.classList.remove('has-file');
                input.value = '';
                updateProgress();
                return;
            }
            const kb = (file.size / 1024).toFixed(0);
            nameEl.innerHTML = '<strong>' + file.name + '</strong> · ' + kb + ' KB';
            drop.classList.add('has-file');
            updateProgress();
        };

        input.addEventListener('change', () => setFile(input.files[0]));
        if (removeBtn) removeBtn.addEventListener('click', (e) => { e.preventDefault(); resetFile(); });

        ['dragenter', 'dragover'].forEach(ev =>
            drop.addEventListener(ev, e => { e.preventDefault(); drop.classList.add('dragover'); })
        );
        ['dragleave', 'drop'].forEach(ev =>
            drop.addEventListener(ev, e => { e.preventDefault(); drop.classList.remove('dragover'); })
        );
        drop.addEventListener('drop', e => {
            const file = e.dataTransfer.files[0];
            if (!file) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            setFile(file);
        });
    }

    /* ================= SUBMIT LOADING ================= */
    const form = document.getElementById('applyForm');
    const btn = document.getElementById('submitBtn');
    if (form && btn) {
        form.addEventListener('submit', (e) => {
            // Force-show all field states
            let hasErr = false;
            ['name', 'email', 'phone'].forEach(id => {
                const el = document.getElementById(id);
                const wrap = el && el.closest('.field');
                if (!el || !wrap) return;
                const ok = validators[id](el.value);
                setFieldState(wrap, ok, true);
                if (!ok && !hasErr) { el.focus(); hasErr = true; }
            });

            if (!form.checkValidity() || hasErr) {
                e.preventDefault();
                return;
            }

            btn.classList.add('loading');
            btn.disabled = true;
            const lbl = btn.querySelector('.btn-label');
            if (lbl) lbl.textContent = 'Mengirim';
        });
    }

    /* ================= MOBILE CTA ================= */
    const cta = document.getElementById('mobileCta');
    const scrollBtn = document.getElementById('scrollToForm');
    const applyPanel = document.getElementById('lamar');

    if (cta && applyPanel) {
        const onScroll = () => {
            const rect = applyPanel.getBoundingClientRect();
            const visible = rect.top < window.innerHeight && rect.bottom > 0;
            cta.classList.toggle('show', !visible && window.scrollY > 300);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }
    if (scrollBtn && applyPanel) {
        scrollBtn.addEventListener('click', () => {
            applyPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
            setTimeout(() => {
                const n = document.getElementById('name');
                if (n) n.focus({ preventScroll: true });
            }, 500);
        });
    }

    /* ================= AUTO-SCROLL ON HASH ================= */
    if (window.location.hash === '#lamar') {
        const target = document.getElementById('lamar');
        if (target) setTimeout(() => target.scrollIntoView({ behavior: 'smooth', block: 'start' }), 180);
    }

    updateProgress();
})();
</script>
@endsection