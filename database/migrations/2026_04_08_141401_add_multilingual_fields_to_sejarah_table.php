<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2026_04_08_141401_add_multilingual_fields_to_sejarah_table.php
     */
    public function up(): void
    {
        Schema::table('sejarah', function (Blueprint $table) {
            $table->longText('deskripsi_en')->nullable()->after('deskripsi');
            $table->longText('deskripsi_id')->nullable()->after('deskripsi_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sejarah', function (Blueprint $table) {
            $table->dropColumn(['deskripsi_en', 'deskripsi_id']);
        });
    }
};
