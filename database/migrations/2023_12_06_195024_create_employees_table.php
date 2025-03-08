<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('branch')->nullable();
            $table->string('department')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('country')->nullable();
            $table->string('img')->nullable();
            $table->string('cover_img')->nullable();
            $table->text('description')->nullable();
            $table->integer('is_active')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
