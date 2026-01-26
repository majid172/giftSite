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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->string('status')->default('pending');
            $table->decimal('price', 10, 2);
            $table->string('job_title')->nullable();
            $table->integer('image_quantity')->default(0);
            $table->boolean('is_paid')->default(false);
            $table->json('shipping_address')->nullable();
            $table->string('payment_method')->default('cod');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
