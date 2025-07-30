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
        Schema::create('faculty_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained('users')->onDelete('cascade'); // Faculty member
            $table->foreignId('application_id')->constrained('grade_completion_applications')->onDelete('cascade');
            $table->enum('type', ['deadline_warning', 'overdue', 'completion_required'])->default('deadline_warning');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->date('deadline_date'); // The actual deadline date
            $table->integer('days_until_deadline'); // Days remaining until deadline
            $table->boolean('email_sent')->default(false);
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamps();
            
            // Prevent duplicate notifications for same application and type
            $table->unique(['faculty_id', 'application_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_notifications');
    }
};
