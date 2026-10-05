<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
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
        'job_vacancy_id', 'name', 'email', 'phone', 'cover_letter', 'cv_path', 'status',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', self::ACTIVE);
    }

    // Label tahap seleksi terakhir untuk tabel & laporan
    public function stageLabel(): string
    {
        return match ($this->status) {
            'baru'                  => 'Kontak Masuk',
            'diproses'              => 'Interview / Tes',
            'wawancara', 'diterima' => 'Tahap Akhir',
            default                 => '-',
        };
    }

    // Status akhir yang disederhanakan: Aktif Seleksi / Diterima / Ditolak
    public function finalStatusLabel(): string
    {
        return match ($this->status) {
            'diterima' => 'Diterima',
            'ditolak'  => 'Ditolak',
            default    => 'Aktif Seleksi',
        };
    }
}