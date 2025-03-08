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
        Schema::create('cron_failures', function (Blueprint $table) {
            $table->id();
            $table->string('job_name')->nullable(); // Name of the cron job
            $table->string('recipient_email'); // Email recipient
            $table->text('error_message')->nullable(); // Error details
            $table->integer('is_fixed')->default(0); // Email recipient
            $table->timestamp('failed_at')->useCurrent(); // Failure timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cron_failures');
    }
};
