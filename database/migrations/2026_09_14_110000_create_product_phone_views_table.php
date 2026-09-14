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
        if (!Schema::hasTable('product_phone_views')) {
            Schema::create('product_phone_views', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
                $table->foreignId('viewer_id')->nullable()->constrained('users')->onDelete('set null');
                $table->foreignId('seller_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('seller_role', 50)->default('owner');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();

                $table->index(['product_id', 'created_at']);
                $table->index(['viewer_id', 'created_at']);
            });
        }

        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'phone_views_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedInteger('phone_views_count')->default(0)->after('phone');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'phone_views_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('phone_views_count');
            });
        }

        Schema::dropIfExists('product_phone_views');
    }
};
