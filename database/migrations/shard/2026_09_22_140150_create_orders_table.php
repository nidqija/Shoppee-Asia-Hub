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
             $table->uuid('id')->primary();
             $table->uuid('user_id')->nullable();
             $table->string('order_code')->unique();
             $table->string('shipping_address');
             $table->decimal('amount', 12 , 2);
             $table->string('currency' , 10)->default('MYR');
             $table->string('payment_method');
             $table->string('payment_status')->default('unpaid');
             $table->string('invoice_id')->nullable();
             $table->string('status')->default('pending');
             $table->timestamp('shipped_at')->nullable();
             $table->timestamp('completed_at')->nullable();
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
