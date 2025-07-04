<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Faculty record
        Faculty::create([
            'name' => 'Dr. Maria Santos',
            'email' => 'maria.santos@faculty.uc.edu.ph',
            'faculty_id' => 'FAC-2020-001',
            'department' => 'Computer Science Department',
            'position' => 'Professor',
            'phone' => '+63 917 123 4567',
            'date_of_birth' => '1980-05-15',
            'gender' => 'Female',
            'address' => '123 Faculty Village, Cebu City, Philippines',
            'office_location' => 'Room 301, IT Building',
            'specialization' => 'Software Engineering & Web Development',
            'education_level' => 'PhD in Computer Science',
            'emergency_contact_name' => 'Roberto Santos',
            'emergency_contact_phone' => '+63 917 987 6543',
            'emergency_contact_relationship' => 'Spouse',
        ]);

        // Create corresponding User account for login
        User::create([
            'name' => 'Dr. Maria Santos',
            'email' => 'maria.santos@faculty.uc.edu.ph',
            'password' => Hash::make('faculty123'),
            'role' => 'faculty',
            'course' => 'Computer Science',
            'track' => null, // Faculty doesn't need a track
            'student_id' => 'FAC-2020-001', // Using faculty_id as identifier
            'phone' => '+63 917 123 4567',
            'date_of_birth' => '1980-05-15',
            'gender' => 'Female',
            'address' => '123 Faculty Village, Cebu City, Philippines',
            'emergency_contact_name' => 'Roberto Santos',
            'emergency_contact_phone' => '+63 917 987 6543',
            'emergency_contact_relationship' => 'Spouse',
        ]);
    }
}
