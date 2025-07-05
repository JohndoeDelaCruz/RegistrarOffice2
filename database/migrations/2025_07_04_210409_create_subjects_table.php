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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code'); // e.g., 'CS 101', 'GE 101'
            $table->string('description'); // e.g., 'Introduction to Computing'
            $table->integer('units'); // credit units
            $table->integer('year_level'); // 1, 2, 3, 4
            $table->integer('trimester'); // 1, 2, 3
            $table->string('track')->nullable(); // 'Web Technology Track', 'Cybersecurity Track', null for common subjects
            $table->string('course'); // 'Bachelor of Science in Computer Science'
            $table->integer('sort_order')->default(0); // for ordering subjects within a trimester
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index(['year_level', 'trimester', 'track', 'course']);
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
