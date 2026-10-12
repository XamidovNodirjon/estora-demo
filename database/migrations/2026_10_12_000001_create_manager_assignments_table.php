<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Polymorphic pivot: links a manager (users.id) to any assignable model
     * (Lead, Product, ...) via assignable_type / assignable_id.
     */
    public function up(): void
    {
        Schema::create('manager_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_id')->constrained('users')->cascadeOnDelete();
            $table->morphs('assignable');
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['manager_id', 'assignable_type', 'assignable_id'], 'manager_assignments_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_assignments');
    }
};
