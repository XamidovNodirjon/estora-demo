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
        Schema::create('sms_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 25)->index();
            $table->string('code', 20)->nullable();
            $table->text('message')->nullable();
            $table->string('status', 20)->default('pending')->index(); // pending, sent, failed
            $table->longText('response')->nullable();
            $table->text('error')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_notifications');
    }
};
