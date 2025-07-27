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
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('format');
        });
        
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('format', ['html', 'pdf', 'excel', 'csv', 'json'])->default('html')->after('type_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('format');
        });
        
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('format', ['pdf', 'excel', 'csv', 'json'])->default('pdf')->after('type_color');
        });
    }
};
