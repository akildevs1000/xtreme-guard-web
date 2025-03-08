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
        Schema::create('pickup_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_pickup_id');
            $table->unsignedBigInteger('import_order_id');
            $table->string('entity')->nullable();
            $table->string('reference')->nullable();
            $table->timestamp('collection_date')->nullable();
            $table->timestamp('pickup_date')->nullable();
            $table->string('last_status')->nullable();
            $table->text('last_status_description')->nullable();
            $table->json('collected_waybills')->nullable();
            $table->boolean('has_errors')->nullable();
            $table->string('org_collection_date')->nullable();
            $table->string('org_pickup_date')->nullable();
            $table->string('reference1')->nullable();
            $table->string('reference2')->nullable();
            $table->string('reference3')->nullable();
            $table->string('reference4')->nullable();
            $table->string('reference5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_trackings');
    }
};
