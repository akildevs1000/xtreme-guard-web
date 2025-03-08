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
        Schema::create('import_orders', function (Blueprint $table) {
            $table->id();
            $table->string('fms_number')->nullable();
            $table->unsignedBigInteger('order_id')->unique();
            $table->unsignedBigInteger('invoice_no')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->uuid('loyalty_campaign_id')->nullable();
            $table->timestamp('update_date')->nullable();
            $table->timestamp('order_date');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total_due', 10, 2);
            $table->decimal('total_discount', 10, 2)->default(0);
            $table->decimal('shipping_amount', 10, 2);
            $table->integer('total_item_count');
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('tax_total', 10, 2);
            $table->decimal('shipping_amount_tax', 10, 2);
            $table->string('order_type');
            $table->string('order_status')->nullable();
            $table->integer('is_confirmed')->default(0);
            $table->timestamp('confirmed_date')->nullable();
            $table->integer('is_shipped')->default(0);
            $table->timestamp('shipped_date')->nullable();
            $table->integer('is_delivered')->default(0);
            $table->timestamp('delivered_date')->nullable();
            $table->integer('is_pickuped')->default(0);
            $table->string('cancel_reason_code')->nullable();
            $table->string('cancel_reason_message')->nullable();
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_orders');
    }
};
