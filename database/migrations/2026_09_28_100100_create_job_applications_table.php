<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_vacancy_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20);
            $table->text('cover_letter')->nullable();
            $table->string('cv_path');
            $table->string('status')->default('baru');
            $table->timestamps();

            $table->unique(['job_vacancy_id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};