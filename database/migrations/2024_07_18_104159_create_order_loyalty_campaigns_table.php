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
        Schema::create('order_loyalty_campaigns', function (Blueprint $table) {
            $table->id();
            $table->uuid('loyalty_campaign_id')->nullable();
            $table->unsignedBigInteger('import_order_id');
            $table->json('discounted_skus')->nullable();
            $table->integer('spent_points')->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_order_loyalty_campaigns');
    }
};
