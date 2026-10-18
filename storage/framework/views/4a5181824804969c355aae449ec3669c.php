

<?php $__env->startSection('title', 'Karir - PT Bachri Samudera Indonesia'); ?>

<?php $__env->startSection('content'); ?>


<style>
/* ---------- FONTS & RESET ---------- */
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

.career-page {
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.01em;
}

/* ============================================================
   HERO HEADER
   ============================================================ */

/* ---------- WRAPPER ---------- */
.career-hero-img {
    position: relative;
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #0b131e;
}

/* ---------- BACKGROUND IMAGE ---------- */
.career-hero-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    z-index: 0;
    animation: careerHeroZoom 20s ease-in-out infinite alternate;
}
@keyframes careerHeroZoom {
    0%   { transform: scale(1.03); }
    100% { transform: scale(1.10); }
}

/* ---------- OVERLAY ---------- */
.career-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg,
        rgba(11, 19, 30, 0.95) 0%,
        rgba(11, 19, 30, 0.82) 30%,
        rgba(11, 19, 30, 0.55) 65%,
        rgba(11, 19, 30, 0.35) 100%);
    z-index: 1;
}

/* ---------- INNER CONTAINER ---------- */
.career-hero-inner {
    position: relative;
    z-index: 2;
    width: 100%;
    padding: 9rem 0 5rem;
}
.career-hero-content {
    max-width: 800px;
    animation: careerFadeInUp 1s ease-out;
}
@keyframes careerFadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ---------- EYEBROW ---------- */
.career-hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 1.5rem;
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.35em;
    color: #f1c40f;
    text-transform: uppercase;
    animation: careerFadeInUp 1s ease-out 0.2s both;
}
.career-hero-eyebrow::before {
    content: '';
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #f1c40f);
}

/* ---------- TITLE ---------- */
.career-hero-title {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25em;
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 5rem;
    line-height: 1;
    letter-spacing: -0.04em;
    color: #ffffff;
    margin-bottom: 2rem;
    text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    animation: careerFadeInUp 1s ease-out 0.3s both;
}
.career-hero-title .accent {
    position: relative;
    display: inline-block;
    background: linear-gradient(135deg,
        #f1c40f 0%, #f39c12 25%, #e67e22 50%, #f1c40f 75%, #f39c12 100%);
    background-size: 300% 100%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
            background-clip: text;
    animation: careerGoldShimmer 3s ease-in-out infinite;
}
@keyframes careerGoldShimmer {
    0%, 100% { background-position: 0% 50%; }
    60%      { background-position: 100% 50%; }
}

/* ---------- SUBTITLE ---------- */
.career-hero-subtitle {
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    font-size: 1.4rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.92);
    max-width: 620px;
    margin-bottom: 2.5rem;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.4);
    animation: careerFadeInUp 1s ease-out 0.5s both;
}

/* ---------- HERO ACTIONS ---------- */
.career-hero-actions {
    display: flex;
    gap: .9rem;
    flex-wrap: wrap;
    animation: careerFadeInUp 1s ease-out 0.6s both;
}
.btn-hero-primary {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: #f1c40f;
    color: #0b131e;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    padding: .9rem 1.8rem;
    border-radius: 50px;
    text-decoration: none;
    transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 10px 30px -10px rgba(241,196,15,.5);
}
.btn-hero-primary:hover {
    transform: translateY(-3px) scale(1.02);
    color: #0b131e;
    box-shadow: 0 15px 40px -10px rgba(241,196,15,.7);
}
.btn-hero-secondary {
    border: 1.5px solid rgba(255,255,255,.5);
    color: #fff;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    padding: .9rem 1.8rem;
    border-radius: 50px;
    text-decoration: none;
    transition: border-color .2s, background .2s;
}
.btn-hero-secondary:hover {
    border-color: #fff;
    background: rgba(255,255,255,.08);
    color: #fff;
}

/* ---------- SCROLL INDICATOR ---------- */
.career-hero-scroll {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    color: rgba(255, 255, 255, 0.6);
    font-family: 'Outfit', sans-serif;
    font-size: 0.65rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    animation: careerFadeInUp 1s ease-out 1.2s both;
}
.career-hero-scroll .line {
    width: 1px;
    height: 40px;
    background: linear-gradient(180deg, rgba(241, 196, 15, 0.8), transparent);
    position: relative;
    overflow: hidden;
}
.career-hero-scroll .line::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 15px;
    background: #f1c40f;
    animation: careerScrollLine 2s ease-in-out infinite;
}
@keyframes careerScrollLine {
    0%   { top: -15px; }
    100% { top: 40px; }
}

