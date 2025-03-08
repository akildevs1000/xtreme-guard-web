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
        Schema::create('pickup_shipment_trackings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('pickup_shipment_id')->nullable();
            $table->bigInteger('pickup_shipment_tracking_id')->nullable();
            $table->string('waybill_number')->nullable();
            $table->string('update_code')->nullable();
            $table->string('update_description')->nullable();
            $table->string('update_date_time')->nullable();
            $table->dateTime('update_date_time_converted')->nullable();
            $table->string('update_location')->nullable();
            $table->text('comments')->nullable();
            $table->string('problem_code')->nullable();
            $table->decimal('gross_weight', 8, 2)->nullable();
            $table->decimal('chargeable_weight', 8, 2)->nullable();
            $table->string('weight_unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_shipment_trackings');
    }
};
