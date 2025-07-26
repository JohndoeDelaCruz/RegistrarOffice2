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
        $existingAdmin = User::where('role', 'admin')->first();
        
        if ($existingAdmin) {
            // Update existing admin with correct credentials
            $existingAdmin->update([
                'name' => 'System Administrator',
                'email' => 'admin@uc.edu.ph',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'course' => 'System Administration',
                'track' => null,
                'student_id' => 'ADMIN-2025-001',
                'phone' => '+63 917 555 0000',
                'date_of_birth' => '1980-01-01',
                'gender' => 'Other',
                'address' => '123 University Campus, Baguio City, Philippines',
                'emergency_contact_name' => 'IT Support Team',
                'emergency_contact_phone' => '+63 917 555 0001',
                'emergency_contact_relationship' => 'Colleague',
            ]);
            
            $this->command->info('Admin user updated with standard credentials.');
        } else {
            // Create new Admin user account
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
                'address' => '123 University Campus, Baguio City, Philippines',
                'emergency_contact_name' => 'IT Support Team',
                'emergency_contact_phone' => '+63 917 555 0001',
                'emergency_contact_relationship' => 'Colleague',
            ]);
            
            $this->command->info('Admin user created successfully!');
        }
        
        $this->command->info('=== ADMIN LOGIN CREDENTIALS ===');
        $this->command->info('Email: admin@uc.edu.ph');
        $this->command->info('Student ID: ADMIN-2025-001');
        $this->command->info('Password: admin123');
    }
}