/* ---------- STATS ---------- */
.career-stats {
    display: flex;
    gap: 2.5rem;
    flex-wrap: wrap;
    margin-top: 2.5rem;
    animation: careerFadeInUp 1s ease-out 0.7s both;
}
.career-stat strong {
    display: block;
    font-family: 'Outfit', sans-serif;
    font-size: 1.8rem;
    font-weight: 800;
    color: #fff;
}
.career-stat span {
    font-family: 'Inter', sans-serif;
    font-size: .8rem;
    color: rgba(255,255,255,.65);
}

/* ============================================================
   DAFTAR LOWONGAN
   ============================================================ */

/* ---------- WRAPPER ---------- */
.career-wrap {
    position: relative;
    padding: 6rem 0;
    overflow: hidden;
    background-image: url('<?php echo e(asset('images/bgvisimisi.jpeg')); ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
.career-wrap::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(11, 19, 30, 0.82);
    z-index: 1;
    pointer-events: none;
}
.career-wrap-inner {
    max-width: 1120px;
    margin: 0 auto;
    padding: 0 1.5rem;
    position: relative;
    z-index: 2;
}

/* ---------- SECTION HEADER ---------- */
.career-section-label {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    font-size: .75rem;
    letter-spacing: .3em;
    color: #f1c40f;
    text-transform: uppercase;
}
.career-section-label::before {
    content: '';
    width: 40px;
    height: 1px;
    background: linear-gradient(90deg, transparent, #f1c40f);
}
.career-section-heading {
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 2.2rem;
    color: #ffffff;
    margin-top: .75rem;
    margin-bottom: .5rem;
    text-shadow: 0 2px 15px rgba(0,0,0,.6);
}

/* ---------- TOOLBAR ---------- */
.career-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2.5rem;
    padding-bottom: 1.75rem;
    border-bottom: 1px solid rgba(255,255,255,.15);
}
.career-count {
    color: #fff;
    font-family: 'Inter', sans-serif;
    font-size: .85rem;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.2);
    padding: .4rem .9rem;
    border-radius: 50px;
    backdrop-filter: blur(6px);
}

/* ---------- JOB GRID ---------- */
.job-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.75rem;
}

/* ---------- JOB CARD ---------- */
.job-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #eef0f3;
    border-radius: 20px;
    overflow: hidden;
    color: inherit;
    text-decoration: none;
    transition: all .4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 20px 45px -18px rgba(0,0,0,.55);
}
.job-card:hover {
    border-color: rgba(212,160,23,.4);
    transform: translateY(-7px);
    box-shadow: 0 30px 60px -18px rgba(0,0,0,.65);
    color: inherit;
}
.job-card-img {
    width: 100%;
    aspect-ratio: 16/10;
    object-fit: cover;
}
.job-card-img-placeholder {
    width: 100%;
    aspect-ratio: 16/10;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.4rem;
    background: linear-gradient(135deg, rgba(212,160,23,.14), rgba(11,19,30,.04));
}
.job-card-body {
    padding: 1.6rem;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.job-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: .75rem;
}
.job-card h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 1.15rem;
    font-weight: 700;
    margin: 0 0 .4rem;
    color: #0b131e;
    line-height: 1.35;
}
.job-card .dept {
    font-size: .82rem;
    color: #64748b;
    margin-bottom: .9rem;
}

/* ---------- JOB META TAGS ---------- */
.job-meta {
    display: flex;
    flex-wrap: wrap;
    gap: .45rem;
    margin-top: auto;
}
.job-tag {
    font-size: .74rem;
    padding: .28rem .7rem;
    border-radius: 50px;
    font-weight: 600;
    white-space: nowrap;
    background: rgba(212,160,23,.12);
    color: #a3720a;
}
.job-tag.muted {
    background: #f1f4f8;
    color: #475569;
}
.job-tag.urgent {
    background: #fee2e2;
    color: #dc2626;
}

/* ---------- GO ARROW ---------- */
.job-card .go {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: #0b131e;
    background: linear-gradient(135deg, #f1c40f, #e67e22);
    box-shadow: 0 8px 18px -6px rgba(212,160,23,.55);
    transition: transform .3s;
}
.job-card:hover .go {
    transform: translateX(3px) rotate(-8deg);
}

/* ---------- EMPTY STATE ---------- */
.career-empty {
    text-align: center;
    padding: 4rem 1.5rem;
    border: 1.5px dashed rgba(241,196,15,.5);
    border-radius: 20px;
    color: rgba(255,255,255,.85);
    background: rgba(255,255,255,.06);
    backdrop-filter: blur(6px);
}
.career-empty h3 {
    color: #fff;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    margin-bottom: .5rem;
}
.career-empty a {
    color: #f1c40f;
    font-weight: 600;
    text-decoration: none;
}
.career-empty a:hover { text-decoration: underline; }

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 991.98px) {
    .career-hero-img          { min-height: 70vh; }
    .career-hero-title        { font-size: 3.5rem; }
    .career-hero-subtitle     { font-size: 1.2rem; }
    .career-hero-inner        { padding: 7rem 0 4rem; }
    .career-section-heading   { font-size: 2rem; }
    .career-wrap              { background-attachment: scroll; }
}

