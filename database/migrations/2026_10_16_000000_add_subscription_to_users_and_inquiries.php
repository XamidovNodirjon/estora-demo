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
        // Foydalanuvchi obunasi (tarif): start (bepul), basic, plus
        Schema::table('users', function (Blueprint $table) {
            $table->string('subscription_plan', 20)->default('start')->after('status');
            $table->string('subscription_period', 10)->nullable()->after('subscription_plan');
            $table->timestamp('subscription_expires_at')->nullable()->after('subscription_period');
        });

        // Ariza: kim yuborgani va qaysi tarifni so'ragani (admin tez faollashtirishi uchun)
        Schema::table('inquiries', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('requested_plan', 20)->nullable()->after('description');
            $table->string('requested_period', 10)->nullable()->after('requested_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['requested_plan', 'requested_period']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['subscription_plan', 'subscription_period', 'subscription_expires_at']);
        });
    }
};
