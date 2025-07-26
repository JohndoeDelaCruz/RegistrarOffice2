<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update admin user credentials if exists
        DB::table('users')
            ->where('email', 'admin@example.com')
            ->orWhere('email', 'admin@admin.com')
            ->update([
                'email' => 'admin@registrar.edu',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'updated_at' => now(),
            ]);

        // If no admin user exists, create one
        $adminExists = DB::table('users')->where('role', 'admin')->exists();
        
        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'System Administrator',
                'email' => 'admin@registrar.edu',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'course' => 'BSIT',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the admin user created by this migration
        DB::table('users')
            ->where('email', 'admin@registrar.edu')
            ->delete();
    }
};
