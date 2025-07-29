<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class BusinessAdministrationSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create common business subjects for all programs
        $this->createCommonBusinessSubjects();
        
        // Create specific subjects for each business program
        $this->generateBusinessPrograms();
    }

    private function createCommonBusinessSubjects()
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
            ['code' => 'BUS100', 'description' => 'Introduction to Business', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'ACC100', 'description' => 'Fundamentals of Accounting', 'units' => 3, 'year_level' => 1, 'trimester' => 3],

            // 2nd Year - 1st Trimester
            ['code' => 'PE4', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ECON100', 'description' => 'Principles of Economics', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'STAT100', 'description' => 'Business Statistics', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'PSYC100', 'description' => 'General Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'BUS200', 'description' => 'Business Ethics and Social Responsibility', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'LAW100', 'description' => 'Business Law', 'units' => 3, 'year_level' => 2, 'trimester' => 1],

            // 2nd Year - 2nd Trimester
            ['code' => 'ECON200', 'description' => 'Microeconomics', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'ACC200', 'description' => 'Financial Accounting', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'MGT100', 'description' => 'Principles of Management', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'MKT100', 'description' => 'Principles of Marketing', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'FIN100', 'description' => 'Business Finance', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'IT100', 'description' => 'Information Technology for Business', 'units' => 3, 'year_level' => 2, 'trimester' => 2],

            // 2nd Year - 3rd Trimester
            ['code' => 'ECON300', 'description' => 'Macroeconomics', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'ACC300', 'description' => 'Management Accounting', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'OB100', 'description' => 'Organizational Behavior', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'QM100', 'description' => 'Quantitative Methods in Business', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'BUS300', 'description' => 'Business Communication', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'RES100', 'description' => 'Business Research Methods', 'units' => 3, 'year_level' => 2, 'trimester' => 3],

            // 3rd Year - 1st Trimester
            ['code' => 'HRM100', 'description' => 'Human Resource Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'OPS100', 'description' => 'Operations Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'INT100', 'description' => 'International Business', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'TAX100', 'description' => 'Taxation', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'FIN200', 'description' => 'Financial Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],

            // 3rd Year - 2nd Trimester
            ['code' => 'STR100', 'description' => 'Strategic Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'PM100', 'description' => 'Project Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'QC100', 'description' => 'Quality Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'LOG100', 'description' => 'Supply Chain and Logistics Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'CSR100', 'description' => 'Corporate Social Responsibility', 'units' => 3, 'year_level' => 3, 'trimester' => 2],

            // 3rd Year - 3rd Trimester
            ['code' => 'PRAC100', 'description' => 'Practicum/Internship', 'units' => 6, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'CAP100', 'description' => 'Capstone Project', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'SEM100', 'description' => 'Business Seminar', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'ENT100', 'description' => 'Entrepreneurship', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
        ];

        foreach ($commonSubjects as $index => $subject) {
            // Create common subjects for each Business Administration program
            $businessPrograms = [
                'BS Business Administration',
                'BS Entrepreneurship', 
                'BS Office Administration',
                'BS Real Estate Management',
                'BS Digital Marketing'
            ];
            
            foreach ($businessPrograms as $program) {
                $this->createSubject($subject, $program, null, $index + 1);
            }
        }
    }

    private function generateBusinessPrograms()
    {
        $programs = [
            'BS Business Administration' => [
                'tracks' => ['Management', 'Marketing', 'Finance'],
                'subjects' => [
                    // Track-specific subjects for 3rd year
                    'Management' => [
                        ['code' => 'MGT300', 'description' => 'Advanced Management Theory', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'MGT400', 'description' => 'Leadership and Change Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'MGT500', 'description' => 'Management Case Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Marketing' => [
                        ['code' => 'MKT300', 'description' => 'Consumer Behavior', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'MKT400', 'description' => 'Digital Marketing Strategies', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'MKT500', 'description' => 'Marketing Research and Analytics', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Finance' => [
                        ['code' => 'FIN300', 'description' => 'Investment Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'FIN400', 'description' => 'Financial Planning and Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'FIN500', 'description' => 'Corporate Finance Case Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                ]
            ],
            'BS Entrepreneurship' => [
                'tracks' => ['Business Development', 'Innovation Management', 'Startup Operations'],
                'subjects' => [
                    'Business Development' => [
                        ['code' => 'ENT200', 'description' => 'Business Development Strategies', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ENT300', 'description' => 'Market Expansion and Growth', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ENT400', 'description' => 'Business Development Practicum', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Innovation Management' => [
                        ['code' => 'INN200', 'description' => 'Innovation and Creativity', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'INN300', 'description' => 'Technology Transfer and Commercialization', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'INN400', 'description' => 'Innovation Management Case Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Startup Operations' => [
                        ['code' => 'STO200', 'description' => 'Startup Business Models', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'STO300', 'description' => 'Venture Capital and Funding', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'STO400', 'description' => 'Startup Operations Lab', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                ]
            ],
            'BS Office Administration' => [
                'tracks' => ['Executive Support', 'Records Management', 'Office Systems'],
                'subjects' => [
                    'Executive Support' => [
                        ['code' => 'ES200', 'description' => 'Executive Support and Assistance', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ES300', 'description' => 'Administrative Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ES400', 'description' => 'Executive Support Practicum', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Records Management' => [
                        ['code' => 'RM200', 'description' => 'Records and Information Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'RM300', 'description' => 'Digital Archives and Document Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'RM400', 'description' => 'Records Management Systems', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Office Systems' => [
                        ['code' => 'OS200', 'description' => 'Office Systems and Procedures', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'OS300', 'description' => 'Office Automation and Technology', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'OS400', 'description' => 'Office Systems Integration', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                ]
            ],
            'BS Real Estate Management' => [
                'tracks' => ['Property Development', 'Real Estate Sales', 'Property Management'],
                'subjects' => [
                    'Property Development' => [
                        ['code' => 'PD200', 'description' => 'Property Development and Planning', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'PD300', 'description' => 'Real Estate Investment Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'PD400', 'description' => 'Property Development Case Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Real Estate Sales' => [
                        ['code' => 'RES200', 'description' => 'Real Estate Sales and Marketing', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'RES300', 'description' => 'Real Estate Law and Ethics', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'RES400', 'description' => 'Real Estate Sales Practicum', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Property Management' => [
                        ['code' => 'PM200', 'description' => 'Property Management Principles', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'PM300', 'description' => 'Facility Management and Maintenance', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'PM400', 'description' => 'Property Management Systems', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                ]
            ],
            'BS Digital Marketing' => [
                'tracks' => ['Social Media Marketing', 'Content Marketing', 'E-commerce Marketing'],
                'subjects' => [
                    'Social Media Marketing' => [
                        ['code' => 'SMM200', 'description' => 'Social Media Strategy and Planning', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SMM300', 'description' => 'Social Media Analytics and Metrics', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SMM400', 'description' => 'Social Media Campaign Management', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Content Marketing' => [
                        ['code' => 'CM200', 'description' => 'Content Strategy and Creation', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'CM300', 'description' => 'Digital Content Production', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'CM400', 'description' => 'Content Marketing Analytics', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'E-commerce Marketing' => [
                        ['code' => 'ECM200', 'description' => 'E-commerce Platforms and Systems', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ECM300', 'description' => 'Online Customer Experience Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ECM400', 'description' => 'E-commerce Marketing Strategies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                ]
            ],
        ];

        $sortOrder = 50; // Start after common subjects

        foreach ($programs as $course => $programData) {
            foreach ($programData['tracks'] as $track) {
                if (isset($programData['subjects'][$track])) {
                    foreach ($programData['subjects'][$track] as $subject) {
                        $this->createSubject($subject, $course, $track, $sortOrder++);
                    }
                }
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
