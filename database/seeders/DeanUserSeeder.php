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
        $deans = [
            [
                'name' => 'Dr. Roberto Martinez',
                'email' => 'dean.law@uc.edu.ph',
                'course' => 'College of Law',
                'phone' => '+63 917 555 1001',
            ],
            [
                'name' => 'Dr. Maria Santos',
                'email' => 'dean.accountancy@uc.edu.ph',
                'course' => 'College of Accountancy',
                'phone' => '+63 917 555 1002',
            ],
            [
                'name' => 'Dr. Juan Dela Cruz',
                'email' => 'dean.artssciences@uc.edu.ph',
                'course' => 'College of Arts and Sciences',
                'phone' => '+63 917 555 1003',
            ],
            [
                'name' => 'Dr. Ana Reyes',
                'email' => 'dean.business@uc.edu.ph',
                'course' => 'College of Business Administration',
                'phone' => '+63 917 555 1004',
            ],
            [
                'name' => 'Dr. Carlos Mendoza',
                'email' => 'dean.criminaljustice@uc.edu.ph',
                'course' => 'College of Criminal Justice Education',
                'phone' => '+63 917 555 1005',
            ],
            [
                'name' => 'Dr. Elena Garcia',
                'email' => 'dean.engineering@uc.edu.ph',
                'course' => 'College of Engineering and Architecture',
                'phone' => '+63 917 555 1006',
            ],
            [
                'name' => 'Dr. Miguel Torres',
                'email' => 'dean.hospitality@uc.edu.ph',
                'course' => 'College of Hospitality and Tourism Management',
                'phone' => '+63 917 555 1007',
            ],
            [
                'name' => 'Dr. Sofia Villanueva',
                'email' => 'dean.it@uc.edu.ph',
                'course' => 'College of Information Technology and Computer Science',
                'phone' => '+63 917 555 1008',
            ],
            [
                'name' => 'Dr. Carmen Flores',
                'email' => 'dean.nursing@uc.edu.ph',
                'course' => 'College of Nursing',
                'phone' => '+63 917 555 1009',
            ],
            [
                'name' => 'Dr. Antonio Cruz',
                'email' => 'dean.education@uc.edu.ph',
                'course' => 'College of Teacher Education',
                'phone' => '+63 917 555 1010',
            ],
        ];

        foreach ($deans as $index => $dean) {
            User::create([
                'name' => $dean['name'],
                'email' => $dean['email'],
                'password' => Hash::make('dean123'),
                'role' => 'dean',
                'course' => $dean['course'],
                'track' => null,
                'student_id' => 'DEAN-2025-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'phone' => $dean['phone'],
                'date_of_birth' => '1970-01-01', // Default birth date
                'gender' => 'Male', // Default gender
                'address' => 'University of the Cordilleras, Baguio City, Philippines',
                'emergency_contact_name' => 'Emergency Contact',
                'emergency_contact_phone' => '+63 917 555 0000',
                'emergency_contact_relationship' => 'Family',
                'email_verified_at' => now(),
            ]);
        }
    }
}
