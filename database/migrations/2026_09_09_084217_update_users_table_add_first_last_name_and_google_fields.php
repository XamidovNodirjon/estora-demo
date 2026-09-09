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
            if (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->unique()->after('email');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('google_id');
            }
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $dropCols = [];
            if (Schema::hasColumn('users', 'first_name')) $dropCols[] = 'first_name';
            if (Schema::hasColumn('users', 'last_name')) $dropCols[] = 'last_name';
            if (Schema::hasColumn('users', 'google_id')) $dropCols[] = 'google_id';
            if (Schema::hasColumn('users', 'avatar')) $dropCols[] = 'avatar';
            if (!empty($dropCols)) {
                $table->dropColumn($dropCols);
            }
        });
    }
};
