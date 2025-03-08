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
        Schema::create('order_billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_order_id');
            $table->string('city')->nullable();
            $table->json('street')->nullable();
            $table->string('postcode')->nullable();
            $table->string('telephone')->nullable();
            $table->string('country_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('company')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('entity_id')->unique();
            $table->string('address_type')->nullable();
            $table->unsignedBigInteger('increment_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->string('store_name')->nullable();
            $table->string('administrative_area_level_2')->nullable();
            $table->string('sublocality_level_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_addresses');
    }
};