@media (max-width: 640px) {
    .career-hero-img          { min-height: 65vh; }
    .career-hero-title        { font-size: 2.5rem; gap: 0.15em; }
    .career-hero-subtitle     { font-size: 1rem; }
    .career-hero-eyebrow      { font-size: 0.7rem; }
    .career-hero-inner        { padding: 6rem 0 3.5rem; }
    .career-hero-scroll       { display: none; }
    .career-hero-actions      { flex-direction: column; }
    .btn-hero-primary,
    .btn-hero-secondary       { justify-content: center; text-align: center; }
    .career-stats             { gap: 1.5rem; }
    .career-wrap              { padding: 3.5rem 0; }
    .career-toolbar           { flex-direction: column; align-items: flex-start; }
    .job-grid                 { grid-template-columns: 1fr; }
}
</style>



<div class="career-page">

    
    <section class="career-hero-img">

        <img src="<?php echo e(asset('images/karir.jpeg')); ?>"
             alt="Karir PT Bachri Samudera Indonesia"
             class="career-hero-bg">

        <div class="career-hero-overlay"></div>

        <div class="career-hero-inner">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="career-hero-content">

                    <div class="career-hero-eyebrow">
                        PT Bachri Samudera Indonesia
                    </div>

                    <h1 class="career-hero-title">
                        <span>Bergabung</span>
                        <span class="accent">Bersama Kami</span>
                    </h1>

                    <p class="career-hero-subtitle">
                        Kami mencari orang-orang berdedikasi untuk tumbuh bersama kami.<br>
                        Temukan posisi yang sesuai dengan Anda dan jadi bagian dari tim yang
                        membangun solusi kreatif di bidang konstruksi, desain, dan manajemen acara.
                    </p>

                    <div class="career-hero-actions">
                        <a href="#lowongan" class="btn-hero-primary">Lihat Lowongan &rarr;</a>
                        <a href="<?php echo e(url('/contact')); ?>" class="btn-hero-secondary">Hubungi Kami</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="career-hero-scroll">
            <span>Scroll</span>
            <div class="line"></div>
        </div>

    </section>

    
    <section class="career-wrap" id="lowongan">
        <div class="career-wrap-inner">

            <div class="career-toolbar">
                <div>
                    <span class="career-section-label">Karir</span>
                    <h2 class="career-section-heading">Lowongan Tersedia</h2>
                </div>
                <?php if($vacancies->count()): ?>
                    <span class="career-count">
                        Menampilkan <?php echo e($vacancies->count()); ?> lowongan aktif
                    </span>
                <?php endif; ?>
            </div>

            <?php if($vacancies->count()): ?>
                <div class="job-grid">
                    <?php $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacancy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isUrgent = $vacancy->batas_lamaran
                                && now()->diffInDays($vacancy->batas_lamaran, false) <= 7
                                && now()->diffInDays($vacancy->batas_lamaran, false) >= 0;
                        ?>

                        <a href="<?php echo e(route('careers.show', $vacancy)); ?>" class="job-card">

                            <?php if($vacancy->imageUrl()): ?>
                                <img src="<?php echo e($vacancy->imageUrl()); ?>"
                                     alt="<?php echo e($vacancy->judul); ?>"
                                     class="job-card-img">
                            <?php else: ?>
                                <div class="job-card-img-placeholder">💼</div>
                            <?php endif; ?>

                            <div class="job-card-body">
                                <div class="job-card-top">
                                    <div>
                                        <h2><?php echo e($vacancy->judul); ?></h2>
                                        <?php if($vacancy->departemen): ?>
                                            <div class="dept"><?php echo e($vacancy->departemen); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <span class="go">&rarr;</span>
                                </div>

                                <div class="job-meta">
                                    <span class="job-tag"><?php echo e($vacancy->jenis_pekerjaan); ?></span>
                                    <span class="job-tag muted">📍 <?php echo e($vacancy->lokasi); ?></span>

                                    <?php if($isUrgent): ?>
                                        <span class="job-tag urgent">⏰ Segera ditutup</span>
                                    <?php elseif($vacancy->batas_lamaran): ?>
                                        <span class="job-tag muted">
                                            Batas: <?php echo e($vacancy->batas_lamaran->translatedFormat('d M Y')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="career-empty">
                    <h3>Belum ada lowongan yang dibuka</h3>
                    <p class="mb-0">
                        Silakan cek kembali nanti, atau kirim pertanyaan lewat halaman
                        <a href="<?php echo e(url('/contact')); ?>">Hubungi Kami</a>.
                    </p>
                </div>
            <?php endif; ?>

        </div>
    </section>

</div>

<?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pt-bachri-company-profile\resources\views/pages/careers/index.blade.php ENDPATH**/ ?>