<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobVacancy extends Model
{
    protected $table = 'lowongan_kerja';

    public const EMPLOYMENT_TYPES = ['Full Time', 'Part Time', 'Kontrak', 'Magang', 'Freelance'];

    protected $fillable = [
        'judul', 'slug', 'departemen', 'lokasi', 'jenis_pekerjaan',
        'kisaran_gaji', 'path_gambar', 'deskripsi', 'persyaratan', 'batas_lamaran', 'aktif',
    ];

    protected function casts(): array
    {
        return [
            'batas_lamaran' => 'date',
            'aktif'         => 'boolean',
        ];
    }

    // URL lowongan memakai slug (mis. /karir/staf-administrasi)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'lowongan_kerja_id');
    }

    // Lowongan aktif dan belum melewati batas waktu
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('aktif', true)
            ->where(function (Builder $q) {
                $q->whereNull('batas_lamaran')->orWhereDate('batas_lamaran', '>=', now()->toDateString());
            });
    }

    public function isOpen(): bool
    {
        return $this->aktif && (! $this->batas_lamaran || $this->batas_lamaran->endOfDay()->isFuture());
    }

    // Persyaratan dipecah per baris untuk ditampilkan sebagai daftar
    public function requirementList(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', $this->persyaratan))));
    }

    // URL foto lowongan, atau null kalau belum diunggah
    public function imageUrl(): ?string
    {
        return $this->path_gambar ? asset('storage/' . $this->path_gambar) : null;
    }
}