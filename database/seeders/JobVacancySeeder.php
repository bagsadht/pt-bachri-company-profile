<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;

class JobVacancySeeder extends Seeder
{
    public function run(): void
    {
        JobVacancy::updateOrCreate(['slug' => 'staf-administrasi'], [
            'judul'           => 'Staf Administrasi',
            'departemen'      => 'Administrasi',
            'lokasi'          => 'Jakarta',
            'jenis_pekerjaan' => 'Full Time',
            'kisaran_gaji'    => 'Rp 4.000.000 - Rp 5.500.000',
            'path_gambar'     => null,
            'deskripsi'       => 'Mengelola dokumen, arsip, dan administrasi harian perusahaan.',
            'persyaratan'     => "Pendidikan minimal D3/S1 semua jurusan\nMahir Microsoft Office\nTeliti dan komunikatif\nMaksimal usia 30 tahun",
            'batas_lamaran'   => now()->addMonths(2)->toDateString(),
            'aktif'           => true,
        ]);
    }
}