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
        Schema::create('order_trackings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('tracking_id')->nullable();
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


    // "TrackingResults": [
    //     {
    //       "Key": "44262358066",
    //       "Value": [
    //         {
    //           "WaybillNumber": "44262358066",
    //           "UpdateCode": "SH014",
    //           "UpdateDescription": "Record created.",
    //           "UpdateDateTime": "/Date(1722924060000+0300)/",
    //           "UpdateLocation": "Dubai, United Arab Emirates",
    //           "Comments": "",
    //           "ProblemCode": "",
    //           "GrossWeight": "0.1",
    //           "ChargeableWeight": "0.1",
    //           "WeightUnit": "KG"
    //         }
    //       ]
    //     }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_trackings');
    }
};
