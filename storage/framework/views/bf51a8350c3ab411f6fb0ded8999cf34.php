<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan Interview & Tes</title>
</head>
<body style="margin:0;padding:0;background:#0b1222;font-family:Arial,Helvetica,sans-serif;color:#e8eeff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#0b1222;padding:32px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                       style="max-width:600px;background:#131c33;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,.08);">

                    
                    <tr>
                        <td style="padding:32px;background:linear-gradient(135deg,#0d6efd,#4f46e5);text-align:center;">
                            <h1 style="margin:0;color:#fff;font-size:22px;font-weight:800;letter-spacing:.5px;">
                                PT BACHRI SAMUDERA INDONESIA
                            </h1>
                            <p style="margin:6px 0 0;color:#cbd5e1;font-size:13px;">
                                Rekrutmen &amp; Seleksi Karyawan
                            </p>
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="padding:36px 32px;">
                            <h2 style="margin:0 0 8px;font-size:18px;color:#fff;">
                                Halo, <?php echo e($nama); ?> 👋
                            </h2>
                            <p style="margin:0 0 20px;font-size:14px;line-height:1.7;color:#cbd5e1;">
                                Selamat! Lamaran Anda untuk posisi
                                <strong style="color:#a5c4ff;"><?php echo e($posisi); ?></strong>
                                telah <strong>lolos tahap screening awal</strong> dan kami mengundang Anda untuk
                                mengikuti tahap <strong>Interview &amp; Tes</strong>.
                            </p>

                            
                            <div style="background:rgba(96,165,250,.08);border:1px solid rgba(96,165,250,.25);
                                        border-radius:12px;padding:20px;margin-bottom:24px;">
                                <p style="margin:0 0 10px;font-size:13px;font-weight:700;color:#93c5fd;
                                          text-transform:uppercase;letter-spacing:.5px;">
                                    Detail Undangan
                                </p>
                                <table cellpadding="0" cellspacing="0" style="width:100%;font-size:13.5px;color:#cbd5e1;">
                                    <tr>
                                        <td style="padding:6px 0;width:130px;color:#94a3c4;vertical-align:top;">Posisi</td>
                                        <td style="padding:6px 0;"><strong style="color:#fff;"><?php echo e($posisi); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 0;color:#94a3c4;vertical-align:top;">Tahap</td>
                                        <td style="padding:6px 0;color:#fff;">Interview &amp; Tes</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 0;color:#94a3c4;vertical-align:top;">Tanggal</td>
                                        <td style="padding:6px 0;"><strong style="color:#6ee7b7;"><?php echo e($tanggal); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 0;color:#94a3c4;vertical-align:top;">Waktu</td>
                                        <td style="padding:6px 0;"><strong style="color:#6ee7b7;"><?php echo e($waktu); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 0;color:#94a3c4;vertical-align:top;">Lokasi</td>
                                        <td style="padding:6px 0;color:#fff;"><?php echo e($lokasi); ?></td>
                                    </tr>
                                </table>

                                <?php if(!empty($catatan)): ?>
                                <div style="margin-top:14px;padding-top:14px;border-top:1px dashed rgba(96,165,250,.3);">
                                    <p style="margin:0 0 6px;font-size:12px;font-weight:700;color:#93c5fd;
                                              text-transform:uppercase;letter-spacing:.5px;">
                                        📌 Catatan dari HRD
                                    </p>
                                    <p style="margin:0;font-size:13.5px;color:#cbd5e1;line-height:1.7;">
                                        <?php echo nl2br(e($catatan)); ?>

                                    </p>
                                </div>
                                <?php endif; ?>
                            </div>

                            
                            <p style="margin:0 0 10px;font-size:13.5px;line-height:1.7;color:#cbd5e1;">
                                Mohon persiapkan dokumen berikut saat hari-H:
                            </p>
                            <ul style="margin:0 0 24px;padding-left:20px;font-size:13.5px;line-height:1.9;color:#cbd5e1;">
                                <li>CV cetak (1 lembar)</li>
                                <li>Fotokopi KTP &amp; KK</li>
                                <li>Fotokopi ijazah &amp; transkrip nilai terakhir</li>
                                <li>Alat tulis pribadi</li>
                            </ul>

                            
                            <div style="padding:14px 16px;background:rgba(245,158,11,.08);border-left:3px solid #f59e0b;
                                        border-radius:8px;margin-bottom:24px;">
                                <p style="margin:0;font-size:13px;color:#fcd34d;line-height:1.6;">
                                    <strong>⚠️ Penting:</strong> Mohon hadir <strong>15 menit lebih awal</strong> dari
                                    waktu yang ditentukan. Jika berhalangan, segera hubungi tim HRD.
                                </p>
                            </div>

                            <p style="margin:0;font-size:13.5px;line-height:1.7;color:#cbd5e1;">
                                Jika ada pertanyaan, silakan balas email ini atau hubungi tim HRD kami.
                                Kami tunggu kehadiran Anda. Semoga sukses! 🍀
                            </p>
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="padding:20px 32px;background:rgba(0,0,0,.2);border-top:1px solid rgba(255,255,255,.06);
                                   text-align:center;font-size:12px;color:#7f95c9;">
                            Email ini dikirim otomatis oleh sistem rekrutmen.<br>
                            © <?php echo e(date('Y')); ?> PT Bachri Samudera Indonesia. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\laragon\www\pt-bachri-company-profile\resources\views/emails/interview-invitation.blade.php ENDPATH**/ ?>