<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    protected $table = 'lamaran_kerja';

    public const STATUSES = [
        'baru'      => 'Baru',
        'diproses'  => 'Diproses',
        'wawancara' => 'Wawancara',
        'diterima'  => 'Diterima',
        'ditolak'   => 'Ditolak',
    ];

    // Status yang masih berjalan di proses seleksi
    public const ACTIVE = ['baru', 'diproses', 'wawancara'];

    protected $fillable = [
        'lowongan_kerja_id',
        'nama',
        'email',
        'telepon',
        'surat_lamaran',
        'path_cv',
        'status',

        // Jadwal interview
        'interview_date',
        'interview_time',
        'interview_location',
        'interview_note',

        // ✅ Field baru — untuk fitur "Terima & Kirim Email"
        'email_sent_at',
        'email_type',
        'start_date',
        'start_time',
        'workplace',
        'onboarding_notes',
    ];

    protected $casts = [
        'interview_date' => 'date',
        'interview_time' => 'string',      // disimpan sebagai TIME, bukan datetime
        'email_sent_at'  => 'datetime',
        'start_date'     => 'date',
        'start_time'     => 'string',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class, 'lowongan_kerja_id');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', self::ACTIVE);
    }

    public function stageLabel(): string
    {
        return match ($this->status) {
            'baru'                  => 'Kontak Masuk',
            'diproses'              => 'Interview / Tes',
            'wawancara', 'diterima' => 'Tahap Akhir',
            default                 => '-',
        };
    }

    public function finalStatusLabel(): string
    {
        return match ($this->status) {
            'diterima' => 'Diterima',
            'ditolak'  => 'Ditolak',
            default    => 'Aktif Seleksi',
        };
    }

    public function getInterviewScheduleLabelAttribute(): ?string
    {
        if (! $this->interview_date || ! $this->interview_time) {
            return null;
        }

        return $this->interview_date->translatedFormat('l, d M Y')
             . ' · '
             . substr($this->interview_time, 0, 5) . ' WIB';
    }
}