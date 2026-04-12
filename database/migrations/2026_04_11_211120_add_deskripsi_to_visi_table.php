<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2026_04_11_211120_add_deskripsi_to_visi_table.php
     */
    public function up(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            $table->text('deskripsi_en')->nullable()->after('deskripsi'); // sesuaikan posisi kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            //
            $table->dropColumn('deskripsi_en');
        });
    }
};
