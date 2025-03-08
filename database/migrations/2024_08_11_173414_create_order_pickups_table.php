<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_pickups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable();
            $table->string('pickup_id')->nullable();
            $table->string('guid');
            $table->string('reference1');
            $table->string('reference2')->nullable();
            $table->json('processed_shipments')->nullable();
            $table->json('notifications')->nullable();
            $table->json('transaction')->nullable();
            $table->bigInteger('is_return_delivered')->default(0);
            $table->datetime('return_delivered_date')->nullable();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_pickups');
    }
};
