<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobVacancy extends Model
{
    public const EMPLOYMENT_TYPES = ['Full Time', 'Part Time', 'Kontrak', 'Magang', 'Freelance'];

   protected $fillable = [
    'title', 'slug', 'department', 'location', 'employment_type',
    'salary_range', 'image_path', 'description', 'requirements', 'deadline', 'is_active',
];
    

    protected function casts(): array
    {
        return [
            'deadline'  => 'date',
            'is_active' => 'boolean',
        ];
    }

    // URL lowongan memakai slug (mis. /karir/staf-administrasi)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    // Lowongan aktif dan belum melewati batas waktu
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q) {
                $q->whereNull('deadline')->orWhereDate('deadline', '>=', now()->toDateString());
            });
    }

    public function isOpen(): bool
    {
        return $this->is_active && (! $this->deadline || $this->deadline->endOfDay()->isFuture());
    }

    // Persyaratan dipecah per baris untuk ditampilkan sebagai daftar
    public function requirementList(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', $this->requirements))));
    }

        // URL foto lowongan, atau null kalau belum diunggah
    public function imageUrl(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }
}