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
            $table->timestamp('completion_deadline')->nullable()->after('dean_reviewed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grade_completion_applications', function (Blueprint $table) {
            $table->dropColumn('completion_deadline');
        });
    }
};
