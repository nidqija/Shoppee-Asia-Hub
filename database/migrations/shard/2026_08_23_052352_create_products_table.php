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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('category_slug');
            $table->string('region_code');
            $table->integer('stock_quantity')->default(0);
            $table->integer('warranty_period')->default(0); 
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->uuid('seller_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
