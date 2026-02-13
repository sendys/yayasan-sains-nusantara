<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2025_06_16_051812_add_perusahaan_id_to_customer_table.php
     */
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            //
            $table->integer('perusahaan_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            //
            $table->dropColumn('perusahaan_id');
        });
    }
};
