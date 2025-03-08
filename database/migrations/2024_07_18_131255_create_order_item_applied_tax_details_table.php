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
        Schema::create('order_item_applied_tax_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_applied_tax_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('base_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_applied_tax_details');
    }
};
