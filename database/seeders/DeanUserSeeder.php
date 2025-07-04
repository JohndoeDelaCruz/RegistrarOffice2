<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DeanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Dean user account
        User::create([
            'name' => 'Dr. Roberto Martinez',
            'email' => 'dean.martinez@uc.edu.ph',
            'password' => Hash::make('dean123'),
            'role' => 'dean',
            'course' => 'Administration',
            'track' => null, // Dean doesn't need a track
            'student_id' => 'DEAN-2025-001',
            'phone' => '+63 917 555 1234',
            'date_of_birth' => '1975-03-20',
            'gender' => 'Male',
            'address' => '456 University Avenue, Cebu City, Philippines',
            'emergency_contact_name' => 'Elena Martinez',
            'emergency_contact_phone' => '+63 917 555 5678',
            'emergency_contact_relationship' => 'Spouse',
        ]);
    }
}
