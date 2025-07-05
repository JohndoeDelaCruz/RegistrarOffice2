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
        Schema::table('grade_completion_applications', function (Blueprint $table) {
            $table->enum('dean_status', ['pending', 'approved', 'rejected'])->default('pending')->after('status');
            $table->text('dean_remarks')->nullable()->after('dean_status');
            $table->timestamp('dean_reviewed_at')->nullable()->after('dean_remarks');
            $table->foreignId('dean_reviewed_by')->nullable()->constrained('users')->onDelete('set null')->after('dean_reviewed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grade_completion_applications', function (Blueprint $table) {
            $table->dropForeign(['dean_reviewed_by']);
            $table->dropColumn(['dean_status', 'dean_remarks', 'dean_reviewed_at', 'dean_reviewed_by']);
        });
    }
};
