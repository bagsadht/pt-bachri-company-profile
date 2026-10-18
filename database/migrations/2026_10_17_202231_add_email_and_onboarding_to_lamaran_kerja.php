<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lamaran_kerja', function (Blueprint $table) {
            if (!Schema::hasColumn('lamaran_kerja', 'email_sent_at')) {
                $table->timestamp('email_sent_at')->nullable()->after('status');
                $table->string('email_type')->nullable()->after('email_sent_at');
                $table->date('start_date')->nullable()->after('email_type');
                $table->time('start_time')->nullable()->after('start_date');
                $table->string('workplace')->nullable()->after('start_time');
                $table->text('onboarding_notes')->nullable()->after('workplace');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lamaran_kerja', function (Blueprint $table) {
            $table->dropColumn([
                'email_sent_at', 'email_type', 'start_date', 
                'start_time', 'workplace', 'onboarding_notes'
            ]);
        });
    }
};