@extends('admin.layout')
@section('title', 'Proses Seleksi')

@section('content')

{{-- ============================================================
     STYLE
     ============================================================ --}}
<style>
/* ---------- VARIABEL ---------- */
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

/* ---------- BLOB ---------- */
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
.hrd-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1.25rem;
    margin-bottom: 1.75rem;
    animation: h-enter .5s cubic-bezier(.2,.7,.2,1) both;
}
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

.badge-count {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    padding: .55rem 1.1rem;
    font-size: .85rem;
    font-weight: 600;
    color: #a5c4ff;
    background: rgba(96,165,250,.14);
    border: 1px solid rgba(96,165,250,.32);
    border-radius: 12px;
}
.badge-count i { font-size: .85rem; }

/* ---------- STAGE TABS ---------- */
.stage-tabs {
    display: flex;
    gap: .7rem;
    flex-wrap: wrap;
    margin-bottom: 1.4rem;
    animation: h-enter .5s .05s cubic-bezier(.2,.7,.2,1) both;
}
.stage-tab {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: .7rem;
    padding: .7rem 1.25rem;
    font-size: .88rem;
    font-weight: 600;
    color: var(--h-muted);
    text-decoration: none;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 12px;
    transition: all .2s;
}
.stage-tab:hover {
    color: #fff;
    background: rgba(255,255,255,.08);
    border-color: rgba(255,255,255,.22);
    transform: translateY(-1px);
}
.stage-num {
    width: 24px;
    height: 24px;
    display: grid;
    place-items: center;
    font-size: .72rem;
    font-weight: 800;
    color: #a5c4ff;
    background: rgba(96,165,250,.18);
    border-radius: 50%;
    transition: all .2s;
}
.stage-tab.active {
    color: #fff;
    border-color: transparent;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 12px 26px -12px rgba(79,70,229,.9);
}
.stage-tab.active .stage-num {
    color: #fff;
    background: rgba(255,255,255,.28);
}

/* ---------- TABLE CARD ---------- */
.table-card {
    border-radius: 20px;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 24px 60px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.08);
    animation: h-enter .5s .1s cubic-bezier(.2,.7,.2,1) both;
}
.dark-table { width: 100%; border-collapse: collapse; }
.dark-table thead th {
    padding: 1rem 1.25rem;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--h-soft);
    text-align: left;
    background: rgba(255,255,255,.03);
    border-bottom: 1px solid var(--h-line);
    white-space: nowrap;
}
.dark-table thead th.r { text-align: right; }
.dark-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.05);
    transition: background .18s;
}
.dark-table tbody tr:last-child { border-bottom: 0; }
.dark-table tbody tr:hover      { background: rgba(96,165,250,.06); }
.dark-table td {
    padding: 1.1rem 1.25rem;
    font-size: .88rem;
    color: #cbd5e1;
    vertical-align: middle;
}

