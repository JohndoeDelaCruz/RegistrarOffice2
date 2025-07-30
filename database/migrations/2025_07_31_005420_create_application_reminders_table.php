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
        Schema::create('application_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('grade_completion_applications')->onDelete('cascade');
            $table->foreignId('sent_by')->constrained('users')->onDelete('cascade'); // Admin who sent the reminder
            $table->foreignId('sent_to')->constrained('users')->onDelete('cascade'); // Dean who receives the reminder
            $table->text('message')->nullable();
            $table->enum('type', ['pending_review', 'overdue', 'follow_up'])->default('pending_review');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_reminders');
    }
};
