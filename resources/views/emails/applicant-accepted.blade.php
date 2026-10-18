<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengumuman Diterima</title>
</head>
<body style="margin:0;padding:0;background:#0b1222;font-family:Arial,Helvetica,sans-serif;color:#e8eeff;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#0b1222;padding:40px 16px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="max-width:600px;background:#111a2f;border:1px solid rgba(255,255,255,.08);border-radius:20px;overflow:hidden;">

                {{-- Header --}}
                <tr>
                    <td style="padding:28px 32px;background:linear-gradient(135deg,#0d6efd,#4f46e5);">
                        <div style="font-size:22px;font-weight:800;color:#fff;letter-spacing:-.02em;">
                            BachriKarir
                        </div>
                        <div style="font-size:12px;color:rgba(255,255,255,.75);margin-top:4px;">
                            PT Bachri Samudera Indonesia
                        </div>
                    </td>
                </tr>

                {{-- Body --}}
                <tr>
                    <td style="padding:32px;">
                        <p style="margin:0 0 14px;font-size:15px;color:#cbd5e1;">
                            Halo <strong style="color:#fff;">{{ $application->nama }}</strong>,
                        </p>

                        <div style="font-size:14px;line-height:1.75;color:#cbd5e1;white-space:pre-line;">
                            {!! nl2br(e($bodyMessage)) !!}
                        </div>

                        {{-- Kartu detail mulai kerja --}}
                        <table cellpadding="0" cellspacing="0" width="100%"
                               style="margin-top:22px;background:#0e1a3a;border:1px solid rgba(96,165,250,.3);border-radius:12px;">
                            <tr>
                                <td style="padding:20px 22px;">
                                    <div style="color:#60a5fa;font-weight:700;margin-bottom:14px;font-size:12px;letter-spacing:.08em;text-transform:uppercase;">
                                        📋 Detail Mulai Kerja
                                    </div>

                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="padding:6px 0;font-size:13px;color:#94a3b8;width:150px;">
                                                <strong style="color:#cbd5e1;">Posisi</strong>
                                            </td>
                                            <td style="padding:6px 0;font-size:13px;color:#fff;font-weight:600;">
                                                {{ $application->vacancy->judul ?? '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:6px 0;font-size:13px;color:#94a3b8;">
                                                <strong style="color:#cbd5e1;">Departemen</strong>
                                            </td>
                                            <td style="padding:6px 0;font-size:13px;color:#fff;font-weight:600;">
                                                {{ $application->vacancy->department ?? '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:6px 0;font-size:13px;color:#94a3b8;">
                                                <strong style="color:#cbd5e1;">🗓️ Mulai Kerja</strong>
                                            </td>
                                            <td style="padding:6px 0;font-size:13px;color:#6ee7b7;font-weight:700;">
                                                {{ \Carbon\Carbon::parse($startDate)->translatedFormat('l, d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:6px 0;font-size:13px;color:#94a3b8;">
                                                <strong style="color:#cbd5e1;">⏰ Jam Masuk</strong>
                                            </td>
                                            <td style="padding:6px 0;font-size:13px;color:#fff;font-weight:600;">
                                                {{ substr($startTime, 0, 5) }} WIB
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:6px 0;font-size:13px;color:#94a3b8;">
                                                <strong style="color:#cbd5e1;">📍 Lokasi</strong>
                                            </td>
                                            <td style="padding:6px 0;font-size:13px;color:#fff;font-weight:600;">
                                                {{ $workplace }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        @if ($notes)
                            <table cellpadding="0" cellspacing="0" width="100%"
                                   style="margin-top:16px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.3);border-radius:12px;">
                                <tr>
                                    <td style="padding:16px 20px;font-size:13px;color:#fcd34d;line-height:1.7;">
                                        <strong style="color:#fbbf24;">📝 Catatan Penting</strong><br>
                                        <span style="color:#fde68a;">{{ $notes }}</span>
                                    </td>
                                </tr>
                            </table>
                        @endif

                        <p style="margin:24px 0 0;font-size:14px;line-height:1.7;color:#cbd5e1;">
                            Silakan balas email ini jika ada pertanyaan atau kendala terkait jadwal
                            mulai kerja Anda. Kami tunggu kedatangan Anda!
                        </p>

                        <p style="margin:26px 0 0;font-size:14px;color:#cbd5e1;">
                            Hormat kami,<br>
                            <strong style="color:#fff;">Tim HRD</strong><br>
                            <span style="color:#94a3b8;">PT Bachri Samudera Indonesia</span>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:20px 32px;background:#0e1a3a;border-top:1px solid rgba(255,255,255,.06);font-size:11px;color:#64748b;text-align:center;">
                        © {{ date('Y') }} PT Bachri Samudera Indonesia · Email otomatis.
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>