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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->nullable();
            $table->string('type_value')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('is_visible')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('level', ['app', 'user']);
            $table->timestamps();

            // Foreign key constraint if user_id is present
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
