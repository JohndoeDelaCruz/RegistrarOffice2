<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class HospitalityTourismSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create common hospitality and tourism subjects for all programs
        $this->createCommonHospitalityTourismSubjects();
        
        // Create specific subjects for each hospitality and tourism program
        $this->generateHospitalityTourismPrograms();
    }

    private function createCommonHospitalityTourismSubjects()
    {
        $commonSubjects = [
            // 1st Year - 1st Trimester
            ['code' => 'NSTP1', 'description' => 'National Service Training Program 1', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'PE1', 'description' => 'Physical Education 1', 'units' => 2, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'FIL1', 'description' => 'Kontekstwalisadong Komunikasyon sa Filipino', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'ENG1', 'description' => 'Purposive Communication', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'MATH1', 'description' => 'Mathematics in the Modern World', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'SCI1', 'description' => 'Science, Technology and Society', 'units' => 3, 'year_level' => 1, 'trimester' => 1],

            // 1st Year - 2nd Trimester
            ['code' => 'NSTP2', 'description' => 'National Service Training Program 2', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'PE2', 'description' => 'Physical Education 2', 'units' => 2, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'RIZAL', 'description' => 'Life and Works of Rizal', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'PHIL1', 'description' => 'Introduction to Philosophy of the Human Person', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'HIST1', 'description' => 'Readings in Philippine History', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'UTS', 'description' => 'Understanding the Self', 'units' => 3, 'year_level' => 1, 'trimester' => 2],

            // 1st Year - 3rd Trimester
            ['code' => 'PE3', 'description' => 'Physical Education 3', 'units' => 2, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'ART1', 'description' => 'Art Appreciation', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'ETH1', 'description' => 'Ethics', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'SOC1', 'description' => 'The Contemporary World', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'HTM100', 'description' => 'Introduction to Hospitality and Tourism', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'SERV100', 'description' => 'Service Excellence', 'units' => 3, 'year_level' => 1, 'trimester' => 3],

            // 2nd Year - 1st Trimester
            ['code' => 'PE4', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'PSYC100', 'description' => 'General Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'BUS100', 'description' => 'Business Organization and Management', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ACC100', 'description' => 'Fundamentals of Accounting', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ECON100', 'description' => 'Principles of Economics', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'COMM100', 'description' => 'Business Communication', 'units' => 3, 'year_level' => 2, 'trimester' => 1],

            // 2nd Year - 2nd Trimester
            ['code' => 'MKT100', 'description' => 'Marketing Management', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'FIN100', 'description' => 'Financial Management', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'HRM100', 'description' => 'Human Resource Management', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'LAW100', 'description' => 'Business Law', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'STAT100', 'description' => 'Business Statistics', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'IT100', 'description' => 'Information Technology for HTM', 'units' => 3, 'year_level' => 2, 'trimester' => 2],

            // 2nd Year - 3rd Trimester
            ['code' => 'OPS100', 'description' => 'Operations Management', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'QUAL100', 'description' => 'Quality Management', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'SAFETY100', 'description' => 'Safety and Sanitation', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'ETHIC100', 'description' => 'Professional Ethics in HTM', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'LANG100', 'description' => 'Foreign Language (Basic)', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'CULTURE100', 'description' => 'Cultural Sensitivity and Awareness', 'units' => 3, 'year_level' => 2, 'trimester' => 3],

            // 3rd Year - 1st Trimester
            ['code' => 'LEAD100', 'description' => 'Leadership and Team Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'ENT100', 'description' => 'Entrepreneurship in HTM', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'SUSTAIN100', 'description' => 'Sustainable Tourism and Hospitality', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'RES100', 'description' => 'Research Methods in HTM', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'CRISIS100', 'description' => 'Crisis Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],

            // 3rd Year - 2nd Trimester
            ['code' => 'STRAT100', 'description' => 'Strategic Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'INNOVATE100', 'description' => 'Innovation in HTM', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'GLOBAL100', 'description' => 'Global Perspectives in HTM', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'TRENDS100', 'description' => 'Current Trends and Issues', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'CONSUMER100', 'description' => 'Consumer Behavior', 'units' => 3, 'year_level' => 3, 'trimester' => 2],

            // 3rd Year - 3rd Trimester
            ['code' => 'OJT100', 'description' => 'On-the-Job Training', 'units' => 6, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'THESIS100', 'description' => 'Thesis/Capstone Project', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'SEMINAR100', 'description' => 'HTM Seminar', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'PORTFOLIO100', 'description' => 'Professional Portfolio', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
        ];

        $htmPrograms = [
            'BS Hospitality Management',
            'BS Tourism Management'
        ];

        foreach ($commonSubjects as $index => $subject) {
            foreach ($htmPrograms as $program) {
                $this->createSubject($subject, $program, null, $index + 1);
            }
        }
    }

    private function generateHospitalityTourismPrograms()
    {
        $programs = [
            'BS Hospitality Management' => [
                // Specialized Hospitality Management subjects
                ['code' => 'HOSP100', 'description' => 'Hotel Operations Management', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'HOSP200', 'description' => 'Front Office Operations', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'HOSP300', 'description' => 'Housekeeping Operations', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'FOOD100', 'description' => 'Food and Beverage Service', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'FOOD200', 'description' => 'Food Production and Kitchen Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'CULINARY100', 'description' => 'Culinary Arts and Menu Planning', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'BAR100', 'description' => 'Bar and Beverage Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'EVENT100', 'description' => 'Event Management and Catering', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'REVENUE100', 'description' => 'Revenue Management', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'PROP100', 'description' => 'Property Management Systems', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'GUEST100', 'description' => 'Guest Relations and Customer Service', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'FACILITIES100', 'description' => 'Facilities Management', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ],
            'BS Tourism Management' => [
                // Specialized Tourism Management subjects
                ['code' => 'TOUR100', 'description' => 'Tourism Principles and Practices', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'TOUR200', 'description' => 'Tour Operations Management', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'TOUR300', 'description' => 'Travel Agency Operations', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'DEST100', 'description' => 'Destination Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'ECO100', 'description' => 'Ecotourism and Nature-Based Tourism', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'HERITAGE100', 'description' => 'Cultural Heritage Tourism', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'MICE100', 'description' => 'MICE Tourism (Meetings, Incentives, Conventions, Exhibitions)', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'TRANSPORT100', 'description' => 'Transportation and Logistics', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'PLANNING100', 'description' => 'Tourism Planning and Development', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'GEOG100', 'description' => 'Tourism Geography', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'GUIDE100', 'description' => 'Tour Guiding and Interpretation', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'POLICY100', 'description' => 'Tourism Policy and Governance', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ],
        ];

        $sortOrder = 50; // Start after common subjects

        foreach ($programs as $course => $subjects) {
            foreach ($subjects as $subject) {
                $this->createSubject($subject, $course, null, $sortOrder++);
            }
        }
    }

    private function createSubject($subjectData, $course = null, $track = null, $sortOrder = 1)
    {
        Subject::create([
            'code' => $subjectData['code'],
            'description' => $subjectData['description'],
            'units' => $subjectData['units'],
            'year_level' => $subjectData['year_level'],
            'trimester' => $subjectData['trimester'],
            'course' => $course,
            'track' => $track,
            'sort_order' => $sortOrder,
        ]);
    }
}
