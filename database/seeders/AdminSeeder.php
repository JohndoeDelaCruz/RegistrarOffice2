<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        if (User::where('role', 'admin')->exists()) {
            $this->command->info('Admin user already exists. Skipping...');
            return;
        }

        // Create Admin user account
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@uc.edu.ph',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'course' => 'System Administration',
            'track' => null, // Admin doesn't need a track
            'student_id' => 'ADMIN-2025-001',
            'phone' => '+63 917 555 0000',
            'date_of_birth' => '1980-01-01',
            'gender' => 'Other',
            'address' => '123 University Campus, Cebu City, Philippines',
            'emergency_contact_name' => 'IT Support Team',
            'emergency_contact_phone' => '+63 917 555 0001',
            'emergency_contact_relationship' => 'Colleague',
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@uc.edu.ph');
        $this->command->info('Password: admin123');
    }
}
