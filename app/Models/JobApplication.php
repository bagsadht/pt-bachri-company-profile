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

    protected $fillable = [
        'job_vacancy_id', 'name', 'email', 'phone', 'cover_letter', 'cv_path', 'status',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id');
    }
}