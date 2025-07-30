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
        Schema::create('dean_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dean_id')->constrained('users')->onDelete('cascade'); // Dean who receives the notification
            $table->foreignId('application_id')->constrained('grade_completion_applications')->onDelete('cascade');
            $table->foreignId('sent_by')->constrained('users')->onDelete('cascade'); // Admin who sent the reminder
            $table->foreignId('admin_reminder_id')->nullable()->constrained('application_reminders')->onDelete('cascade'); // Link to admin reminder
            $table->enum('type', ['admin_reminder', 'deadline_warning', 'overdue', 'follow_up'])->default('admin_reminder');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->json('metadata')->nullable(); // Store additional data like urgency level, etc.
            $table->timestamps();
            
            // Index for faster queries
            $table->index(['dean_id', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dean_notifications');
    }
};
