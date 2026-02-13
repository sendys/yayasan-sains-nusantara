<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('product_code')->unique();
            $table->string('barcode')->nullable()->unique();
            $table->string('product_name');
            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->unsignedBigInteger('satuan_id');
            $table->unsignedBigInteger('kategori_id');
            $table->decimal('selling_price', 15, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('stock_min')->default(0);
            $table->integer('stock_max')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Optional: if you want soft delete functionality

            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
