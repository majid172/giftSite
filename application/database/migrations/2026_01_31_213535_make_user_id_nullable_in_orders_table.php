<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Reverting logic would depend on whether we want to strictly enforce it again or not.
            // Assuming we want to revert to non-nullable, but this might fail if there are nulls.
            // For now, we'll leave basic reversion attempt.
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
};
