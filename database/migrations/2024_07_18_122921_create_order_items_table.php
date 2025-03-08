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
        Schema::create('order_product_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_product_id')->nullable();
            $table->unsignedBigInteger('import_order_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('original_price_incl_tax', 10, 2)->nullable();
            $table->string('special_promo_bundle_campaign_1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_order_item');
    }
};
