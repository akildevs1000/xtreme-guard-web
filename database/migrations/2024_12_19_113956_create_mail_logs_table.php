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
        Schema::create('mail_logs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable()->index();
            $table->bigInteger('order_id')->nullable();
            $table->string('mail_class')->nullable()->index();
            $table->string('subject')->nullable();
            $table->string('mail_type')->nullable();
            $table->text('content')->nullable();
            $table->text('attachment_path')->nullable();
            $table->text('view_path')->nullable();
            $table->text('description')->nullable();
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->json('cc')->nullable();
            $table->json('bcc')->nullable();
            $table->bigInteger('is_sent')->default(0);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->bigInteger('opens')->nullable();
            $table->timestamp('last_opened_at')->nullable();
            $table->bigInteger('clicks')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_logs');
    }
};
