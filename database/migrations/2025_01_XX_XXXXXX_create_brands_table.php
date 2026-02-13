<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
    * Run the migrations.
    * php artisan migrate --path=/database/migrations/2025_01_XX_XXXXXX_create_brands_table.php
    */
    public function up(): void
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('kode');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('logo')->nullable(); // untuk upload gambar
            $table->boolean('is_active')->default(true); // status aktif
            $table->timestamps();
            $table->softDeletes();
            $table->index('nama');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
