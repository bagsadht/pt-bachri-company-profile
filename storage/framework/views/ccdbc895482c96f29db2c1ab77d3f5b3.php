
<?php $__env->startSection('title', $mode === 'masuk' ? 'Lamaran Masuk' : 'Manajemen Pelamar'); ?>

<?php $__env->startSection('content'); ?>

<style>
/* ============================================================
   VARIABEL & RESET
   ============================================================ */
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
        radial-gradient(1200px 700px at 15% 0%,   #17275a 0%, transparent 55%),
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
.hrd-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1.25rem;
    margin-bottom: 1.6rem;
    animation: h-enter .5s cubic-bezier(.2,.7,.2,1) both;
}
.hrd-title {
    margin: 0;
    font-size: 1.7rem;
    font-weight: 800;
    letter-spacing: -.03em;
    background: linear-gradient(120deg, #fff 15%, #a5c4ff 55%, #67e8f9 100%);
    -webkit-background-clip: text;
            background-clip: text;
    color: transparent;
}
.hrd-sub { margin: .4rem 0 0; font-size: .9rem; color: var(--h-muted); }

/* ---------- SEARCH ---------- */
.hrd-toolbar {
    display: flex;
    gap: .6rem;
    align-items: center;
    flex-wrap: wrap;
}
.hrd-search-field { position: relative; }
.hrd-search input {
    width: 280px;
    height: 44px;
    padding: 0 1rem 0 2.6rem;
    font: inherit;
    font-size: .88rem;
    color: #fff;
    background: rgba(7,12,28,.55);
    border: 1.5px solid var(--h-line);
    border-radius: 12px;
    outline: none;
    transition: all .2s ease;
}
.hrd-search input::placeholder { color: #5f739f; }
.hrd-search input:focus {
    border-color: #60a5fa;
    background: rgba(7,12,28,.85);
    box-shadow: 0 0 0 4px rgba(59,130,246,.18);
}
.hrd-search .ico {
    position: absolute;
    left: .95rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: .82rem;
    color: #6f84b3;
    pointer-events: none;
    transition: color .2s;
}
.hrd-search-field:focus-within .ico { color: #60a5fa; }

/* ---------- TAB PILLS ---------- */
.hrd-tabs {
    display: flex;
    gap: .55rem;
    flex-wrap: wrap;
    margin-bottom: 1.1rem;
    animation: h-enter .5s .05s cubic-bezier(.2,.7,.2,1) both;
}
.hrd-tab {
    display: inline-flex;
    align-items: center;
    gap: .6rem;
    padding: .7rem 1.15rem;
    font-size: .86rem;
    font-weight: 600;
    color: var(--h-muted);
    text-decoration: none;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 12px;
    transition: all .2s ease;
    white-space: nowrap;
}
.hrd-tab:hover {
    color: #fff;
    background: rgba(255,255,255,.08);
    border-color: rgba(255,255,255,.22);
    transform: translateY(-1px);
}
.hrd-tab .num {
    width: 22px;
    height: 22px;
    display: grid;
    place-items: center;
    font-size: .7rem;
    font-weight: 800;
    color: #a5c4ff;
    background: rgba(96,165,250,.18);
    border-radius: 50%;
    transition: all .2s;
}
.hrd-tab .badge {
    min-width: 26px;
    padding: .16rem .5rem;
    font-size: .72rem;
    font-weight: 700;
    text-align: center;
    border-radius: 6px;
    background: rgba(255,255,255,.08);
    color: #cbd5e1;
    transition: all .2s;
}
.hrd-tab.active {
    color: #fff;
    border-color: transparent;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 12px 26px -12px rgba(79,70,229,.9);
}
.hrd-tab.active .num,
.hrd-tab.active .badge {
    color: #fff;
    background: rgba(255,255,255,.25);
}

/* ---------- CHIP FILTER ---------- */
.hrd-chips {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
    margin-bottom: 1.2rem;
    animation: h-enter .4s .1s cubic-bezier(.2,.7,.2,1) both;
}
.chip {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .55rem .95rem;
    font-size: .82rem;
    font-weight: 600;
    color: var(--h-muted);
    text-decoration: none;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 10px;
    transition: all .2s ease;
    white-space: nowrap;
}
.chip i { font-size: .78rem; }
.chip .count {
    min-width: 24px;
    padding: .12rem .45rem;
    font-size: .7rem;
    font-weight: 700;
    text-align: center;
    border-radius: 6px;
    background: rgba(255,255,255,.08);
    color: #cbd5e1;
    transition: all .2s;
}
.chip:hover {
    color: #fff;
    background: rgba(255,255,255,.08);
    border-color: rgba(255,255,255,.22);
    transform: translateY(-1px);
}
.chip.active { color: #fff; border-color: transparent; }
.chip.active.all   { background: linear-gradient(135deg, #334155, #0f172a); box-shadow: 0 10px 24px -10px rgba(0,0,0,.7); }
.chip.active.lolos { background: linear-gradient(135deg, #059669, #10b981); box-shadow: 0 10px 24px -10px rgba(16,185,129,.75); }
.chip.active.gagal { background: linear-gradient(135deg, #e11d48, #fb7185); box-shadow: 0 10px 24px -10px rgba(251,113,133,.75); }
.chip.active .count { background: rgba(255,255,255,.22); color: #fff; }

/* ---------- CARD & TABLE ---------- */
.hrd-card {
    border-radius: 20px;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 24px 60px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.08);
    animation: h-enter .5s .1s cubic-bezier(.2,.7,.2,1) both;
}
.hrd-table { width: 100%; border-collapse: collapse; }

.hrd-table thead th {
    padding: 1rem 1.25rem;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--h-soft);
    text-align: left;
    white-space: nowrap;
    background: rgba(255,255,255,.03);
    border-bottom: 1px solid var(--h-line);
}
.hrd-table thead th.r { text-align: right; }
.hrd-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.05);
    transition: background .18s ease;
}
.hrd-table tbody tr:last-child { border-bottom: 0; }
.hrd-table tbody tr:hover { background: rgba(96,165,250,.06); }

.hrd-table td {
    padding: 1.1rem 1.25rem;
    font-size: .88rem;
    color: #cbd5e1;
    vertical-align: middle;
}
.cell-no { width: 60px; font-size: .82rem; font-weight: 600; color: #6f84b3; }

/* ---------- CELL: NAMA ---------- */
.cell-name { display: flex; align-items: center; gap: .9rem; }
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
.name-txt  { font-size: .92rem; font-weight: 700; color: #f1f5f9; }
.name-date { display: flex; align-items: center; gap: .35rem; margin-top: 3px; font-size: .74rem; color: var(--h-soft); }

/* ---------- CELL: POSISI ---------- */
.tag-pos {
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

/* ---------- CELL: STATUS PILL ---------- */
.pill {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .38rem .8rem;
    font-size: .75rem;
    font-weight: 600;
    border-radius: 999px;
    white-space: nowrap;
}
.pill .dot {
    position: relative;
    width: 6px;
    height: 6px;
    border-radius: 50%;
}
.pill.green  { color: #6ee7b7; background: rgba(16,185,129,.12);  border: 1px solid rgba(16,185,129,.3); }
.pill.red    { color: #fda4af; background: rgba(251,113,133,.12); border: 1px solid rgba(251,113,133,.3); }
.pill.orange { color: #fcd34d; background: rgba(245,158,11,.12);  border: 1px solid rgba(245,158,11,.3); }
.pill.blue   { color: #93c5fd; background: rgba(96,165,250,.12);  border: 1px solid rgba(96,165,250,.3); }
.pill.purple { color: #c4b5fd; background: rgba(139,92,246,.12);  border: 1px solid rgba(139,92,246,.3); }

.pill.green  .dot { background: var(--h-green); box-shadow: 0 0 8px var(--h-green); }
.pill.red    .dot { background: var(--h-red);   box-shadow: 0 0 8px var(--h-red);   }
.pill.orange .dot { background: var(--h-amber); box-shadow: 0 0 8px var(--h-amber); }
.pill.blue   .dot { background: #60a5fa;        box-shadow: 0 0 8px #60a5fa;        }
.pill.purple .dot { background: #a78bfa;        box-shadow: 0 0 8px #a78bfa;        }

.pill.green  .dot::after,
.pill.orange .dot::after,
.pill.blue   .dot::after,
.pill.purple .dot::after {
    content: "";
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 1px solid currentColor;
    animation: h-ping 1.8s ease-out infinite;
}
@keyframes h-ping {
    0%   { transform: scale(.7); opacity: .9; }
    100% { transform: scale(2.2); opacity: 0; }
}

/* ---------- CELL: AKSI ---------- */
.row-actions { display: inline-flex; gap: .45rem; align-items: center; }
.icon-btn {
    position: relative;
    overflow: hidden;
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
    transition: all .18s ease;
}
.icon-btn:hover {
    color: #fff;
    transform: translateY(-2px);
    background: rgba(96,165,250,.16);
    border-color: rgba(96,165,250,.42);
    box-shadow: 0 8px 18px -8px rgba(96,165,250,.7);
}
.icon-btn.danger:hover  { color: #fda4af; background: rgba(251,113,133,.16); border-color: rgba(251,113,133,.42); }
.icon-btn.success:hover { color: #6ee7b7; background: rgba(16,185,129,.16);  border-color: rgba(16,185,129,.42); }
.icon-btn.warning:hover { color: #fcd34d; background: rgba(245,158,11,.16);   border-color: rgba(245,158,11,.42); }

/* ---------- SPINNER PADA TOMBOL ICON ---------- */
.icon-btn .ib-spinner {
    display: none;
    width: 14px;
    height: 14px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: ib-spin .7s linear infinite;
}
.icon-btn.loading .ib-spinner { display: inline-block; }
.icon-btn.loading > i { display: none; }
.icon-btn.loading {
    pointer-events: none;
    opacity: .75;
}
@keyframes ib-spin { to { transform: rotate(360deg); } }

/* ---------- EMPTY STATE ---------- */
.empty { padding: 4rem 1rem; text-align: center; color: var(--h-muted); }
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
.empty h3 { margin: 0 0 .35rem; font-size: 1rem; font-weight: 700; color: #cbd5e1; }
.empty p  { margin: 0; font-size: .86rem; }

/* ---------- PAGINATION ---------- */
.hrd-pagination {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
    animation: h-enter .5s .15s cubic-bezier(.2,.7,.2,1) both;
}
.hrd-pagination .pagination {
    display: flex;
    gap: .3rem;
    margin: 0;
    padding: 0;
    list-style: none;
}
.hrd-pagination .page-item .page-link {
    min-width: 40px;
    padding: .55rem .9rem;
    font-size: .82rem;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    color: #a9b8d8;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 10px;
    transition: all .18s;
}
.hrd-pagination .page-item .page-link:hover {
    color: #fff;
    background: rgba(96,165,250,.14);
    border-color: rgba(96,165,250,.42);
}
.hrd-pagination .page-item.active .page-link {
    color: #fff;
    border-color: transparent;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 10px 22px -10px rgba(79,70,229,.9);
}
.hrd-pagination .page-item.disabled .page-link { opacity: .35; }

/* ============================================================
   MODAL (jadwal interview + terima pelamar)
   ============================================================ */
.iv-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(5,10,25,.75);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}
.iv-modal.open { display: flex; }
.iv-modal__box {
    width: 100%;
    max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    background: linear-gradient(160deg, #131c33, #0f1730);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 20px;
    box-shadow: 0 24px 60px -20px rgba(0,0,0,.9);
    animation: h-enter .3s cubic-bezier(.2,.7,.2,1);
}
.iv-modal__head {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}
.iv-modal__title { margin: 0; font-size: 1.05rem; font-weight: 800; color: #fff; }
.iv-modal__sub   { margin: 4px 0 0; font-size: .8rem; color: #94a3c4; }
.iv-modal__sub strong { color: #a5c4ff; }
.iv-modal__close {
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,.1);
    background: rgba(255,255,255,.04);
    color: #a9b8d8;
    cursor: pointer;
    font-size: .9rem;
    transition: all .18s;
}
.iv-modal__close:hover { color: #fff; background: rgba(251,113,133,.16); border-color: rgba(251,113,133,.42); }
.iv-modal__body { padding: 1.5rem; display: grid; gap: 1rem; }
.iv-field label { display: block; font-size: .8rem; font-weight: 700; color: #a5c4ff; margin-bottom: 6px; }
.iv-field .req { color: #fb7185; }
.iv-field .opt { color: #94a3c4; font-weight: 400; }
.iv-input, .iv-textarea {
    width: 100%;
    height: 42px;
    padding: 0 .9rem;
    font: inherit;
    font-size: .88rem;
    color: #fff;
    background: rgba(7,12,28,.7);
    border: 1.5px solid rgba(255,255,255,.12);
    border-radius: 10px;
    outline: none;
    transition: all .18s;
    color-scheme: dark;
}
.iv-textarea { height: auto; padding: .75rem .9rem; resize: vertical; min-height: 80px; }
.iv-input:focus, .iv-textarea:focus {
    border-color: #60a5fa;
    background: rgba(7,12,28,.9);
    box-shadow: 0 0 0 4px rgba(59,130,246,.18);
}
.iv-input:disabled {
    color: #94a3c4;
    background: rgba(7,12,28,.5);
    border-color: rgba(255,255,255,.08);
    cursor: not-allowed;
}
.iv-input::placeholder, .iv-textarea::placeholder { color: #5f739f; }
.iv-row { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
.iv-modal__foot {
    padding: 1rem 1.5rem;
    background: rgba(0,0,0,.2);
    border-top: 1px solid rgba(255,255,255,.06);
    display: flex;
    gap: .6rem;
    justify-content: flex-end;
}
.iv-btn {
    height: 42px;
    padding: 0 1.15rem;
    font: inherit;
    font-size: .85rem;
    font-weight: 700;
    border-radius: 10px;
    border: 0;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    transition: all .18s;
}
.iv-btn.ghost {
    color: #cbd5e1;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.12);
}
.iv-btn.ghost:hover { color: #fff; background: rgba(255,255,255,.1); }
.iv-btn.submit {
    color: #fff;
    background: linear-gradient(135deg, #059669, #10b981);
    box-shadow: 0 10px 22px -10px rgba(16,185,129,.9);
}
.iv-btn.submit:hover { transform: translateY(-2px); filter: brightness(1.08); }
.iv-btn.submit:disabled { cursor: not-allowed; filter: saturate(.6); transform: none; }

/* ---------- SPINNER DI TOMBOL MODAL ---------- */
.iv-btn-spinner {
    display: none;
    width: 14px;
    height: 14px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: iv-btn-spin .7s linear infinite;
}
.iv-btn.loading .iv-btn-spinner { display: inline-block; }
.iv-btn.loading > i { display: none; }
.iv-btn.loading { pointer-events: none; opacity: .8; }
@keyframes iv-btn-spin { to { transform: rotate(360deg); } }

/* ---------- HINT KECIL ---------- */
.iv-hint { display: block; margin-top: .4rem; font-size: .72rem; color: #7f95c9; }

/* ---------- ANIMASI & RESPONSIF ---------- */
@keyframes h-enter {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: none; }
}
@keyframes h-ripple {
    to { transform: scale(4); opacity: 0; }
}
@media (prefers-reduced-motion: reduce) {
    .hrd-page *, .hrd-page *::before, .hrd-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
@media (max-width: 768px) {
    .hrd-page          { padding: 1.25rem; border-radius: 18px; }
    .hrd-title         { font-size: 1.35rem; }
    .hrd-search input  { width: 100%; }
    .hrd-search-field  { flex: 1; }
    .hrd-toolbar       { width: 100%; }
    .hrd-table thead th{ padding: .8rem .9rem; }
    .hrd-table td      { padding: .9rem; }
    .iv-row            { grid-template-columns: 1fr; }
}
</style>



<div class="hrd-page">

    <span class="hrd-blob b1" aria-hidden="true"></span>
    <span class="hrd-blob b2" aria-hidden="true"></span>
    <span class="hrd-blob b3" aria-hidden="true"></span>

    
    <div class="hrd-head">
        <div>
            <h1 class="hrd-title">
                <?php echo e($mode === 'masuk' ? 'Lamaran Masuk' : 'Manajemen Pelamar'); ?>

            </h1>
            <p class="hrd-sub">
                <?php echo e($mode === 'masuk'
                    ? 'Tinjau lamaran baru dan tentukan apakah lanjut ke proses seleksi.'
                    : 'Kelola pelamar di tahap interview, final, dan lihat hasil akhirnya.'); ?>

            </p>
        </div>

        <form method="GET" class="hrd-toolbar">
            <?php if($mode === 'manajemen'): ?>
                <?php if($tab !== 'interview'): ?><input type="hidden" name="tab" value="<?php echo e($tab); ?>"><?php endif; ?>
                <?php if($hasil): ?><input type="hidden" name="hasil" value="<?php echo e($hasil); ?>"><?php endif; ?>
            <?php endif; ?>

            <div class="hrd-search-field hrd-search">
                <input type="text" name="q" value="<?php echo e($q); ?>" placeholder="Cari nama, posisi..." autocomplete="off">
                <i class="fa-solid fa-magnifying-glass ico"></i>
            </div>
        </form>
    </div>

    
    <?php if($mode === 'manajemen'): ?>
    <div class="hrd-tabs">
        <a href="<?php echo e(route('hrd.applicants.index', array_filter(['tab' => 'interview', 'q' => $q]))); ?>"
           class="hrd-tab <?php echo e($tab === 'interview' ? 'active' : ''); ?>">
            <span class="num">1</span>
            Interview &amp; Tes
            <span class="badge"><?php echo e($counts['interview']); ?></span>
        </a>
        <a href="<?php echo e(route('hrd.applicants.index', array_filter(['tab' => 'final', 'q' => $q]))); ?>"
           class="hrd-tab <?php echo e($tab === 'final' ? 'active' : ''); ?>">
            <span class="num">2</span>
            Tahap Final
            <span class="badge"><?php echo e($counts['final']); ?></span>
        </a>
        <a href="<?php echo e(route('hrd.applicants.index', array_filter(['tab' => 'semua', 'q' => $q]))); ?>"
           class="hrd-tab <?php echo e($tab === 'semua' ? 'active' : ''); ?>">
            <span class="num">3</span>
            Semua Pelamar
            <span class="badge"><?php echo e($counts['semua']); ?></span>
        </a>
    </div>
    <?php endif; ?>

    
    <?php if($mode === 'manajemen' && $tab === 'semua'): ?>
    <div class="hrd-chips">
        <a href="<?php echo e(route('hrd.applicants.index', array_filter(['tab' => 'semua', 'q' => $q]))); ?>"
           class="chip <?php echo e($hasil === null ? 'active all' : ''); ?>">
            <i class="fa-solid fa-users"></i>
            Semua
            <span class="count"><?php echo e($counts['semua']); ?></span>
        </a>
        <a href="<?php echo e(route('hrd.applicants.index', array_filter(['tab' => 'semua', 'hasil' => 'lolos', 'q' => $q]))); ?>"
           class="chip <?php echo e($hasil === 'lolos' ? 'active lolos' : ''); ?>">
            <i class="fa-solid fa-circle-check"></i>
            Pelamar Lolos
            <span class="count"><?php echo e($counts['lolos']); ?></span>
        </a>
        <a href="<?php echo e(route('hrd.applicants.index', array_filter(['tab' => 'semua', 'hasil' => 'gagal', 'q' => $q]))); ?>"
           class="chip <?php echo e($hasil === 'gagal' ? 'active gagal' : ''); ?>">
            <i class="fa-solid fa-circle-xmark"></i>
            Tidak Lolos
            <span class="count"><?php echo e($counts['gagal']); ?></span>
        </a>
    </div>
    <?php endif; ?>

    
    <div class="hrd-card">
        <div class="table-responsive">
            <table class="hrd-table">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Pelamar</th>
                        <th>Posisi</th>
                        <th>Tahap Seleksi</th>
                        <th>Status</th>
                        <th class="r">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="cell-no"><?php echo e($applications->firstItem() + $loop->index); ?></td>

                        
                        <td>
                            <div class="cell-name">
                                <div class="avatar"><?php echo e(strtoupper(substr($a->nama, 0, 1))); ?></div>
                                <div>
                                    <div class="name-txt"><?php echo e($a->nama); ?></div>
                                    <div class="name-date">
                                        <i class="fa-regular fa-clock" style="font-size:.7rem;"></i>
                                        <?php echo e($a->created_at->format('d M Y')); ?>

                                    </div>
                                </div>
                            </div>
                        </td>

                        
                        <td><span class="tag-pos"><?php echo e($a->vacancy->judul ?? '-'); ?></span></td>

                        
                        <td>
                            <span style="font-size:.85rem;color:#b6c2e2;"><?php echo e($a->stageLabel()); ?></span>
                        </td>

                        
                        <td>
                            <?php if($a->status === 'diterima'): ?>
                                <span class="pill green"><span class="dot"></span> Diterima</span>
                            <?php elseif($a->status === 'ditolak'): ?>
                                <span class="pill red"><span class="dot"></span> Ditolak</span>
                            <?php elseif($a->status === 'diproses'): ?>
                                <span class="pill blue"><span class="dot"></span> Interview &amp; Tes</span>
                            <?php elseif($a->status === 'wawancara'): ?>
                                <span class="pill purple"><span class="dot"></span> Tahap Final</span>
                            <?php else: ?>
                                <span class="pill orange"><span class="dot"></span> Kontak Masuk</span>
                            <?php endif; ?>
                        </td>

                        
                        <td style="text-align:right;white-space:nowrap;">
                            <div class="row-actions">

                                
                                <a href="<?php echo e(route('hrd.applications.cv', $a)); ?>"
                                   class="icon-btn" title="Lihat Berkas">
                                    <i class="fa-regular fa-file-lines"></i>
                                </a>

                                
                                <?php if($a->status === 'baru'): ?>
                                    <button type="button"
                                            class="icon-btn success"
                                            title="Lanjut ke Proses Seleksi"
                                            onclick='openInterviewModal(
                                                <?php echo e($a->id); ?>,
                                                <?php echo json_encode($a->nama, 15, 512) ?>,
                                                <?php echo json_encode($a->vacancy->judul ?? "-", 15, 512) ?>
                                            )'>
                                        <i class="fa-solid fa-check"></i>
                                    </button>

                                <?php elseif($a->status === 'diproses'): ?>
                                    <form action="<?php echo e(route('hrd.selection.decide', $a)); ?>"
                                          method="POST" style="display:inline;margin:0;"
                                          data-confirm="Lanjutkan <?php echo e($a->nama); ?> ke Tahap Final? Kandidat akan masuk ke daftar seleksi akhir."
                                          data-confirm-type="success"
                                          data-confirm-text="Ya, Lanjutkan">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="keputusan" value="lolos">
                                        <button type="submit" class="icon-btn success" title="Lanjut ke Tahap Final">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </button>
                                    </form>

                                <?php elseif($a->status === 'wawancara'): ?>
                                    <?php if($a->email_sent_at): ?>
                                        
                                        <span class="icon-btn"
                                              title="Email pengumuman terkirim <?php echo e($a->email_sent_at->diffForHumans()); ?>"
                                              style="color:#6ee7b7;background:rgba(16,185,129,.12);border-color:rgba(16,185,129,.4);cursor:default;">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                    <?php else: ?>
                                        
                                        <button type="button"
                                                class="icon-btn success"
                                                title="Terima &amp; Kirim Email Pengumuman"
                                                onclick='openAcceptModal(
                                                    <?php echo e($a->id); ?>,
                                                    <?php echo json_encode($a->nama, 15, 512) ?>,
                                                    <?php echo json_encode($a->email, 15, 512) ?>,
                                                    <?php echo json_encode($a->vacancy->judul ?? "-", 15, 512) ?>
                                                )'>
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>

                                
                                <?php if(in_array($a->status, ['baru', 'diproses', 'wawancara'], true)): ?>
                                    <form action="<?php echo e(route('hrd.applications.update', $a)); ?>"
                                          method="POST" style="display:inline;margin:0;"
                                          data-confirm="Tandai <?php echo e($a->nama); ?> sebagai TIDAK LOLOS? Status masih bisa diubah kembali dari tab Semua Pelamar."
                                          data-confirm-type="warning"
                                          data-confirm-text="Ya, Tandai Gagal">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="icon-btn warning" title="Tidak Lolos">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>

                                
                                <form action="<?php echo e(route('hrd.applications.destroy', $a)); ?>"
                                      method="POST" style="display:inline;margin:0;"
                                      data-confirm="Hapus data pelamar ini secara permanen? Tindakan ini tidak bisa dibatalkan."
                                      data-confirm-type="danger"
                                      data-confirm-text="Ya, Hapus Permanen">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="icon-btn danger" title="Hapus">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="padding:0;border:0;">
                            <div class="empty">
                                <div class="ic"><i class="fa-solid fa-user-group"></i></div>
                                <h3>
                                    <?php if($mode === 'masuk'): ?>
                                        Belum Ada Lamaran Baru
                                    <?php elseif($tab === 'interview'): ?>
                                        Belum Ada Kandidat di Interview &amp; Tes
                                    <?php elseif($tab === 'final'): ?>
                                        Belum Ada Kandidat di Tahap Final
                                    <?php elseif($hasil === 'lolos'): ?>
                                        Belum Ada Pelamar Lolos
                                    <?php elseif($hasil === 'gagal'): ?>
                                        Belum Ada Pelamar Tidak Lolos
                                    <?php else: ?>
                                        Belum Ada Data Pelamar
                                    <?php endif; ?>
                                </h3>
                                <p>
                                    <?php if($mode === 'masuk'): ?>
                                        Lamaran baru akan muncul di sini setelah ada yang melamar.
                                    <?php else: ?>
                                        Data akan muncul setelah ada pelamar di tahap ini.
                                    <?php endif; ?>
                                </p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <?php if($applications->hasPages()): ?>
        <div class="hrd-pagination">
            <?php echo e($applications->links('pagination::bootstrap-5')); ?>

        </div>
    <?php endif; ?>

    
    <div id="interviewModal" class="iv-modal" role="dialog" aria-modal="true">
        <div class="iv-modal__box">
            <div class="iv-modal__head">
                <div>
                    <h3 class="iv-modal__title">Jadwalkan Interview &amp; Tes</h3>
                    <p class="iv-modal__sub">Kirim undangan ke: <strong id="ivModalName">—</strong></p>
                </div>
                <button type="button" class="iv-modal__close" onclick="closeInterviewModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="interviewForm" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <input type="hidden" name="status" value="diproses">

                <div class="iv-modal__body">
                    <div class="iv-field">
                        <label>Posisi Dilamar</label>
                        <input type="text" id="ivModalPosition" class="iv-input" disabled>
                    </div>

                    <div class="iv-row">
                        <div class="iv-field">
                            <label>Tanggal <span class="req">*</span></label>
                            <input type="date" name="interview_date" class="iv-input" required
                                   min="<?php echo e(now()->format('Y-m-d')); ?>"
                                   value="<?php echo e(now()->addDay()->format('Y-m-d')); ?>">
                        </div>
                        <div class="iv-field">
                            <label>Jam <span class="req">*</span></label>
                            <input type="time" name="interview_time" class="iv-input" required value="09:00">
                        </div>
                    </div>

                    <div class="iv-field">
                        <label>Lokasi <span class="req">*</span></label>
                        <input type="text" name="interview_location" class="iv-input" required
                               value="Kantor PT Bachri Samudera Indonesia">
                    </div>

                    <div class="iv-field">
                        <label>Catatan Tambahan <span class="opt">(opsional)</span></label>
                        <textarea name="interview_note" class="iv-textarea" rows="3"
                                  placeholder="Contoh: Bawa laptop dan berpakaian formal."></textarea>
                    </div>
                </div>

                <div class="iv-modal__foot">
                    <button type="button" class="iv-btn ghost" onclick="closeInterviewModal()">Batal</button>
                    <button type="submit" class="iv-btn submit">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Undangan
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="acceptModal" class="iv-modal" role="dialog" aria-modal="true">
        <div class="iv-modal__box" style="max-width: 580px;">
            <div class="iv-modal__head">
                <div>
                    <h3 class="iv-modal__title">🎉 Terima Pelamar &amp; Kirim Email</h3>
                    <p class="iv-modal__sub">
                        Kirim pengumuman ke: <strong id="amName">—</strong>
                        <span id="amEmail" style="color:#7f95c9;"></span>
                    </p>
                </div>
                <button type="button" class="iv-modal__close" onclick="closeAcceptModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="acceptForm" onsubmit="return false;">
                <?php echo csrf_field(); ?>

                <div class="iv-modal__body">

                    
                    <div class="iv-field">
                        <label>Posisi</label>
                        <input type="text" id="amPosition" class="iv-input" disabled>
                    </div>

                    
                    <div class="iv-field">
                        <label>Subjek Email <span class="req">*</span></label>
                        <input type="text" id="amSubject" class="iv-input" required maxlength="200">
                    </div>

                    
                    <div class="iv-row">
                        <div class="iv-field">
                            <label>📅 Tanggal Mulai Kerja <span class="req">*</span></label>
                            <input type="date" id="amStartDate" class="iv-input" required
                                   min="<?php echo e(now()->addDay()->format('Y-m-d')); ?>"
                                   value="<?php echo e(now()->addWeek()->format('Y-m-d')); ?>">
                        </div>
                        <div class="iv-field">
                            <label>⏰ Jam Masuk <span class="req">*</span></label>
                            <input type="time" id="amStartTime" class="iv-input" required value="08:00">
                        </div>
                    </div>

                    
                    <div class="iv-field">
                        <label>📍 Lokasi Kerja <span class="req">*</span></label>
                        <input type="text" id="amWorkplace" class="iv-input" required maxlength="200"
                               value="Kantor PT Bachri Samudera Indonesia">
                    </div>

                    
                    <div class="iv-field">
                        <label>Isi Pesan <span class="req">*</span></label>
                        <textarea id="amMessage" class="iv-textarea" rows="6" required maxlength="3000"></textarea>
                        <small class="iv-hint">
                            Jelaskan sambutan, apa yang perlu disiapkan, dan hal-hal penting lainnya.
                        </small>
                    </div>

                    
                    <div class="iv-field">
                        <label>Catatan Penting <span class="opt">(opsional)</span></label>
                        <textarea id="amNotes" class="iv-textarea" rows="2" maxlength="1000"
                                  placeholder="Contoh: Bawa KTP, ijazah asli, dan pas foto 3x4 (2 lembar)."></textarea>
                    </div>

                </div>

                <div class="iv-modal__foot">
                    <button type="button" class="iv-btn ghost" onclick="closeAcceptModal()">Batal</button>
                    <button type="button" class="iv-btn submit" id="amSubmitBtn">
                        <span class="iv-btn-spinner"></span>
                        <i class="fa-solid fa-paper-plane"></i>
                        <span class="iv-btn-label">Kirim Email</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>



<script>
(function () {
    'use strict';

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                   || document.querySelector('input[name="_token"]')?.value;

    /* ============================================================
       1. RIPPLE EFFECT
       ============================================================ */
    document.querySelectorAll('.icon-btn, .hrd-tab, .chip').forEach(function (el) {
        el.addEventListener('click', function (e) {
            const rect = el.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const span = document.createElement('span');

            span.style.cssText =
                'position:absolute;border-radius:50%;background:rgba(255,255,255,.4);' +
                'transform:scale(0);animation:h-ripple .6s ease-out;pointer-events:none;' +
                'width:'  + size + 'px;' +
                'height:' + size + 'px;' +
                'left:'   + (e.clientX - rect.left - size / 2) + 'px;' +
                'top:'    + (e.clientY - rect.top  - size / 2) + 'px;';

            el.appendChild(span);
            setTimeout(function () { span.remove(); }, 600);
        });
    });

    /* ============================================================
       2. MODAL JADWAL INTERVIEW (status: baru → diproses)
       ============================================================ */
    const interviewModal  = document.getElementById('interviewModal');
    const interviewForm   = document.getElementById('interviewForm');
    const ivName          = document.getElementById('ivModalName');
    const ivPosition      = document.getElementById('ivModalPosition');

    window.openInterviewModal = function (id, nama, posisi) {
        ivName.textContent     = nama;
        ivPosition.value       = posisi;
        interviewForm.action   = '/hrd/lamaran/' + id;

        interviewModal.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    window.closeInterviewModal = function () {
        interviewModal.classList.remove('open');
        document.body.style.overflow = '';
    };

    interviewModal.addEventListener('click', function (e) {
        if (e.target === interviewModal) closeInterviewModal();
    });

    /* ============================================================
       3. MODAL TERIMA PELAMAR + KIRIM EMAIL (tahap final)
       ============================================================ */
    const acceptModal   = document.getElementById('acceptModal');
    const amName        = document.getElementById('amName');
    const amEmail       = document.getElementById('amEmail');
    const amPosition    = document.getElementById('amPosition');
    const amSubject     = document.getElementById('amSubject');
    const amStartDate   = document.getElementById('amStartDate');
    const amStartTime   = document.getElementById('amStartTime');
    const amWorkplace   = document.getElementById('amWorkplace');
    const amMessage     = document.getElementById('amMessage');
    const amNotes       = document.getElementById('amNotes');
    const amSubmitBtn   = document.getElementById('amSubmitBtn');

    let currentAppId = null;

    window.openAcceptModal = function (id, nama, email, posisi) {
        currentAppId = id;

        amName.textContent  = nama;
        amEmail.textContent = ' <' + email + '>';
        amPosition.value    = posisi;
        amSubject.value     = 'Selamat! Anda Diterima sebagai ' + posisi + ' - PT Bachri Samudera Indonesia';

        // Template pesan sambutan
        amMessage.value =
            'Selamat! Kami dengan senang hati menginformasikan bahwa Anda dinyatakan ' +
            'LOLOS dan DITERIMA untuk posisi ' + posisi + ' di PT Bachri Samudera Indonesia.\n\n' +
            'Berikut detail jadwal mulai kerja Anda. Silakan hadir tepat waktu dengan ' +
            'membawa dokumen yang diperlukan. Kami tunggu kedatangan Anda!';

        amNotes.value = '';

        acceptModal.classList.add('open');
        document.body.style.overflow = 'hidden';

        setTimeout(function () { amMessage.focus(); }, 200);
    };

    window.closeAcceptModal = function () {
        acceptModal.classList.remove('open');
        document.body.style.overflow = '';
        currentAppId = null;
    };

    acceptModal.addEventListener('click', function (e) {
        if (e.target === acceptModal) closeAcceptModal();
    });

    /* Esc untuk tutup modal manapun */
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        if (interviewModal.classList.contains('open')) closeInterviewModal();
        if (acceptModal.classList.contains('open'))    closeAcceptModal();
    });

    /* ---------- Submit modal terima via AJAX ---------- */
    if (amSubmitBtn) {
        amSubmitBtn.addEventListener('click', async function () {
            // Validasi HTML5
            const form = document.getElementById('acceptForm');
            const required = [
                amSubject, amStartDate, amStartTime, amWorkplace, amMessage
            ];

            for (const el of required) {
                if (!el.value.trim()) {
                    el.focus();
                    el.reportValidity();
                    return;
                }
            }

            // Set loading
            amSubmitBtn.classList.add('loading');
            amSubmitBtn.disabled = true;
            const label = amSubmitBtn.querySelector('.iv-btn-label');
            const oldLabel = label ? label.textContent : '';
            if (label) label.textContent = 'Mengirim...';

            const payload = {
                subject:    amSubject.value.trim(),
                message:    amMessage.value.trim(),
                start_date: amStartDate.value,
                start_time: amStartTime.value,
                workplace:  amWorkplace.value.trim(),
                notes:      amNotes.value.trim(),
            };

            try {
                const url = '/hrd/applicants/' + currentAppId + '/accept-notify';
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                const data = await res.json();

                if (data.success) {
                    // Pakai toast global kalau ada, fallback ke gcToast kita sendiri
                    if (typeof window.gcToast === 'function') {
                        window.gcToast(data.message, 'success');
                    } else {
                        showFallbackToast(data.message, 'success');
                    }

                    closeAcceptModal();
                    setTimeout(function () { location.reload(); }, 2200);
                } else {
                    if (typeof window.gcToast === 'function') {
                        window.gcToast(data.message || 'Terjadi kesalahan.', 'error');
                    } else {
                        showFallbackToast(data.message || 'Terjadi kesalahan.', 'error');
                    }
                    resetAcceptBtn();
                }
            } catch (err) {
                console.error(err);
                if (typeof window.gcToast === 'function') {
                    window.gcToast('Gagal terhubung ke server.', 'error');
                } else {
                    showFallbackToast('Gagal terhubung ke server.', 'error');
                }
                resetAcceptBtn();
            }

            function resetAcceptBtn() {
                amSubmitBtn.classList.remove('loading');
                amSubmitBtn.disabled = false;
                if (label) label.textContent = oldLabel || 'Kirim Email';
            }
        });
    }

    /* ============================================================
       4. FALLBACK TOAST (kalau gcToast global tidak tersedia)
       ============================================================ */
    function showFallbackToast(msg, type) {
        type = type || 'success';
        const bg = type === 'success'
            ? 'linear-gradient(135deg,#059669,#10b981)'
            : 'linear-gradient(135deg,#e11d48,#fb7185)';

        const el = document.createElement('div');
        el.textContent = msg;
        el.style.cssText =
            'position:fixed;top:24px;right:24px;z-index:9999;padding:14px 20px;' +
            'border-radius:12px;color:#fff;font-family:inherit;font-size:.88rem;font-weight:600;' +
            'box-shadow:0 14px 34px -10px rgba(0,0,0,.7);background:' + bg + ';' +
            'transform:translateY(-20px);opacity:0;transition:all .35s cubic-bezier(.2,.7,.2,1);' +
            'max-width:400px;line-height:1.4;';
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
    }
})();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pt-bachri-company-profile\resources\views/hrd/applicants/index.blade.php ENDPATH**/ ?>