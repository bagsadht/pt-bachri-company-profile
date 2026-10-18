<?php $__env->startSection('title', 'Daftar Lowongan'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <h1 class="page-title">Daftar Lowongan</h1>
        <p class="page-sub">Seluruh lowongan yang dikelola Admin (hanya untuk dilihat).</p>
    </div>

    <form method="GET" action="<?php echo e(route('hrd.vacancies.index')); ?>" class="d-flex gap-2">
        <input type="text" name="q" value="<?php echo e(request('q')); ?>"
               class="form-control form-control-sm"
               placeholder="Cari posisi / lokasi...">
        <button type="submit" class="btn-s green">
            <i class="fa-solid fa-magnifying-glass"></i> Cari
        </button>
        <?php if(request('q')): ?>
            <a href="<?php echo e(route('hrd.vacancies.index')); ?>" class="btn-s gray">Reset</a>
        <?php endif; ?>
    </form>
</div>

<div class="box">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Posisi</th>
                    <th>Departemen</th>
                    <th>Lokasi</th>
                    <th>Tipe</th>
                    <th>Batas Waktu</th>
                    <th>Status</th>
                    <th class="text-center">Pelamar</th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="ps-4 fw-semibold"><?php echo e($v->judul); ?></td>
                    <td><?php echo e($v->departemen ?? '-'); ?></td>
                    <td><?php echo e($v->lokasi); ?></td>
                    <td><span class="tag"><?php echo e($v->jenis_pekerjaan); ?></span></td>
                    <td><?php echo e($v->batas_lamaran?->format('d M Y') ?? '-'); ?></td>
                    <td>
                        <?php if($v->isOpen()): ?>
                            <span class="pill green">Aktif</span>
                        <?php elseif(! $v->aktif): ?>
                            <span class="pill gray">Nonaktif</span>
                        <?php else: ?>
                            <span class="pill orange">Kedaluwarsa</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo e(route('hrd.applicants.index', ['q' => $v->judul])); ?>" class="btn-s">
                            <i class="fa-solid fa-user-group"></i> <?php echo e($v->applications_count); ?>

                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        Belum ada lowongan.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3"><?php echo e($vacancies->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pt-bachri-company-profile\resources\views/hrd/vacancies/index.blade.php ENDPATH**/ ?>