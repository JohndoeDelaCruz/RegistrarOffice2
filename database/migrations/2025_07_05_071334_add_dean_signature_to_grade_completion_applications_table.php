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
            $table->text('dean_signature')->nullable()->after('dean_reviewed_by');
            $table->string('dean_signature_type')->default('digital')->after('dean_signature'); // 'digital', 'uploaded'
            $table->timestamp('dean_signature_date')->nullable()->after('dean_signature_type');
            
            // Faculty processing fields
            $table->enum('faculty_status', ['completed', 'rejected'])->nullable()->after('dean_signature_date');
            $table->string('final_grade', 10)->nullable()->after('faculty_status');
            $table->timestamp('faculty_processed_at')->nullable()->after('final_grade');
            $table->foreignId('faculty_processed_by')->nullable()->constrained('users')->onDelete('set null')->after('faculty_processed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grade_completion_applications', function (Blueprint $table) {
            $table->dropForeign(['faculty_processed_by']);
            $table->dropColumn([
                'dean_signature', 
                'dean_signature_type', 
                'dean_signature_date',
                'faculty_status',
                'final_grade',
                'faculty_processed_at',
                'faculty_processed_by'
            ]);
        });
    }
};
