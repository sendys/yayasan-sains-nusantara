<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2025_06_08_151539_add_photo_to_customer_table.php
     */
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
};
