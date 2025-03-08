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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->string('shiping_reference_number')->nullable();
            $table->string('reference1');
            $table->string('reference2')->nullable();
            $table->string('reference3')->nullable();
            $table->string('foreign_hawb')->nullable();
            $table->boolean('has_errors')->default(false);
            $table->json('notifications')->nullable();
            $table->string('shipment_label_url')->nullable();
            $table->json('label_file_contents')->nullable();
            $table->timestamps();
        });

        Schema::create('shipment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_id');
            $table->unsignedBigInteger('shiping_reference_number');
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('chargeable_weight_unit')->default('KG')->nullable();
            $table->decimal('chargeable_weight_value', 8, 2)->nullable();
            $table->string('description_of_goods')->nullable();
            $table->string('goods_origin_country')->nullable();
            $table->integer('number_of_pieces')->nullable();
            $table->string('product_group')->nullable();
            $table->string('product_type')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_options')->nullable();
            $table->string('customs_value_currency_code')->nullable();
            $table->decimal('customs_value_amount', 10, 2)->default(0);
            $table->string('cash_on_delivery_currency_code')->nullable();
            $table->decimal('cash_on_delivery_amount')->nullable();
            $table->string('insurance_currency_code')->nullable();
            $table->decimal('insurance_amount', 10, 2)->default(0);
            $table->string('cash_additional_currency_code')->nullable();
            $table->decimal('cash_additional_amount', 10, 2)->default(0);
            $table->string('collect_currency_code')->nullable();
            $table->decimal('collect_amount', 10, 2)->default(0);
            $table->string('services')->nullable();
            $table->string('origin_city')->nullable();
            $table->string('destination_city')->nullable();
            $table->json('ship_attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('shipment_details');
    }
};
