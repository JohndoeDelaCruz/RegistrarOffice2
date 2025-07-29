<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing subjects to prevent duplicates
        Subject::truncate();
        
        // Seed subjects by college
        $this->call([
            EngineeringSubjectSeeder::class,
            ITSubjectSeeder::class,
            BusinessAdministrationSubjectSeeder::class,
            ArtsAndSciencesSubjectSeeder::class,
            CriminalJusticeEducationSubjectSeeder::class,
            TeacherEducationSubjectSeeder::class,
            LawSubjectSeeder::class,
            HospitalityTourismSubjectSeeder::class,
            NursingSubjectSeeder::class,
            AccountancySubjectSeeder::class,
        ]);
    }
}
