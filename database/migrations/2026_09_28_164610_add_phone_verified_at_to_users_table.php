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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone_verified_at')) {
                $table->timestamp('phone_verified_at')->nullable()->after('phone');
            }
        });

        // Mavjud telefon raqami bor foydalanuvchilar (SMS orqali o'tgan) uchun phone_verified_at ni to'ldiramiz
        \Illuminate\Support\Facades\DB::table('users')
            ->whereNotNull('phone')
            ->whereNull('phone_verified_at')
            ->whereNull('google_id') // Faqat oddiy ro'yxatdan o'tganlar (Google bo'lmaganlar)
            ->update(['phone_verified_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'phone_verified_at')) {
                $table->dropColumn('phone_verified_at');
            }
        });
    }
};
