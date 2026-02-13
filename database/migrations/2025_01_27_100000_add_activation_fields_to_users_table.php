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
        Schema::table('users', function (Blueprint $table) {
            $table->string('activation_token')->nullable()->after('google_id');
            $table->timestamp('activation_token_expires_at')->nullable()->after('activation_token');
            $table->boolean('is_activated')->default(false)->after('activation_token_expires_at');
            $table->timestamp('activated_at')->nullable()->after('is_activated');

            $table->index('activation_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['activation_token']);
            $table->dropColumn([
                'activation_token',
                'activation_token_expires_at',
                'is_activated',
                'activated_at',
            ]);
        });
    }
};
