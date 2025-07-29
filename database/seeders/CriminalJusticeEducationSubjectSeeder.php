<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class CriminalJusticeEducationSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create common criminal justice subjects for all programs
        $this->createCommonCriminalJusticeSubjects();
        
        // Create specific subjects for each criminal justice program
        $this->generateCriminalJusticePrograms();
    }

    private function createCommonCriminalJusticeSubjects()
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
            ['code' => 'CRIM100', 'description' => 'Introduction to Criminology', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'LAWENF100', 'description' => 'Introduction to Law Enforcement', 'units' => 3, 'year_level' => 1, 'trimester' => 3],

            // 2nd Year - 1st Trimester
            ['code' => 'PE4', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'PSYC100', 'description' => 'General Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'SOC100', 'description' => 'Introduction to Sociology', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'CRIM200', 'description' => 'Theories of Crime Causation', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'LAW100', 'description' => 'Criminal Law 1', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'STAT100', 'description' => 'Statistics for Criminal Justice', 'units' => 3, 'year_level' => 2, 'trimester' => 1],

            // 2nd Year - 2nd Trimester
            ['code' => 'CRIM300', 'description' => 'Juvenile Delinquency', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'LAW200', 'description' => 'Criminal Law 2', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'PROC100', 'description' => 'Criminal Procedure', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'PSYC200', 'description' => 'Criminal Psychology', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'COMM100', 'description' => 'Police Communication', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'ETHICS100', 'description' => 'Police Ethics and Values', 'units' => 3, 'year_level' => 2, 'trimester' => 2],

            // 2nd Year - 3rd Trimester
            ['code' => 'CRIM400', 'description' => 'Victimology', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'INV100', 'description' => 'Criminal Investigation', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'CORR100', 'description' => 'Correctional Administration', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'FIRE100', 'description' => 'Fire Protection and Arson Investigation', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'TRAFFIC100', 'description' => 'Traffic Management and Accident Investigation', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'CYBER100', 'description' => 'Cybercrime Investigation', 'units' => 3, 'year_level' => 2, 'trimester' => 3],

            // 3rd Year - 1st Trimester
            ['code' => 'ADM100', 'description' => 'Police Administration', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'INTEL100', 'description' => 'Intelligence and Counter-Intelligence', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'SECURITY100', 'description' => 'Industrial Security Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'DRUG100', 'description' => 'Drug Education and Vice Control', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'RES100', 'description' => 'Research Methods in Criminal Justice', 'units' => 3, 'year_level' => 3, 'trimester' => 1],

            // 3rd Year - 2nd Trimester
            ['code' => 'TERRORISM100', 'description' => 'Terrorism and Homeland Security', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'CRIME100', 'description' => 'Crime Prevention and Community Relations', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'LEGAL100', 'description' => 'Legal Medicine', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'COURT100', 'description' => 'Court Testimony and Evidence', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'CRISIS100', 'description' => 'Crisis Management and Disaster Response', 'units' => 3, 'year_level' => 3, 'trimester' => 2],

            // 3rd Year - 3rd Trimester
            ['code' => 'OJT100', 'description' => 'On-the-Job Training', 'units' => 6, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'THESIS100', 'description' => 'Thesis Writing', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'SEMINAR100', 'description' => 'Criminal Justice Seminar', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'BOARD100', 'description' => 'Board Exam Review', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
        ];

        $criminalJusticePrograms = [
            'BS Criminology',
            'BS Forensic Science'
        ];

        foreach ($commonSubjects as $index => $subject) {
            foreach ($criminalJusticePrograms as $program) {
                $this->createSubject($subject, $program, null, $index + 1);
            }
        }
    }

    private function generateCriminalJusticePrograms()
    {
        $programs = [
            'BS Criminology' => [
                // Specialized Criminology subjects
                ['code' => 'CRIM500', 'description' => 'Advanced Criminological Theory', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'CRIM600', 'description' => 'White Collar Crime', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'CRIM700', 'description' => 'Organized Crime', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'CRIM800', 'description' => 'Comparative Criminology', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'CRIM900', 'description' => 'Criminal Justice System', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'CRIM1000', 'description' => 'Criminology Case Studies', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'CRIM1100', 'description' => 'Crime Analysis and Mapping', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'CRIM1200', 'description' => 'Criminal Profiling', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'CRIM1300', 'description' => 'Penology and Prison Management', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ],
            'BS Forensic Science' => [
                // Specialized Forensic Science subjects
                ['code' => 'FOR100', 'description' => 'Introduction to Forensic Science', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
                ['code' => 'FOR200', 'description' => 'Crime Scene Processing', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
                ['code' => 'FOR300', 'description' => 'Forensic Photography', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
                ['code' => 'FOR400', 'description' => 'Fingerprint Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'FOR500', 'description' => 'Ballistics and Firearms Identification', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'FOR600', 'description' => 'DNA Analysis and Serology', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
                ['code' => 'FOR700', 'description' => 'Toxicology and Drug Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
                ['code' => 'FOR800', 'description' => 'Digital Forensics', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
                ['code' => 'FOR900', 'description' => 'Forensic Laboratory Management', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
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
