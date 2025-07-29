<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class LawSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create subjects for College of Law
        $this->createLawSubjects();
    }

    private function createLawSubjects()
    {
        $lawSubjects = [
            // 1st Year - 1st Semester
            ['code' => 'LAW101', 'description' => 'Introduction to Law and Legal System', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'LAW102', 'description' => 'Constitutional Law I', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'LAW103', 'description' => 'Persons and Family Relations', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'LAW104', 'description' => 'Legal Research and Writing I', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'LAW105', 'description' => 'Statutory Construction', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'LAW106', 'description' => 'Legal Philosophy', 'units' => 3, 'year_level' => 1, 'semester' => 1],
            ['code' => 'LAW107', 'description' => 'Legal Ethics and Professional Responsibility', 'units' => 3, 'year_level' => 1, 'semester' => 1],

            // 1st Year - 2nd Semester
            ['code' => 'LAW108', 'description' => 'Constitutional Law II', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'LAW109', 'description' => 'Property', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'LAW110', 'description' => 'Contracts and Quasi-Contracts', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'LAW111', 'description' => 'Legal Research and Writing II', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'LAW112', 'description' => 'Legal History', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'LAW113', 'description' => 'Human Rights Law', 'units' => 3, 'year_level' => 1, 'semester' => 2],
            ['code' => 'LAW114', 'description' => 'Legal Sociology', 'units' => 3, 'year_level' => 1, 'semester' => 2],

            // 2nd Year - 1st Semester
            ['code' => 'LAW201', 'description' => 'Criminal Law I', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'LAW202', 'description' => 'Torts and Damages', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'LAW203', 'description' => 'Succession', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'LAW204', 'description' => 'Administrative Law', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'LAW205', 'description' => 'Political Law', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'LAW206', 'description' => 'Legal Advocacy and Trial Techniques', 'units' => 3, 'year_level' => 2, 'semester' => 1],
            ['code' => 'LAW207', 'description' => 'Alternative Dispute Resolution', 'units' => 3, 'year_level' => 2, 'semester' => 1],

            // 2nd Year - 2nd Semester
            ['code' => 'LAW208', 'description' => 'Criminal Law II', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'LAW209', 'description' => 'Sales and Agency', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'LAW210', 'description' => 'Partnership and Corporation Law', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'LAW211', 'description' => 'Public International Law', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'LAW212', 'description' => 'Taxation Law I', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'LAW213', 'description' => 'Commercial Law', 'units' => 3, 'year_level' => 2, 'semester' => 2],
            ['code' => 'LAW214', 'description' => 'Environmental Law', 'units' => 3, 'year_level' => 2, 'semester' => 2],

            // 3rd Year - 1st Semester
            ['code' => 'LAW301', 'description' => 'Criminal Procedure', 'units' => 3, 'year_level' => 3, 'semester' => 1],
            ['code' => 'LAW302', 'description' => 'Civil Procedure', 'units' => 3, 'year_level' => 3, 'semester' => 1],
            ['code' => 'LAW303', 'description' => 'Labor Law I', 'units' => 3, 'year_level' => 3, 'semester' => 1],
            ['code' => 'LAW304', 'description' => 'Evidence', 'units' => 3, 'year_level' => 3, 'semester' => 1],
            ['code' => 'LAW305', 'description' => 'Banking and Finance Law', 'units' => 3, 'year_level' => 3, 'semester' => 1],
            ['code' => 'LAW306', 'description' => 'Intellectual Property Law', 'units' => 3, 'year_level' => 3, 'semester' => 1],
            ['code' => 'LAW307', 'description' => 'Insurance Law', 'units' => 3, 'year_level' => 3, 'semester' => 1],

            // 3rd Year - 2nd Semester
            ['code' => 'LAW308', 'description' => 'Special Proceedings', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'LAW309', 'description' => 'Labor Law II', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'LAW310', 'description' => 'Taxation Law II', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'LAW311', 'description' => 'Private International Law', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'LAW312', 'description' => 'Securities Regulation Law', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'LAW313', 'description' => 'Information Technology Law', 'units' => 3, 'year_level' => 3, 'semester' => 2],
            ['code' => 'LAW314', 'description' => 'Family Code and Related Laws', 'units' => 3, 'year_level' => 3, 'semester' => 2],

            // 4th Year - 1st Semester
            ['code' => 'LAW401', 'description' => 'Remedial Law I', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'LAW402', 'description' => 'Legal Medicine', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'LAW403', 'description' => 'Legal Clinic I', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'LAW404', 'description' => 'Moot Court Competition', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'LAW405', 'description' => 'Comparative Constitutional Law', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'LAW406', 'description' => 'Election Law', 'units' => 3, 'year_level' => 4, 'semester' => 1],
            ['code' => 'LAW407', 'description' => 'Local Government Law', 'units' => 3, 'year_level' => 4, 'semester' => 1],

            // 4th Year - 2nd Semester
            ['code' => 'LAW408', 'description' => 'Remedial Law II', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'LAW409', 'description' => 'Legal Clinic II', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'LAW410', 'description' => 'Thesis/Legal Research Project', 'units' => 6, 'year_level' => 4, 'semester' => 2],
            ['code' => 'LAW411', 'description' => 'Bar Examination Review I', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'LAW412', 'description' => 'Bar Examination Review II', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'LAW413', 'description' => 'Practicum in Law Office Management', 'units' => 3, 'year_level' => 4, 'semester' => 2],
            ['code' => 'LAW414', 'description' => 'Legal Internship', 'units' => 3, 'year_level' => 4, 'semester' => 2],
        ];

        foreach ($lawSubjects as $index => $subject) {
            $this->createSubject($subject, 'Bachelor of Laws', null, $index + 1);
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
