
<?php $__env->startSection('title', 'Rekap & Analisis'); ?>

<?php $__env->startSection('content'); ?>


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

/* ---------- GLASS CARD ---------- */
.glass-card {
    padding: 1.75rem;
    border-radius: 20px;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 24px 60px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.08);
    margin-bottom: 1.5rem;
    animation: h-enter .5s .05s cubic-bezier(.2,.7,.2,1) both;
}
.glass-card h3 {
    margin: 0;
    font-size: 1.15rem;
    font-weight: 700;
    color: #f1f5f9;
    letter-spacing: -.01em;
}

/* ---------- BUTTON ---------- */
.btn-primary {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .55rem;
    height: 46px;
    padding: 0 1.4rem;
    font: inherit;
    font-size: .9rem;
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

.btn-ghost {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    height: 46px;
    padding: 0 1.2rem;
    font: inherit;
    font-size: .88rem;
    font-weight: 600;
    color: #a9b8d8;
    text-decoration: none;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 12px;
    cursor: pointer;
    transition: all .18s;
}
.btn-ghost:hover {
    color: #fff;
    background: rgba(255,255,255,.08);
    border-color: rgba(255,255,255,.22);
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

/* ---------- FILTER FORM ---------- */
.filter-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    align-items: end;
}
.filter-label {
    display: block;
    margin-bottom: .55rem;
    font-size: .8rem;
    font-weight: 700;
    color: var(--h-soft);
    text-transform: uppercase;
    letter-spacing: .05em;
}
.filter-input {
    width: 100%;
    height: 46px;
    padding: 0 1rem;
    font: inherit;
    font-size: .9rem;
    color: #fff;
    background: rgba(7,12,28,.55);
    border: 1.5px solid var(--h-line);
    border-radius: 12px;
    outline: none;
    transition: all .2s;
}
.filter-input:hover { border-color: rgba(255,255,255,.22); }
.filter-input:focus {
    border-color: #60a5fa;
    background: rgba(7,12,28,.85);
    box-shadow: 0 0 0 4px rgba(59,130,246,.18);
}
.filter-input option { background: #0e1a3a; color: #e8eeff; }

.filter-actions { display: flex; gap: .65rem; }
.filter-actions .btn-primary,
.filter-actions .btn-ghost { flex: 1; }

.filter-note {
    margin-top: 1.25rem;
    padding-top: 1.25rem;
    border-top: 1px dashed var(--h-line);
    font-size: .85rem;
    color: var(--h-muted);
    display: flex;
    gap: .6rem;
    align-items: flex-start;
}
.filter-note i { color: #60a5fa; margin-top: 3px; }

/* ---------- STAT CARDS ---------- */
.stat-card {
    position: relative;
    height: 100%;
    padding: 1.6rem 1.75rem;
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
.stat-num {
    font-size: 2.4rem;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -.04em;
    color: #f8fafc;
}
.stat-label {
    margin-top: .8rem;
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--h-soft);
}

/* ---------- SECTION HEAD ---------- */
.section-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: .75rem;
    margin-bottom: 1.4rem;
}
.section-head h3 i { color: #60a5fa; margin-right: .6rem; }
.section-meta { font-size: .85rem; color: var(--h-soft); font-weight: 500; }

/* ---------- TABLE ---------- */
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
    padding: 1.05rem 1rem;
    font-size: .88rem;
    color: #cbd5e1;
    vertical-align: middle;
}

/* ---------- FILE ICON ---------- */
.file-icon {
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    font-size: 1.15rem;
    color: #6ee7b7;
    background: rgba(16,185,129,.12);
    border: 1px solid rgba(16,185,129,.3);
    border-radius: 12px;
}

/* ---------- AVATAR ---------- */
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
.cell-user { display: flex; align-items: center; gap: .9rem; }
.user-name  { font-size: .92rem; font-weight: 700; color: #f1f5f9; }
.user-mail  { margin-top: 2px; font-size: .75rem; color: var(--h-soft); }

/* ---------- TAG & PILL ---------- */
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
.pill.blue   { color: #a5c4ff; background: rgba(96,165,250,.14);  border: 1px solid rgba(96,165,250,.3); }

/* ---------- BUTTONS: SMALL ---------- */
.btn-sm {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    height: 38px;
    padding: 0 1rem;
    font: inherit;
    font-size: .82rem;
    font-weight: 600;
    color: #a9b8d8;
    text-decoration: none;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 10px;
    cursor: pointer;
    transition: all .18s;
    white-space: nowrap;
}
.btn-sm:hover {
    color: #fff;
    background: rgba(96,165,250,.16);
    border-color: rgba(96,165,250,.42);
    transform: translateY(-2px);
    box-shadow: 0 8px 18px -8px rgba(96,165,250,.7);
}
.btn-sm.danger:hover {
    color: #fda4af;
    background: rgba(251,113,133,.16);
    border-color: rgba(251,113,133,.42);
    box-shadow: 0 8px 18px -8px rgba(251,113,133,.7);
}
.btn-sm.primary {
    color: #fff;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    border-color: transparent;
    box-shadow: 0 10px 22px -10px rgba(79,70,229,.9);
}
.btn-sm.primary:hover { filter: brightness(1.1); }

/* ---------- EMPTY ---------- */
.empty { padding: 4rem 1rem; text-align: center; color: var(--h-muted); }
.empty i { display: block; font-size: 2.5rem; margin-bottom: .85rem; opacity: .35; }
.empty strong { display: block; font-size: 1rem; font-weight: 700; color: #cbd5e1; margin-bottom: .35rem; }

/* ---------- CHART ---------- */
.chart-box { padding: 1.5rem 1rem .5rem; position: relative; height: 480px; }

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
@media (max-width: 992px) {
    .filter-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .hrd-page    { padding: 1.25rem; border-radius: 18px; }
    .hrd-title   { font-size: 1.4rem; }
    .filter-grid { grid-template-columns: 1fr; }
    .stat-num    { font-size: 2rem; }
}
</style>



<div class="hrd-page">

    <span class="hrd-blob b1" aria-hidden="true"></span>
    <span class="hrd-blob b2" aria-hidden="true"></span>
    <span class="hrd-blob b3" aria-hidden="true"></span>

    
    <div class="hrd-head">
        <div>
            <h1 class="hrd-title">Rekap &amp; Laporan Rekrutmen</h1>
            <p class="hrd-sub">Ringkasan performa rekrutmen dan rekapitulasi data seluruh pelamar.</p>
        </div>

        <a href="<?php echo e(route('hrd.report.export', request()->query())); ?>" class="btn-primary">
            <i class="fa-solid fa-file-excel"></i> Cetak Laporan (Excel)
        </a>
    </div>

    
    <div class="glass-card">
        <form method="GET">
            <div class="filter-grid">

                <div>
                    <label class="filter-label">Dari Tanggal</label>
                    <input type="date" name="dari" value="<?php echo e(request('dari')); ?>" class="filter-input">
                </div>

                <div>
                    <label class="filter-label">Sampai Tanggal</label>
                    <input type="date" name="sampai" value="<?php echo e(request('sampai')); ?>" class="filter-input">
                </div>

                <div>
                    <label class="filter-label">Status Akhir</label>
                    <select name="status" class="filter-input">
                        <option value="">Semua Status</option>
                        <option value="aktif"    <?php if(request('status') === 'aktif'): echo 'selected'; endif; ?>>Aktif Seleksi</option>
                        <option value="diterima" <?php if(request('status') === 'diterima'): echo 'selected'; endif; ?>>Diterima</option>
                        <option value="ditolak"  <?php if(request('status') === 'ditolak'): echo 'selected'; endif; ?>>Ditolak</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-filter"></i> Terapkan
                    </button>
                    <a href="<?php echo e(route('hrd.report.index')); ?>" class="btn-ghost">Reset</a>
                </div>

            </div>

            <div class="filter-note">
                <i class="fa-solid fa-circle-info"></i>
                <span>Filter ini juga dipakai saat Cetak Laporan. Setiap cetak membuat file Excel baru dari data terkini.</span>
            </div>
        </form>
    </div>

    
    <div class="row g-4 mb-4">

        <div class="col-6 col-lg-3">
            <div class="stat-card" style="--accent:#60a5fa;">
                <div class="stat-num"><?php echo e($summary['total']); ?></div>
                <div class="stat-label">Total Pelamar</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="stat-card" style="--accent:#f59e0b;">
                <div class="stat-num"><?php echo e($summary['aktif']); ?></div>
                <div class="stat-label">Aktif Seleksi</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="stat-card" style="--accent:#34d399;">
                <div class="stat-num"><?php echo e($summary['diterima']); ?></div>
                <div class="stat-label">Diterima</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="stat-card" style="--accent:#fb7185;">
                <div class="stat-num"><?php echo e($summary['ditolak']); ?></div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>

    </div>

    
    <div class="glass-card">
        <div class="section-head">
            <h3>Distribusi Hasil Rekrutmen</h3>
        </div>
        <div class="chart-box">
            <canvas id="donut"></canvas>
        </div>
    </div>

    
    <div class="glass-card">
        <div class="section-head">
            <h3><i class="fa-solid fa-clock-rotate-left"></i>Riwayat Laporan</h3>
            <span class="section-meta">15 laporan terakhir</span>
        </div>

        <div class="table-responsive">
            <table class="dark-table">
                <thead>
                    <tr>
                        <th>Nama File</th>
                        <th>Dicetak Pada</th>
                        <th>Ukuran</th>
                        <th class="r">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="cell-user">
                                
                                <div class="file-icon"><i class="fa-solid fa-file-excel"></i></div>
                                <div class="user-name"><?php echo e($f['name']); ?></div>
                            </div>
                        </td>
                        <td>
                            <div class="user-name"><?php echo e($f['time']->format('d M Y')); ?></div>
                            <div class="user-mail"><?php echo e($f['time']->format('H:i')); ?> WIB</div>
                        </td>
                        <td><?php echo e(number_format($f['size'] / 1024, 1)); ?> KB</td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:.5rem;">
                                <a href="<?php echo e(route('hrd.report.download', $f['name'])); ?>" class="btn-sm">
                                    <i class="fa-solid fa-download"></i> Unduh
                                </a>
                                <form action="<?php echo e(route('hrd.report.destroy', $f['name'])); ?>"
                                      method="POST"
                                      style="display:inline;margin:0;"
                                      data-confirm="Hapus arsip laporan ini?"
                                      data-confirm-type="danger"
                                      data-confirm-text="Ya, Hapus">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-sm danger" title="Hapus">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" style="border:0;">
                            <div class="empty">
                                <i class="fa-solid fa-folder-open"></i>
                                <strong>Belum Ada Laporan</strong>
                                Belum ada laporan yang dicetak.
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="glass-card" style="margin-bottom:0;">
        <div class="section-head">
            <h3><i class="fa-solid fa-user-group"></i>Semua Daftar Pelamar</h3>
            <span class="pill blue">
                <span class="dot"></span> <?php echo e($summary['total']); ?> Orang
            </span>
        </div>

        <div class="table-responsive">
            <table class="dark-table">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Pelamar</th>
                        <th>Posisi Dilamar</th>
                        <th>Tahap Terakhir</th>
                        <th>Status Akhir</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color:var(--h-soft);font-weight:700;"><?php echo e($loop->iteration); ?></td>

                        <td>
                            <div class="cell-user">
                                <div class="avatar"><?php echo e(strtoupper(substr($a->nama, 0, 1))); ?></div>
                                <div class="user-name"><?php echo e($a->nama); ?></div>
                            </div>
                        </td>

                        
                        <td><span class="tag"><?php echo e($a->vacancy->judul ?? '-'); ?></span></td>
                        <td><?php echo e($a->stageLabel()); ?></td>

                        <td>
                            <?php if($a->status === 'diterima'): ?>
                                <span class="pill green"><span class="dot"></span> Diterima</span>
                            <?php elseif($a->status === 'ditolak'): ?>
                                <span class="pill red"><span class="dot"></span> Ditolak</span>
                            <?php else: ?>
                                <span class="pill orange"><span class="dot"></span> Aktif Seleksi</span>
                            <?php endif; ?>
                        </td>

                        <td><?php echo e($a->created_at->format('d M Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="border:0;">
                            <div class="empty">
                                <i class="fa-solid fa-user-group"></i>
                                <strong>Tidak Ada Data Pelamar</strong>
                                Tidak ada data pelamar untuk filter ini.
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>



<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- 1. Donut Chart ---------- */
    const vals = [<?php echo e($summary['aktif']); ?>, <?php echo e($summary['diterima']); ?>, <?php echo e($summary['ditolak']); ?>];
    const sum  = vals.reduce((a, b) => a + b, 0) || 1;
    const el   = document.getElementById('donut');

    if (el) {
        new Chart(el, {
            type: 'doughnut',
            data: {
                labels: ['Aktif Seleksi', 'Diterima', 'Ditolak'],
                datasets: [{
                    data: vals,
                    backgroundColor: ['#f59e0b', '#10b981', '#fb7185'],
                    borderWidth: 0,
                    hoverOffset: 12
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '58%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 18,
                            boxHeight: 18,
                            padding: 26,
                            color: '#cbd5e1',
                            font: { size: 15, weight: '700', family: 'Plus Jakarta Sans' }
                        }
                    },
                    tooltip: {
                        padding: 14,
                        backgroundColor: 'rgba(11,18,34,.95)',
                        borderColor: 'rgba(96,165,250,.4)',
                        borderWidth: 1,
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        titleFont: { size: 14, weight: '700' },
                        bodyFont: { size: 14 }
                    }
                }
            },
            plugins: [{
                id: 'pct',
                afterDatasetsDraw(c) {
                    c.getDatasetMeta(0).data.forEach((arc, i) => {
                        if (!vals[i]) return;
                        const p = arc.tooltipPosition();
                        const x = c.ctx;
                        x.save();
                        x.fillStyle   = '#fff';
                        x.font        = 'bold 20px Plus Jakarta Sans';
                        x.textAlign   = 'center';
                        x.textBaseline = 'middle';
                        x.fillText((vals[i] / sum * 100).toFixed(1) + '%', p.x, p.y);
                        x.restore();
                    });
                }
            }]
        });
    }

    /* ---------- 2. Ripple pada semua tombol ---------- */
    document.querySelectorAll('.btn-primary, .btn-ghost, .btn-sm').forEach(function (el) {
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
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pt-bachri-company-profile\resources\views/hrd/report/index.blade.php ENDPATH**/ ?>