/* ---------- CELL: USER ---------- */
.cell-user { display: flex; align-items: center; gap: .9rem; }
.avatar {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .95rem;
    font-weight: 800;
    color: #fff;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 0 0 2px rgba(255,255,255,.10), 0 8px 18px -8px rgba(79,70,229,.85);
}
.user-name { font-size: .95rem; font-weight: 700; color: #f1f5f9; }
.user-mail { margin-top: 2px; font-size: .78rem; color: var(--h-soft); }

/* ---------- TAG ---------- */
.tag {
    display: inline-flex;
    align-items: center;
    padding: .35rem .75rem;
    font-size: .75rem;
    font-weight: 600;
    color: #a5c4ff;
    background: rgba(96,165,250,.14);
    border: 1px solid rgba(96,165,250,.28);
    border-radius: 8px;
    white-space: nowrap;
}

/* ---------- PILL ---------- */
.pill {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .38rem .85rem;
    font-size: .78rem;
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
.pill.orange { color: #fcd34d; background: rgba(245,158,11,.12); border: 1px solid rgba(245,158,11,.3); }
.pill.blue   { color: #93c5fd; background: rgba(96,165,250,.12); border: 1px solid rgba(96,165,250,.3); }

/* ---------- ACTION BUTTONS ---------- */
.btn-action {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    height: 38px;
    padding: 0 1rem;
    font: inherit;
    font-size: .82rem;
    font-weight: 700;
    color: #fff;
    border: 0;
    border-radius: 999px;
    cursor: pointer;
    transition: transform .18s, box-shadow .18s, filter .18s;
}
.btn-action.pass {
    background: linear-gradient(135deg, #059669, #10b981);
    box-shadow: 0 10px 22px -10px rgba(16,185,129,.9);
}
.btn-action.pass:hover  { transform: translateY(-2px); filter: brightness(1.1); box-shadow: 0 14px 26px -10px rgba(16,185,129,1); }
.btn-action.fail {
    background: linear-gradient(135deg, #e11d48, #fb7185);
    box-shadow: 0 10px 22px -10px rgba(251,113,133,.9);
}
.btn-action.fail:hover  { transform: translateY(-2px); filter: brightness(1.1); box-shadow: 0 14px 26px -10px rgba(251,113,133,1); }
.btn-action:active      { transform: translateY(0); }

.h-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,.45);
    transform: scale(0);
    animation: h-ripple .6s ease-out;
    pointer-events: none;
}
@keyframes h-ripple { to { transform: scale(4); opacity: 0; } }

/* ---------- EMPTY ---------- */
.empty { padding: 4.5rem 1rem; text-align: center; color: var(--h-muted); }
.empty .ic {
    width: 76px;
    height: 76px;
    margin: 0 auto 1.1rem;
    display: grid;
    place-items: center;
    font-size: 1.8rem;
    color: #60a5fa;
    background: rgba(96,165,250,.10);
    border: 1px solid rgba(96,165,250,.22);
    border-radius: 22px;
    animation: h-pulse 3s ease-in-out infinite;
}
@keyframes h-pulse { 50% { box-shadow: 0 0 0 12px rgba(96,165,250,.08); } }
.empty strong { display: block; font-size: 1rem; font-weight: 700; color: #cbd5e1; margin-bottom: .35rem; }
.empty p { margin: 0; font-size: .86rem; }

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
    .hrd-page  { padding: 1.25rem; border-radius: 18px; }
    .hrd-title { font-size: 1.4rem; }
    .dark-table thead th,
    .dark-table td { padding: .85rem 1rem; }
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
        <div>
            <h1 class="hrd-title">Pipeline Kualifikasi &amp; Seleksi</h1>
            <p class="hrd-sub">Kelola dan tentukan kelulusan kandidat di setiap tahapan kualifikasi.</p>
        </div>

        <span class="badge-count">
            <i class="fa-solid fa-users"></i>
            {{ $applications->count() }} Kandidat
        </span>
    </div>

    {{-- ---------- STAGE TABS ---------- --}}
    <div class="stage-tabs">

        <a href="{{ route('hrd.selection.index', ['tahap' => 'interview']) }}"
           class="stage-tab {{ $tahap === 'interview' ? 'active' : '' }}">
            <span class="stage-num">1</span>
            Interview &amp; Tes
        </a>

        <a href="{{ route('hrd.selection.index', ['tahap' => 'final']) }}"
           class="stage-tab {{ $tahap === 'final' ? 'active' : '' }}">
            <span class="stage-num">2</span>
            Tahap Final
        </a>

    </div>

    {{-- ---------- TABLE ---------- --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="dark-table">

                <thead>
                    <tr>
                        <th>Kandidat</th>
                        <th>Posisi</th>
                        <th>Tahap Sekarang</th>
                        <th class="r">Keputusan</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($applications as $a)
                    <tr>
                        {{-- Kandidat --}}
                        <td>
                            <div class="cell-user">
                                <div class="avatar">{{ strtoupper(substr($a->nama, 0, 1)) }}</div>
                                <div>
                                    <div class="user-name">{{ $a->nama }}</div>
                                    <div class="user-mail">{{ $a->email }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Posisi --}}
                        <td><span class="tag">{{ $a->vacancy->title }}</span></td>

                        {{-- Tahap --}}
                        <td>
                            <span class="pill {{ $tahap === 'final' ? 'blue' : 'orange' }}">
                                <span class="dot"></span> {{ $a->stageLabel() }}
                            </span>
                        </td>

                        {{-- Keputusan --}}
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:.5rem;">

                                {{-- Tombol Lolos: teks berbeda per tab --}}
                                <form action="{{ route('hrd.selection.decide', $a) }}"
                                      method="POST"
                                      style="display:inline;margin:0;"
                                      @if($tahap === 'final')
                                          onsubmit="return confirm('TERIMA {{ $a->nama }} sebagai karyawan?')"
                                      @else
                                          onsubmit="return confirm('Lanjutkan {{ $a->nama }} ke Tahap Final?')"
                                      @endif>
                                    @csrf
                                    <input type="hidden" name="keputusan" value="lolos">
                                    @if($tahap === 'final')
                                        <button type="submit" class="btn-action pass">
                                            <i class="fa-solid fa-check"></i> Terima
                                        </button>
                                    @else
                                        <button type="submit" class="btn-action pass">
                                            <i class="fa-solid fa-arrow-right"></i> Lanjut ke Tahap Final
                                        </button>
                                    @endif
                                </form>

                                {{-- Tombol Gugur --}}
                                <form action="{{ route('hrd.selection.decide', $a) }}"
                                      method="POST"
                                      style="display:inline;margin:0;"
                                      onsubmit="return confirm('Nyatakan {{ $a->nama }} gugur?')">
                                    @csrf
                                    <input type="hidden" name="keputusan" value="gugur">
                                    <button type="submit" class="btn-action fail">
                                        <i class="fa-solid fa-xmark"></i> Gugur
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="border:0;">
                            <div class="empty">
                                <div class="ic"><i class="fa-solid fa-user-check"></i></div>
                                <strong>Belum Ada Kandidat di Tahap Ini</strong>
                                <p>Kandidat akan muncul di sini setelah lolos dari tahap sebelumnya.</p>
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

    document.querySelectorAll('.btn-action, .stage-tab').forEach(function (el) {
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
})();
</script>

@endsection