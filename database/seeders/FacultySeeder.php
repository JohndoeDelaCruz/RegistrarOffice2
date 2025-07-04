<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
