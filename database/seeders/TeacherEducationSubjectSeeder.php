<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class TeacherEducationSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create common teacher education subjects for all programs
        $this->createCommonTeacherEducationSubjects();
        
        // Create specific subjects for each teacher education program
        $this->generateTeacherEducationPrograms();
    }

    private function createCommonTeacherEducationSubjects()
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
            ['code' => 'EDUC100', 'description' => 'Introduction to Teaching Profession', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'CHILD100', 'description' => 'Child and Adolescent Development', 'units' => 3, 'year_level' => 1, 'trimester' => 3],

            // 2nd Year - 1st Trimester
            ['code' => 'PE4', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'PSYC100', 'description' => 'General Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'EDUC200', 'description' => 'Principles of Teaching', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'CURR100', 'description' => 'Curriculum Development', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ASSESS100', 'description' => 'Assessment in Learning', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'EDPSYC100', 'description' => 'Educational Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],

            // 2nd Year - 2nd Trimester
            ['code' => 'EDUC300', 'description' => 'Facilitating Learning', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'TECH100', 'description' => 'Educational Technology', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'RESEARCH100', 'description' => 'Research in Education', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'FOUND100', 'description' => 'Foundation of Education', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'INCLUSIVE100', 'description' => 'Inclusive Education', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'CLASSROOM100', 'description' => 'Classroom Management', 'units' => 3, 'year_level' => 2, 'trimester' => 2],

            // 2nd Year - 3rd Trimester
            ['code' => 'FIELDSTD100', 'description' => 'Field Study 1 - Observation of Teaching Learning', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'MULTICULT100', 'description' => 'Multicultural Education', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'PEACE100', 'description' => 'Peace Education', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'ENV100', 'description' => 'Environmental Education', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'HEALTH100', 'description' => 'Health Education', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'VALUES100', 'description' => 'Values Education', 'units' => 3, 'year_level' => 2, 'trimester' => 3],

            // 3rd Year - 1st Trimester
            ['code' => 'FIELDSTD200', 'description' => 'Field Study 2 - Experiencing the Teaching-Learning Process', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'PEDAGOGY100', 'description' => 'Pedagogy and Methods of Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'MICROTCH100', 'description' => 'Micro Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'GUIDANCE100', 'description' => 'Guidance and Counseling', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'READING100', 'description' => 'Reading and Literacy Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1],

            // 3rd Year - 2nd Trimester
            ['code' => 'PRACTICE100', 'description' => 'Practice Teaching Seminar', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'ACTION100', 'description' => 'Action Research', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'PROF100', 'description' => 'Professional Development', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'COMMUNITY100', 'description' => 'Community Engagement', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'ETHICS100', 'description' => 'Professional Ethics for Teachers', 'units' => 3, 'year_level' => 3, 'trimester' => 2],

            // 3rd Year - 3rd Trimester
            ['code' => 'TEACHING100', 'description' => 'Practice Teaching/Student Teaching', 'units' => 6, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'DEMO100', 'description' => 'Demonstration Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'PORTFOLIO100', 'description' => 'Teaching Portfolio', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'LET100', 'description' => 'LET Review and Preparation', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
        ];

        $teacherEducationPrograms = [
            'BS Elementary Education',
            'BS Secondary Education'
        ];

        foreach ($commonSubjects as $index => $subject) {
            foreach ($teacherEducationPrograms as $program) {
                $this->createSubject($subject, $program, null, $index + 1);
            }
        }
    }

    private function generateTeacherEducationPrograms()
    {
        $programs = [
            'BS Elementary Education' => [
                'tracks' => ['General Education', 'Special Education'],
                'subjects' => [
                    'General Education' => [
                        ['code' => 'ELEM100', 'description' => 'Elementary Mathematics Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ELEM200', 'description' => 'Elementary Science Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ELEM300', 'description' => 'Elementary English Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ELEM400', 'description' => 'Elementary Filipino Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ELEM500', 'description' => 'Elementary Social Studies Teaching', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ELEM600', 'description' => 'Arts and Crafts in Elementary', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ELEM700', 'description' => 'Music and Movement in Elementary', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'ELEM800', 'description' => 'Physical Education in Elementary', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'ELEM900', 'description' => 'Elementary Curriculum Planning', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Special Education' => [
                        ['code' => 'SPED100', 'description' => 'Introduction to Special Education', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SPED200', 'description' => 'Psychology of Exceptional Children', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SPED300', 'description' => 'Assessment of Exceptional Learners', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SPED400', 'description' => 'Individualized Education Program', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SPED500', 'description' => 'Behavior Management for Special Needs', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SPED600', 'description' => 'Assistive Technology in Special Education', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SPED700', 'description' => 'Family and Community Collaboration', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'SPED800', 'description' => 'Inclusive Classroom Strategies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'SPED900', 'description' => 'Special Education Practicum', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                ]
            ],
            'BS Secondary Education' => [
                'tracks' => ['Mathematics', 'English', 'Science', 'Social Studies'],
                'subjects' => [
                    'Mathematics' => [
                        ['code' => 'MATHSEC100', 'description' => 'College Algebra', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                        ['code' => 'MATHSEC200', 'description' => 'Plane and Spherical Trigonometry', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                        ['code' => 'MATHSEC300', 'description' => 'Analytic Geometry', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                        ['code' => 'MATHSEC400', 'description' => 'Calculus 1', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'MATHSEC500', 'description' => 'Calculus 2', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'MATHSEC600', 'description' => 'Statistics and Probability', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'MATHSEC700', 'description' => 'Teaching Mathematics in Secondary', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'MATHSEC800', 'description' => 'Mathematics Technology Integration', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'MATHSEC900', 'description' => 'Mathematics Assessment Methods', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'English' => [
                        ['code' => 'ENGSEC100', 'description' => 'Structure of English', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                        ['code' => 'ENGSEC200', 'description' => 'Philippine Literature', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                        ['code' => 'ENGSEC300', 'description' => 'World Literature', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                        ['code' => 'ENGSEC400', 'description' => 'Creative Writing', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ENGSEC500', 'description' => 'Language Teaching Methodology', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ENGSEC600', 'description' => 'Speech and Theater Arts', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'ENGSEC700', 'description' => 'Teaching English in Secondary', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'ENGSEC800', 'description' => 'English Language Assessment', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'ENGSEC900', 'description' => 'Literature Teaching Strategies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Science' => [
                        ['code' => 'SCISEC100', 'description' => 'General Biology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                        ['code' => 'SCISEC200', 'description' => 'General Chemistry', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                        ['code' => 'SCISEC300', 'description' => 'General Physics', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                        ['code' => 'SCISEC400', 'description' => 'Earth and Environmental Science', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SCISEC500', 'description' => 'Laboratory Techniques and Safety', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SCISEC600', 'description' => 'Science Research Methods', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SCISEC700', 'description' => 'Teaching Science in Secondary', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SCISEC800', 'description' => 'Science Laboratory Management', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'SCISEC900', 'description' => 'Science Assessment and Evaluation', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                    ],
                    'Social Studies' => [
                        ['code' => 'SOCSEC100', 'description' => 'Philippine History and Government', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                        ['code' => 'SOCSEC200', 'description' => 'World History and Civilizations', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                        ['code' => 'SOCSEC300', 'description' => 'Geography and Environment', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                        ['code' => 'SOCSEC400', 'description' => 'Economics and Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SOCSEC500', 'description' => 'Political Science and Governance', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SOCSEC600', 'description' => 'Sociology and Anthropology', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                        ['code' => 'SOCSEC700', 'description' => 'Teaching Social Studies in Secondary', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                        ['code' => 'SOCSEC800', 'description' => 'Social Studies Research and Inquiry', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                        ['code' => 'SOCSEC900', 'description' => 'Current Issues and Trends', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
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
