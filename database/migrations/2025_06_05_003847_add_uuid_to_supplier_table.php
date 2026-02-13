<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2025_06_05_003847_add_uuid_to_supplier_table.php
     */
    public function up(): void
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
