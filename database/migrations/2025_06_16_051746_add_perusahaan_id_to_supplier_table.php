<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2025_06_16_051746_add_perusahaan_id_to_supplier_table.php
     */
    public function up(): void
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->integer('perusahaan_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier', function (Blueprint $table) {
            //
            $table->dropColumn('perusahaan_id');
        });
    }
};
