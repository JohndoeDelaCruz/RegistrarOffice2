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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // student
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('grade')->nullable(); // '1.0', '2.5', 'INC', 'F', etc.
            $table->string('academic_year'); // '2022-2023', '2023-2024', etc.
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            // Ensure a student can only have one grade per subject
            $table->unique(['user_id', 'subject_id']);
            
            // Add indexes for better performance
            $table->index(['user_id', 'academic_year']);
            $table->index('is_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
