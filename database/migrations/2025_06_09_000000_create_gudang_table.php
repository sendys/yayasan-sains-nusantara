<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2025_06_09_000000_create_gudang_table.php
     */
    public function up(): void
    {
        Schema::create('gudang', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->timestamps();
            $table->softDeletes();
            $table->index('kode');
            $table->index('nama');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gudang');
    }
};
