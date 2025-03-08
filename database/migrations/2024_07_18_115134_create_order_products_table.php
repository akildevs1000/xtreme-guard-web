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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_order_id');
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->integer('qty_ordered')->nullable();
            $table->decimal('price_incl_tax', 10, 2)->nullable();
            $table->decimal('discount_percent', 10, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->string('product_type')->nullable();
            $table->json('promotional_offers')->nullable();
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
