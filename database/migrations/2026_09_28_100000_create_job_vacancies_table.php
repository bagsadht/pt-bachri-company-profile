<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('departemen')->nullable();
            $table->string('lokasi');
            $table->string('jenis_pekerjaan');
            $table->string('kisaran_gaji')->nullable();
            $table->string('path_gambar')->nullable();
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->date('batas_lamaran')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan_kerja');
    }
};