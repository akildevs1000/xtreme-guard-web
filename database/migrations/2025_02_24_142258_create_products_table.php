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
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('original_price', 8, 2);
            $table->decimal('sale_price', 8, 2);
            $table->integer('quantity')->default(0);
            $table->string('sku')->unique();
            $table->string('brand_id')->nullable();
            $table->string('category_id');
            $table->string('status')->default('active');
            $table->string('main_image');
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('slug')->nullable();
            // $table->string('slug')->unique();
            $table->string('warranty')->nullable();
            $table->text('features')->nullable();
            $table->text('specifications')->nullable();
            $table->text('short_desc')->nullable();
            $table->json('tags')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->string('condition')->nullable();
            $table->integer('is_available')->default(1);
            $table->integer('is_warrenty_available')->default(1);
            $table->integer('view_count')->default(1);



            $table->timestamps();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('image');
            $table->string('desc')->nullable();
            $table->timestamps();
        });

        Schema::create('product_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
            $table->string('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_attachments');
    }
};
