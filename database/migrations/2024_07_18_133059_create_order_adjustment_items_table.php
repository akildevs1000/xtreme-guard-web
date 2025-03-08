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
        Schema::create('order_adjustment_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_adjustment_id');
            $table->string('sku')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->boolean('requires_return')->nullable();
            $table->string('parent_sku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_adjustment_items');
    }
};
