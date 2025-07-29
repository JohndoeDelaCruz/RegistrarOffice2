<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class ITSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sortOrder = 200; // Start after engineering subjects

        // Common IT Subjects (1st Year) - All IT Programs
        $this->createCommonITSubjects($sortOrder);

        // IT Programs Configuration
        $programs = [
            'BSIT' => [
                'prefix' => 'IT',
                'subjects' => [
                    2 => [
                        1 => ['Object-Oriented Programming', 'Database Management Systems', 'Computer Networks Fundamentals'],
                        2 => ['Web Development 1', 'System Analysis and Design', 'Data Structures and Algorithms'],
                        3 => ['Mobile Application Development', 'Network Security Fundamentals', 'Human Computer Interaction']
                    ],
                    3 => [
                        1 => ['Web Development 2', 'Database Administration', 'Network Administration'],
                        2 => ['Capstone Project 1', 'IT Project Management', 'Systems Integration'],
                        3 => ['Capstone Project 2', 'IT Audit and Security', 'Emerging Technologies']
                    ]
                ],
                'tracks' => [
                    'Web Technology Track' => [
                        2 => [
                            1 => ['Frontend Frameworks', 'Backend Development'],
                            2 => ['Full Stack Development', 'Web APIs and Services'],
                            3 => ['Progressive Web Apps', 'Web Performance Optimization']
                        ],
                        3 => [
                            1 => ['Advanced JavaScript', 'Cloud Computing for Web'],
                            2 => ['DevOps for Web Development', 'Web Security'],
                            3 => ['E-commerce Development', 'Web Analytics']
                        ]
                    ],
                    'Cybersecurity Track' => [
                        2 => [
                            1 => ['Ethical Hacking', 'Cryptography Fundamentals'],
                            2 => ['Network Security', 'Security Auditing'],
                            3 => ['Incident Response', 'Digital Forensics']
                        ],
                        3 => [
                            1 => ['Advanced Cybersecurity', 'Penetration Testing'],
                            2 => ['Security Risk Management', 'Malware Analysis'],
                            3 => ['Cyber Threat Intelligence', 'Security Compliance']
                        ]
                    ],
                    'Database Administration' => [
                        2 => [
                            1 => ['Advanced Database Design', 'Database Programming'],
                            2 => ['Database Performance Tuning', 'Data Warehousing'],
                            3 => ['Big Data Technologies', 'Database Security']
                        ],
                        3 => [
                            1 => ['NoSQL Databases', 'Database Administration'],
                            2 => ['Business Intelligence', 'Data Mining'],
                            3 => ['Cloud Databases', 'Database Disaster Recovery']
                        ]
                    ],
                    'Network Administration' => [
                        2 => [
                            1 => ['Network Infrastructure', 'Router and Switch Configuration'],
                            2 => ['Wireless Networks', 'Network Protocols'],
                            3 => ['Network Troubleshooting', 'VPN Technologies']
                        ],
                        3 => [
                            1 => ['Advanced Networking', 'Network Design'],
                            2 => ['Network Monitoring', 'Quality of Service'],
                            3 => ['Software Defined Networking', 'Network Automation']
                        ]
                    ],
                    'Software Development' => [
                        2 => [
                            1 => ['Software Engineering Principles', 'Advanced Programming'],
                            2 => ['Software Testing', 'Agile Development'],
                            3 => ['Software Architecture', 'Design Patterns']
                        ],
                        3 => [
                            1 => ['Enterprise Application Development', 'API Development'],
                            2 => ['Software Quality Assurance', 'DevOps Practices'],
                            3 => ['Microservices Architecture', 'Software Deployment']
                        ]
                    ]
                ]
            ],
            'BS Data Analytics' => [
                'prefix' => 'DA',
                'subjects' => [
                    2 => [
                        1 => ['Statistical Methods', 'Data Visualization', 'Python for Data Science'],
                        2 => ['Machine Learning Fundamentals', 'Data Mining', 'R Programming'],
                        3 => ['Big Data Analytics', 'Business Intelligence', 'Database for Analytics']
                    ],
                    3 => [
                        1 => ['Advanced Analytics', 'Predictive Modeling', 'Data Engineering'],
                        2 => ['Analytics Capstone 1', 'Data Science Ethics', 'Cloud Analytics'],
                        3 => ['Analytics Capstone 2', 'Industry Analytics', 'Research Methods in Analytics']
                    ]
                ],
                'tracks' => [
                    'Business Intelligence' => [
                        2 => [
                            1 => ['Business Process Analysis', 'Financial Analytics'],
                            2 => ['Marketing Analytics', 'Operations Analytics'],
                            3 => ['Strategic Analytics', 'Performance Management']
                        ],
                        3 => [
                            1 => ['Advanced BI Tools', 'Executive Dashboards'],
                            2 => ['Business Analytics Strategy', 'ROI Analysis'],
                            3 => ['Enterprise Analytics', 'Analytics Consulting']
                        ]
                    ],
                    'Data Science' => [
                        2 => [
                            1 => ['Advanced Statistics', 'Data Science Methodology'],
                            2 => ['Natural Language Processing', 'Computer Vision'],
                            3 => ['Deep Learning', 'Time Series Analysis']
                        ],
                        3 => [
                            1 => ['Advanced Machine Learning', 'Feature Engineering'],
                            2 => ['Model Deployment', 'MLOps'],
                            3 => ['Research in Data Science', 'Advanced AI Applications']
                        ]
                    ],
                    'Machine Learning' => [
                        2 => [
                            1 => ['Supervised Learning', 'Unsupervised Learning'],
                            2 => ['Neural Networks', 'Reinforcement Learning'],
                            3 => ['Advanced ML Algorithms', 'Model Optimization']
                        ],
                        3 => [
                            1 => ['Deep Learning Applications', 'AutoML'],
                            2 => ['ML in Production', 'Model Monitoring'],
                            3 => ['Explainable AI', 'Edge AI']
                        ]
                    ],
                    'Statistical Analysis' => [
                        2 => [
                            1 => ['Advanced Statistical Methods', 'Experimental Design'],
                            2 => ['Multivariate Statistics', 'Bayesian Statistics'],
                            3 => ['Statistical Computing', 'Survey Methodology']
                        ],
                        3 => [
                            1 => ['Advanced Statistical Modeling', 'Causal Inference'],
                            2 => ['Statistical Consulting', 'Quality Control'],
                            3 => ['Applied Statistics Research', 'Statistical Software Development']
                        ]
                    ],
                    'Data Visualization' => [
                        2 => [
                            1 => ['Information Design', 'Interactive Visualizations'],
                            2 => ['Dashboard Development', 'Visual Analytics'],
                            3 => ['Advanced Visualization Tools', 'Storytelling with Data']
                        ],
                        3 => [
                            1 => ['Data Visualization for Web', 'Mobile Analytics Interfaces'],
                            2 => ['Real-time Visualization', 'VR/AR Analytics'],
                            3 => ['Visualization Research', 'Custom Visualization Development']
                        ]
                    ]
                ]
            ]
        ];

        // Generate subjects for each program
        foreach ($programs as $course => $config) {
            $this->generateITPrograms($course, $config, $sortOrder);
        }
    }

    private function createCommonITSubjects(&$sortOrder)
    {
        $commonSubjects = [
            1 => [
                1 => ['Introduction to Computing', 'Programming Fundamentals', 'Discrete Mathematics', 'English for Academic Purposes', 'Physical Education 1:2', 'National Service Training Program 1'],
                2 => ['Computer Programming 1', 'Computer Organization', 'College Algebra', 'Filipino', 'Physical Education 2:2', 'National Service Training Program 2'],
                3 => ['Computer Programming 2', 'Data Structures', 'Statistics for IT', 'Science, Technology and Society', 'Physical Education 3:2']
            ],
            2 => [
                1 => ['Calculus', 'Philosophy of Human Person', 'Physical Education 4:2'],
                2 => ['Linear Algebra', 'Philippine History', 'Ethics'],
                3 => ['Technical Writing', 'Understanding the Self', 'Contemporary World']
            ],
            3 => [
                1 => ['Life and Works of Rizal', 'Professional Ethics in IT'],
                2 => ['Art Appreciation', 'Technopreneurship'],
                3 => ['IT Professional Practice', 'Social Issues and Professional Practice']
            ]
        ];

        foreach ($commonSubjects as $year => $trimesters) {
            foreach ($trimesters as $trimester => $subjects) {
                foreach ($subjects as $subjectDesc) {
                    $this->createSubject('All IT Programs', $year, $trimester, $subjectDesc, $sortOrder);
                }
            }
        }
    }

    private function generateITPrograms($course, $config, &$sortOrder)
    {
        // Create core program subjects
        foreach ($config['subjects'] as $year => $trimesters) {
            foreach ($trimesters as $trimester => $subjects) {
                foreach ($subjects as $index => $subjectDesc) {
                    $code = $config['prefix'] . $year . str_pad($trimester . ($index + 1), 2, '0', STR_PAD_LEFT);
                    $this->createSubject($course, $year, $trimester, $subjectDesc, $sortOrder, $code);
                }
            }
        }

        // Create track-specific subjects if they exist
        if (isset($config['tracks'])) {
            foreach ($config['tracks'] as $trackName => $trackSubjects) {
                foreach ($trackSubjects as $year => $trimesters) {
                    foreach ($trimesters as $trimester => $subjects) {
                        foreach ($subjects as $index => $subjectDesc) {
                            $trackCode = $config['prefix'] . 'T' . $year . str_pad($trimester . ($index + 1), 2, '0', STR_PAD_LEFT);
                            $this->createSubject($course, $year, $trimester, $subjectDesc, $sortOrder, $trackCode, $trackName);
                        }
                    }
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
                // IT Common Subjects
                'Introduction to Computing' => 'CS101', 'Programming Fundamentals' => 'CS102', 'Discrete Mathematics' => 'MATH103',
                'English for Academic Purposes' => 'ENG103', 'Computer Programming 1' => 'CS201', 'Computer Organization' => 'CS202',
                'Filipino' => 'FIL101', 'Computer Programming 2' => 'CS203', 'Data Structures' => 'CS204',
                'Statistics for IT' => 'STAT101', 'Science, Technology and Society' => 'STS101', 'Calculus' => 'MATH203',
                'Linear Algebra' => 'MATH204', 'Ethics' => 'PHIL202', 'Technical Writing' => 'ENG104',
                'Understanding the Self' => 'GE101', 'Contemporary World' => 'GE102', 'Professional Ethics in IT' => 'IT401',
                'Technopreneurship' => 'ENTREP101', 'IT Professional Practice' => 'IT402', 'Social Issues and Professional Practice' => 'IT403',
                // Common subjects shared with Engineering
                'College Algebra' => 'MATH101', 'Physical Education 1' => 'PE101', 'Physical Education 2' => 'PE102', 
                'Physical Education 3' => 'PE201', 'Physical Education 4' => 'PE202',
                'National Service Training Program 1' => 'NSTP101', 'National Service Training Program 2' => 'NSTP102',
                'Philosophy of Human Person' => 'PHIL201', 'Philippine History' => 'SOCSCI201',
                'Life and Works of Rizal' => 'RIZAL301', 'Art Appreciation' => 'ARTS301'
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
