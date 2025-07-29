<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class ArtsAndSciencesSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create common liberal arts subjects for all programs
        $this->createCommonArtsAndSciencesSubjects();
        
        // Create specific subjects for each arts and sciences program
        $this->generateArtsAndSciencesPrograms();
    }

    private function createCommonArtsAndSciencesSubjects()
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
            ['code' => 'LIT1', 'description' => 'Introduction to Literature', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'LOGIC1', 'description' => 'Logic and Critical Thinking', 'units' => 3, 'year_level' => 1, 'trimester' => 3],

            // 2nd Year - 1st Trimester
            ['code' => 'PE4', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'HIST2', 'description' => 'Asian Civilization', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'PSYC1', 'description' => 'General Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'SOC2', 'description' => 'Introduction to Sociology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ANTH1', 'description' => 'Cultural Anthropology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ECON1', 'description' => 'Principles of Economics', 'units' => 3, 'year_level' => 2, 'trimester' => 1],

            // 2nd Year - 2nd Trimester
            ['code' => 'PHIL2', 'description' => 'Philosophy of Science', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'HIST3', 'description' => 'World History', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'POL1', 'description' => 'Introduction to Political Science', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'COMM1', 'description' => 'Fundamentals of Communication', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'STAT1', 'description' => 'Statistics for Social Sciences', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'RES1', 'description' => 'Introduction to Research Methods', 'units' => 3, 'year_level' => 2, 'trimester' => 2],

            // 2nd Year - 3rd Trimester
            ['code' => 'LING1', 'description' => 'Introduction to Linguistics', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'LIT2', 'description' => 'Philippine Literature', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'PHIL3', 'description' => 'Social Philosophy', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'GEOG1', 'description' => 'Human Geography', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'ARTS1', 'description' => 'Humanities and the Arts', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'MUS1', 'description' => 'Music Appreciation', 'units' => 3, 'year_level' => 2, 'trimester' => 3],

            // 3rd Year - 1st Trimester
            ['code' => 'RES2', 'description' => 'Research Methods in Liberal Arts', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'THEO1', 'description' => 'Theories in Social Sciences', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'CULT1', 'description' => 'Cultural Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'COMP1', 'description' => 'Comparative Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'INTERDIS1', 'description' => 'Interdisciplinary Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 1],

            // 3rd Year - 2nd Trimester
            ['code' => 'SEMINAR1', 'description' => 'Senior Seminar', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'ETHICS2', 'description' => 'Professional Ethics', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'MEDIA1', 'description' => 'Media and Society', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'GLOB1', 'description' => 'Globalization Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'GENDER1', 'description' => 'Gender Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 2],

            // 3rd Year - 3rd Trimester
            ['code' => 'THESIS1', 'description' => 'Thesis Writing', 'units' => 6, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'PRAC1', 'description' => 'Field Work/Practicum', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'CAP1', 'description' => 'Capstone Project', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'PORTFOLIO1', 'description' => 'Academic Portfolio', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
        ];

        $artsAndSciencesPrograms = [
            'BA English Language Studies',
            'BA Political Science',
            'BA Communication',
            'BS Psychology',
            'BS Behavioral Science'
        ];

        foreach ($commonSubjects as $index => $subject) {
            foreach ($artsAndSciencesPrograms as $program) {
                $this->createSubject($subject, $program, null, $index + 1);
            }
        }
    }

    private function generateArtsAndSciencesPrograms()
    {
        $programs = [
            'BA English Language Studies' => [
                // Major subjects specific to English Language Studies
                ['code' => 'ENG200', 'description' => 'English Grammar and Composition', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'ENG300', 'description' => 'English Literature Survey', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'ENG400', 'description' => 'American Literature', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'ENG500', 'description' => 'British Literature', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'ENG600', 'description' => 'World Literature', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'ENG700', 'description' => 'Creative Writing', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'ENG800', 'description' => 'Applied Linguistics', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'ENG900', 'description' => 'English Language Teaching Methods', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'ENG1000', 'description' => 'Literary Criticism and Theory', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ],
            'BA Political Science' => [
                // Major subjects specific to Political Science
                ['code' => 'POLS200', 'description' => 'Philippine Government and Politics', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'POLS300', 'description' => 'Comparative Government', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'POLS400', 'description' => 'International Relations', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'POLS500', 'description' => 'Political Theory', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'POLS600', 'description' => 'Public Administration', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'POLS700', 'description' => 'Constitutional Law', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'POLS800', 'description' => 'Diplomacy and Foreign Policy', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'POLS900', 'description' => 'Political Economy', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'POLS1000', 'description' => 'Local Government and Administration', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ],
            'BA Communication' => [
                // Major subjects specific to Communication
                ['code' => 'COMM200', 'description' => 'Mass Communication', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'COMM300', 'description' => 'Journalism and News Writing', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'COMM400', 'description' => 'Broadcasting and Media Production', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'COMM500', 'description' => 'Public Relations and Advertising', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'COMM600', 'description' => 'Digital Media and Communication', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'COMM700', 'description' => 'Communication Research Methods', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'COMM800', 'description' => 'Organizational Communication', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'COMM900', 'description' => 'Media Ethics and Law', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'COMM1000', 'description' => 'Communication Campaign Design', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ],
            'BS Psychology' => [
                // Major subjects specific to Psychology
                ['code' => 'PSYC200', 'description' => 'Developmental Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'PSYC300', 'description' => 'Abnormal Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'PSYC400', 'description' => 'Social Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'PSYC500', 'description' => 'Cognitive Psychology', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'PSYC600', 'description' => 'Personality Psychology', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'PSYC700', 'description' => 'Psychological Testing and Assessment', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'PSYC800', 'description' => 'Research Methods in Psychology', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'PSYC900', 'description' => 'Counseling Psychology', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'PSYC1000', 'description' => 'Industrial and Organizational Psychology', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ],
            'BS Behavioral Science' => [
                // Major subjects specific to Behavioral Science
                ['code' => 'BEHAV200', 'description' => 'Human Behavior and Environment', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'BEHAV300', 'description' => 'Behavioral Analysis and Modification', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'BEHAV400', 'description' => 'Group Dynamics and Behavior', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'BEHAV500', 'description' => 'Criminal Behavior and Psychology', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'BEHAV600', 'description' => 'Organizational Behavior Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'BEHAV700', 'description' => 'Behavioral Research Methods', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'BEHAV800', 'description' => 'Applied Behavior Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'BEHAV900', 'description' => 'Community Behavior and Social Change', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'BEHAV1000', 'description' => 'Behavioral Science Practicum', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
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
