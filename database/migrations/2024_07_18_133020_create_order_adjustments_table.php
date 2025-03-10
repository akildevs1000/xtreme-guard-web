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
        Schema::create('order_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_order_id');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->boolean('inform_warehouse')->nullable();
            $table->timestamp('open_date')->nullable();
            // $table->decimal('tax_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_adjustments');
    }
};
