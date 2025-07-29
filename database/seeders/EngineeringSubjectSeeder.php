<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class EngineeringSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sortOrder = 1;

        // Common Engineering Subjects (1st Year) - All Programs
        $this->createCommonSubjects($sortOrder);

        // Engineering Programs Configuration
        $programs = [
            'BS Architecture' => [
                'prefix' => 'ARCH',
                'subjects' => [
                    2 => [
                        1 => ['Architectural Design 1:4', 'History of Architecture 1', 'Building Construction 1'],
                        2 => ['Architectural Design 2:4', 'History of Architecture 2', 'Building Construction 2']
                    ],
                    3 => [
                        1 => ['Architectural Design 3:5', 'Structural Systems in Architecture', 'Environmental Science for Architecture', 'Building Services 1'],
                        2 => ['Architectural Design 4:5', 'Site Planning and Landscape Architecture', 'Building Services 2', 'Architectural Theory and Criticism']
                    ],
                    4 => [
                        1 => ['Architectural Design 5:6', 'Professional Practice in Architecture', 'Construction Project Management', 'Specifications and Cost Estimation'],
                        2 => ['Architectural Design 6 (Thesis):6', 'Urban Planning and Design', 'Architecture and Society', 'Sustainable Architecture']
                    ]
                ]
            ],
            'BS Civil Engineering' => [
                'prefix' => 'CE',
                'subjects' => [
                    2 => [
                        1 => ['Surveying 1', 'Engineering Mechanics (Statics)', 'Engineering Materials'],
                        2 => ['Surveying 2', 'Engineering Mechanics (Dynamics)', 'Strength of Materials']
                    ],
                    3 => [
                        1 => ['Fluid Mechanics', 'Structural Analysis 1', 'Soil Mechanics'],
                        2 => ['Hydraulics', 'Structural Analysis 2', 'Foundation Engineering', 'Concrete Technology']
                    ],
                    4 => [
                        1 => ['Reinforced Concrete Design', 'Steel Design', 'Water Resources Engineering', 'Transportation Engineering'],
                        2 => ['Civil Engineering Project', 'Construction Engineering and Management', 'Environmental Engineering', 'Professional Practice in Civil Engineering']
                    ]
                ]
            ],
            'BS Computer Engineering' => [
                'prefix' => 'CPE',
                'subjects' => [
                    2 => [
                        1 => ['Computer Programming 1', 'Digital Logic Design', 'Circuit Analysis 1'],
                        2 => ['Computer Programming 2', 'Discrete Mathematics', 'Circuit Analysis 2']
                    ],
                    3 => [
                        1 => ['Data Structures and Algorithms', 'Computer Architecture and Organization', 'Microprocessors and Microcontrollers'],
                        2 => ['Database Systems', 'Operating Systems', 'Embedded Systems', 'Electronics Engineering']
                    ],
                    4 => [
                        1 => ['Software Engineering', 'Computer Networks', 'Digital Signal Processing', 'Computer Engineering Design 1'],
                        2 => ['Computer Engineering Design 2 (Thesis)', 'Mobile Computing', 'Artificial Intelligence', 'Professional Practice in Computer Engineering']
                    ]
                ]
            ],
            'BS Electronics Engineering' => [
                'prefix' => 'ECE',
                'subjects' => [
                    2 => [
                        1 => ['Circuit Analysis 1', 'Computer Programming for Engineers', 'Electronic Devices and Circuits'],
                        2 => ['Circuit Analysis 2', 'Electronic Circuit Analysis and Design', 'Digital Logic Design']
                    ],
                    3 => [
                        1 => ['Electronics Engineering', 'Signals and Systems', 'Microprocessors and Microcontrollers'],
                        2 => ['Communication Systems', 'Control Systems', 'Digital Signal Processing', 'Electromagnetic Fields and Waves']
                    ],
                    4 => [
                        1 => ['Electronics Design 1', 'Industrial Electronics', 'Power Electronics', 'Instrumentation and Control'],
                        2 => ['Electronics Design 2 (Thesis)', 'Optical Electronics', 'Wireless Communications', 'Professional Practice in Electronics Engineering']
                    ]
                ]
            ],
            'BS Environmental Engineering' => [
                'prefix' => 'ENVE',
                'subjects' => [
                    2 => [
                        1 => ['Environmental Science and Engineering', 'Analytical Chemistry', 'General Biology'],
                        2 => ['Environmental Chemistry', 'Environmental Microbiology', 'Statistics']
                    ],
                    3 => [
                        1 => ['Water Quality Engineering', 'Air Pollution Control', 'Solid Waste Management'],
                        2 => ['Wastewater Treatment', 'Environmental Impact Assessment', 'Environmental Geology', 'Environmental Law and Policy']
                    ],
                    4 => [
                        1 => ['Environmental Engineering Design 1', 'Industrial Pollution Control', 'Environmental Monitoring and Analysis', 'Renewable Energy Systems'],
                        2 => ['Environmental Engineering Design 2 (Thesis)', 'Sustainable Development', 'Climate Change and Adaptation', 'Professional Practice in Environmental Engineering']
                    ]
                ]
            ]
        ];

        // Generate subjects for each program
        foreach ($programs as $course => $config) {
            $this->generateProgramSubjects($course, $config, $sortOrder);
        }
    }

    private function createCommonSubjects(&$sortOrder)
    {
        $commonSubjects = [
            1 => [
                1 => ['College Algebra', 'General Physics 1', 'General Chemistry', 'English Communication 1', 'Physical Education 1:2', 'National Service Training Program 1', 'Introduction to Engineering'],
                2 => ['Trigonometry', 'General Physics 2', 'Organic Chemistry', 'English Communication 2', 'Physical Education 2:2', 'National Service Training Program 2', 'Engineering Drawing and CAD']
            ],
            2 => [
                1 => ['Calculus 1', 'Philosophy of Human Person', 'Physical Education 3:2'],
                2 => ['Calculus 2', 'Philippine History', 'Physical Education 4:2']
            ],
            3 => [
                1 => ['Differential Equations', 'Life and Works of Rizal'],
                2 => ['Art Appreciation']
            ],
            4 => [
                1 => ['Engineering Management'],
                2 => ['Engineering Ethics']
            ]
        ];

        foreach ($commonSubjects as $year => $semesters) {
            foreach ($semesters as $trimester => $subjects) {
                foreach ($subjects as $subjectDesc) {
                    $this->createSubject('All Engineering Programs', $year, $trimester, $subjectDesc, $sortOrder);
                }
            }
        }
    }

    private function generateProgramSubjects($course, $config, &$sortOrder)
    {
        foreach ($config['subjects'] as $year => $semesters) {
            foreach ($semesters as $trimester => $subjects) {
                foreach ($subjects as $index => $subjectDesc) {
                    $code = $config['prefix'] . $year . str_pad($trimester . ($index + 1), 2, '0', STR_PAD_LEFT);
                    $this->createSubject($course, $year, $trimester, $subjectDesc, $sortOrder, $code);
                }
            }
        }
    }

    private function createSubject($course, $year, $trimester, $subjectDesc, &$sortOrder, $customCode = null, $track = null)
    {
        // Parse subject description for units (default 3)
        $units = 3;
        if (strpos($subjectDesc, ':') !== false) {
            [$subjectDesc, $units] = explode(':', $subjectDesc);
        }

        // Generate code if not provided
        if (!$customCode) {
            $prefixes = [
                'College Algebra' => 'MATH101', 'Trigonometry' => 'MATH102', 'Calculus 1' => 'MATH201', 'Calculus 2' => 'MATH202',
                'General Physics 1' => 'PHYS101', 'General Physics 2' => 'PHYS102',
                'General Chemistry' => 'CHEM101', 'Organic Chemistry' => 'CHEM102',
                'English Communication 1' => 'ENG101', 'English Communication 2' => 'ENG102',
                'Physical Education 1' => 'PE101', 'Physical Education 2' => 'PE102', 'Physical Education 3' => 'PE201', 'Physical Education 4' => 'PE202',
                'National Service Training Program 1' => 'NSTP101', 'National Service Training Program 2' => 'NSTP102',
                'Introduction to Engineering' => 'ENGR101', 'Engineering Drawing and CAD' => 'ENGR102',
                'Philosophy of Human Person' => 'PHIL201', 'Philippine History' => 'SOCSCI201',
                'Differential Equations' => 'MATH301', 'Life and Works of Rizal' => 'RIZAL301',
                'Art Appreciation' => 'ARTS301', 'Engineering Management' => 'ENGR401', 'Engineering Ethics' => 'ETHICS401'
            ];
            $customCode = $prefixes[$subjectDesc] ?? 'GEN' . $year . str_pad($sortOrder, 3, '0', STR_PAD_LEFT);
        }

        Subject::create([
            'code' => $customCode,
            'description' => $subjectDesc,
            'units' => (int)$units,
            'year_level' => $year,
            'trimester' => $trimester,
            'course' => $course,
            'track' => $track,
            'sort_order' => $sortOrder++,
        ]);
    }
}
