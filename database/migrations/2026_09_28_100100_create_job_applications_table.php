<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_kerja_id')->constrained('lowongan_kerja')->cascadeOnDelete();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon', 20);
            $table->text('surat_lamaran')->nullable();
            $table->string('path_cv');
            $table->string('status')->default('baru');
            $table->timestamps();

            $table->unique(['lowongan_kerja_id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran_kerja');
    }
};