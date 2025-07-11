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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('category')->default('general'); // general, academic, administrative, urgent
            $table->string('audience')->default('all'); // all, students, faculty, staff
            $table->string('priority')->default('normal'); // normal, high, urgent
            $table->boolean('is_published')->default(false);
            $table->boolean('is_draft')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // dean who created it
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index(['is_published', 'audience', 'published_at']);
            $table->index(['category', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
