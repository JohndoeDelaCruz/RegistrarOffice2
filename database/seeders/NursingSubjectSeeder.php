<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class NursingSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create subjects for College of Nursing
        $this->createNursingSubjects();
    }

    private function createNursingSubjects()
    {
        $nursingSubjects = [
            // 1st Year - 1st Semester
            ['code' => 'NSTP1', 'description' => 'National Service Training Program 1', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'PE1', 'description' => 'Physical Education 1', 'units' => 2, 'year_level' => 1, 'semester' => 1],
            ['code' => 'FIL1', 'description' => 'Kontekstwalisadong Komunikasyon sa Filipino', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'ENG1', 'description' => 'Purposive Communication', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'MATH1', 'description' => 'Mathematics in the Modern World', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'SCI1', 'description' => 'Science, Technology and Society', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'NURS100', 'description' => 'Fundamentals of Nursing', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'ANAT100', 'description' => 'Human Anatomy', 'units' => 4, 'year_level' => 1, 'semester' => 1],

            // 1st Year - 2nd Semester
            ['code' => 'NSTP2', 'description' => 'National Service Training Program 2', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'PE2', 'description' => 'Physical Education 2', 'units' => 2, 'year_level' => 1, 'semester' => 2],
            ['code' => 'RIZAL', 'description' => 'Life and Works of Rizal', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'PHIL1', 'description' => 'Introduction to Philosophy of the Human Person', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'HIST1', 'description' => 'Readings in Philippine History', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'UTS', 'description' => 'Understanding the Self', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'PHYSIO100', 'description' => 'Human Physiology', 'units' => 4, 'year_level' => 1, 'semester' => 2],
            ['code' => 'BIOCHEM100', 'description' => 'Biochemistry for Nurses', 'units' => 3, 'year_level' => 1, 'semester' => 2],

            // 2nd Year - 1st Semester
            ['code' => 'PE3', 'description' => 'Physical Education 3', 'units' => 2, 'year_level' => 2, 'semester' => 1],
            ['code' => 'ART1', 'description' => 'Art Appreciation', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'ETH1', 'description' => 'Ethics', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'SOC1', 'description' => 'The Contemporary World', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'MICRO100', 'description' => 'Microbiology and Parasitology', 'units' => 4, 'year_level' => 2, 'semester' => 1],
            ['code' => 'PATHO100', 'description' => 'Pathophysiology', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'NURS200', 'description' => 'Health Assessment', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'PHARMA100', 'description' => 'Pharmacology', 'units' => 3, 'year_level' => 2, 'semester' => 1],

            // 2nd Year - 2nd Semester
            ['code' => 'PE4', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'semester' => 2],
            ['code' => 'PSYC100', 'description' => 'General Psychology', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'SOCIO100', 'description' => 'Sociology', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'NUTR100', 'description' => 'Nutrition and Diet Therapy', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'NURS210', 'description' => 'Medical-Surgical Nursing 1', 'units' => 4, 'year_level' => 2, 'semester' => 2],
            ['code' => 'NURS220', 'description' => 'Maternal and Child Health Nursing', 'units' => 4, 'year_level' => 2, 'semester' => 2],
            ['code' => 'RLE100', 'description' => 'Related Learning Experience 1', 'units' => 3, 'year_level' => 2, 'semester' => 2],

            // 3rd Year - 1st Semester
            ['code' => 'NURS300', 'description' => 'Medical-Surgical Nursing 2', 'units' => 4, 'year_level' => 3, 'semester' => 1],
            ['code' => 'NURS310', 'description' => 'Pediatric Nursing', 'units' => 4, 'year_level' => 3, 'semester' => 1],
            ['code' => 'NURS320', 'description' => 'Mental Health and Psychiatric Nursing', 'units' => 4, 'year_level' => 3, 'semester' => 1],
            ['code' => 'NURS330', 'description' => 'Community Health Nursing', 'units' => 4, 'year_level' => 3, 'semester' => 1],
            ['code' => 'RLE200', 'description' => 'Related Learning Experience 2', 'units' => 4, 'year_level' => 3, 'semester' => 1],
            ['code' => 'RESEARCH100', 'description' => 'Nursing Research', 'units' => 3, 'year_level' => 3, 'semester' => 1],

            // 3rd Year - 2nd Semester
            ['code' => 'NURS340', 'description' => 'Critical Care Nursing', 'units' => 4, 'year_level' => 3, 'semester' => 2],
            ['code' => 'NURS350', 'description' => 'Operating Room Nursing', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'NURS360', 'description' => 'Emergency and Disaster Nursing', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'NURS370', 'description' => 'Gerontological Nursing', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'RLE300', 'description' => 'Related Learning Experience 3', 'units' => 4, 'year_level' => 3, 'semester' => 2],
            ['code' => 'NURS380', 'description' => 'Nursing Informatics', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'ETHICS100', 'description' => 'Nursing Ethics and Jurisprudence', 'units' => 3, 'year_level' => 3, 'semester' => 2],

            // 4th Year - 1st Semester
            ['code' => 'NURS400', 'description' => 'Leadership and Management in Nursing', 'units' => 4, 'year_level' => 4, 'semester' => 1],
            ['code' => 'NURS410', 'description' => 'Quality Assurance and Risk Management', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'NURS420', 'description' => 'Nursing Education', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'NURS430', 'description' => 'International Health and Nursing', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'RLE400', 'description' => 'Related Learning Experience 4 - Management', 'units' => 4, 'year_level' => 4, 'semester' => 1],
            ['code' => 'THESIS100', 'description' => 'Nursing Research and Thesis Writing', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'ELECTIVE1', 'description' => 'Nursing Elective 1', 'units' => 3, 'year_level' => 4, 'semester' => 1],

            // 4th Year - 2nd Semester
            ['code' => 'NURS440', 'description' => 'Comprehensive Nursing Care', 'units' => 4, 'year_level' => 4, 'semester' => 2],
            ['code' => 'NURS450', 'description' => 'Professional Adjustment and Career Planning', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'NURS460', 'description' => 'Nursing Trends and Issues', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'NURS470', 'description' => 'Health Policy and Healthcare Systems', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'RLE500', 'description' => 'Related Learning Experience 5 - Comprehensive', 'units' => 6, 'year_level' => 4, 'semester' => 2],
            ['code' => 'ELECTIVE2', 'description' => 'Nursing Elective 2', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'LICENSURE100', 'description' => 'Nursing Licensure Examination Review', 'units' => 3, 'year_level' => 4, 'semester' => 2],
        ];

        $course = 'BS Nursing';
        
        foreach ($nursingSubjects as $index => $subject) {
            $this->createSubject($subject, $course, null, $index + 1);
        }
    }

    private function createSubject($subjectData, $course = null, $track = null, $sortOrder = 1)
    {
        Subject::create([
            'code' => $subjectData['code'],
            'description' => $subjectData['description'],
            'units' => $subjectData['units'],
            'year_level' => $subjectData['year_level'],
            'trimester' => $subjectData['semester'], // Using trimester field to store semester data
            'course' => $course,
            'track' => $track,
            'sort_order' => $sortOrder,
        ]);
    }
}
