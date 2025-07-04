<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create BSIT - Web Technology Track student
        User::create([
            'name' => 'John Doe',
            'email' => 'john.webtech@student.uc.edu.ph',
            'password' => Hash::make('password'),
            'course' => 'BSIT',
            'track' => 'Web Technology Track',
            'student_id' => '22-2014-166',
        ]);

        // Create BSIT - Network Security Track student
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.netsec@student.uc.edu.ph',
            'password' => Hash::make('password'),
            'course' => 'BSIT',
            'track' => 'Network Security Track',
            'student_id' => '22-2014-167',
        ]);
    }
}
