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
        Schema::table('product', function (Blueprint $table) {
            $table->index('product_name');
            $table->index('barcode');
            $table->index(['satuan_id', 'kategori_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropIndex(['product_name']);
            $table->dropIndex(['barcode']);
            $table->dropIndex(['satuan_id', 'kategori_id']);
        });
    }
};
