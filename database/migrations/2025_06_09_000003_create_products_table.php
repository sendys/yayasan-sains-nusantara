<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
    * Table product
    * php artisan migrate --path=/database/migrations/2025_06_09_000003_create_products_table.php
    */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('restrict');
            $table->decimal('purchase_price', 15, 2);
            $table->integer('stock')->nullable();
            $table->integer('min_stock')->nullable();
            $table->integer('max_stock')->nullable();
            $table->integer('perusahaan_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('code');
            $table->index('name');
        });

        Schema::create('product_price', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->foreignId('product_id')->constrained('product')->onDelete('cascade');
            $table->foreignId('satuan_id')->constrained('satuan')->onDelete('restrict');
            $table->decimal('selling_price', 15, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['product_id', 'satuan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_price');
        Schema::dropIfExists('product');
    }
};
