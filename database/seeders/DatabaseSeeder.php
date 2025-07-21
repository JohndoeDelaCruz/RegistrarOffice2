<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed student users with tracks
        $this->call(StudentUsersSeeder::class);
        
        // Seed faculty members (both Faculty table and User account)
        $this->call(FacultySeeder::class);
        
        // Seed dean user
        $this->call(DeanUserSeeder::class);
        
        // Seed admin user
        $this->call(AdminSeeder::class);
        
        // Seed academic years
        $this->call(AcademicYearSeeder::class);
        
        // Seed subjects
        $this->call(SubjectSeeder::class);
    }
}
