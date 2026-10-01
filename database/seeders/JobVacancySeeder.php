<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;

class JobVacancySeeder extends Seeder
{
    public function run(): void
    {
        JobVacancy::updateOrCreate(['slug' => 'staf-administrasi'], [
            'title'           => 'Staf Administrasi',
            'department'      => 'Operasional',
            'location'        => 'Tangerang Selatan',
            'employment_type' => 'Full Time',
            'salary_range'    => 'Sesuai UMR + tunjangan',
            'description'     => "Mendukung kegiatan administrasi harian perusahaan, mulai dari pengarsipan dokumen, pembuatan laporan, hingga koordinasi dengan tim lapangan.",
            'requirements'    => "Pendidikan minimal D3/S1 semua jurusan\nMahir Microsoft Office (Word, Excel)\nTeliti, rapi, dan bertanggung jawab\nBersedia ditempatkan di Pamulang, Tangerang Selatan",
            'deadline'        => now()->addMonth()->toDateString(),
            'is_active'       => true,
        ]);
    }
}