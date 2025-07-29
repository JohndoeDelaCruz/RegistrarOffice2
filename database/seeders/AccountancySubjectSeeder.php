<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class AccountancySubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create subjects for College of Accountancy
        $this->createAccountancySubjects();
    }

    private function createAccountancySubjects()
    {
        $accountancySubjects = [
            // 1st Year - 1st Trimester
            ['code' => 'NSTP1', 'description' => 'National Service Training Program 1', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'PE1', 'description' => 'Physical Education 1', 'units' => 2, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'FIL1', 'description' => 'Kontekstwalisadong Komunikasyon sa Filipino', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'ENG1', 'description' => 'Purposive Communication', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'MATH1', 'description' => 'Mathematics in the Modern World', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'SCI1', 'description' => 'Science, Technology and Society', 'units' => 3, 'year_level' => 1, 'trimester' => 1],
            ['code' => 'ACC101', 'description' => 'Fundamentals of Accounting', 'units' => 3, 'year_level' => 1, 'trimester' => 1],

            // 1st Year - 2nd Trimester
            ['code' => 'NSTP2', 'description' => 'National Service Training Program 2', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'PE2', 'description' => 'Physical Education 2', 'units' => 2, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'RIZAL', 'description' => 'Life and Works of Rizal', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'PHIL1', 'description' => 'Introduction to Philosophy of the Human Person', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'HIST1', 'description' => 'Readings in Philippine History', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'UTS', 'description' => 'Understanding the Self', 'units' => 3, 'year_level' => 1, 'trimester' => 2],
            ['code' => 'ACC102', 'description' => 'Intermediate Accounting 1', 'units' => 3, 'year_level' => 1, 'trimester' => 2],

            // 1st Year - 3rd Trimester
            ['code' => 'PE3', 'description' => 'Physical Education 3', 'units' => 2, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'ART1', 'description' => 'Art Appreciation', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'ETH1', 'description' => 'Ethics', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'SOC1', 'description' => 'The Contemporary World', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'ECON101', 'description' => 'Principles of Economics with Agrarian Reform and Taxation', 'units' => 3, 'year_level' => 1, 'trimester' => 3],
            ['code' => 'ACC103', 'description' => 'Intermediate Accounting 2', 'units' => 3, 'year_level' => 1, 'trimester' => 3],

            // 2nd Year - 1st Trimester
            ['code' => 'PE4', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'STAT101', 'description' => 'Business Statistics', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ACC201', 'description' => 'Intermediate Accounting 3', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'ACC202', 'description' => 'Cost Accounting', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'BUS101', 'description' => 'Organization and Management', 'units' => 3, 'year_level' => 2, 'trimester' => 1],
            ['code' => 'BLAW101', 'description' => 'Business Law', 'units' => 3, 'year_level' => 2, 'trimester' => 1],

            // 2nd Year - 2nd Trimester
            ['code' => 'ACC203', 'description' => 'Advanced Accounting 1', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'ACC204', 'description' => 'Management Advisory Services', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'TAX101', 'description' => 'Income Taxation', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'FIN101', 'description' => 'Financial Management', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'MKT101', 'description' => 'Principles of Marketing', 'units' => 3, 'year_level' => 2, 'trimester' => 2],
            ['code' => 'IT101', 'description' => 'Information Technology for Accountants', 'units' => 3, 'year_level' => 2, 'trimester' => 2],

            // 2nd Year - 3rd Trimester
            ['code' => 'ACC205', 'description' => 'Advanced Accounting 2', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'AUDIT101', 'description' => 'Auditing and Assurance Services 1', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'TAX102', 'description' => 'Business Taxation', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'ECON102', 'description' => 'Macroeconomics', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'BLAW102', 'description' => 'Corporation Law', 'units' => 3, 'year_level' => 2, 'trimester' => 3],
            ['code' => 'HRM101', 'description' => 'Human Resource Management', 'units' => 3, 'year_level' => 2, 'trimester' => 3],

            // 3rd Year - 1st Trimester
            ['code' => 'ACC301', 'description' => 'Advanced Accounting 3', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'AUDIT102', 'description' => 'Auditing and Assurance Services 2', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'ACC302', 'description' => 'Accounting for Government and Non-Profit Organizations', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'ACC303', 'description' => 'Accounting Information Systems', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'FIN102', 'description' => 'Investment and Portfolio Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1],
            ['code' => 'QM101', 'description' => 'Quantitative Methods in Business', 'units' => 3, 'year_level' => 3, 'trimester' => 1],

            // 3rd Year - 2nd Trimester
            ['code' => 'ACC304', 'description' => 'Financial Statement Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'AUDIT103', 'description' => 'Advanced Auditing', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'ACC305', 'description' => 'International Accounting', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'TAX103', 'description' => 'Advanced Taxation', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'BLAW103', 'description' => 'Partnership and Corporation Law', 'units' => 3, 'year_level' => 3, 'trimester' => 2],
            ['code' => 'ENT101', 'description' => 'Entrepreneurship', 'units' => 3, 'year_level' => 3, 'trimester' => 2],

            // 3rd Year - 3rd Trimester
            ['code' => 'ACC306', 'description' => 'Management Accounting', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'ACC307', 'description' => 'Special Accounting Topics', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'AUDIT104', 'description' => 'IT Audit and Control', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'FIN103', 'description' => 'Corporate Finance', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'BLAW104', 'description' => 'Law on Sales, Negotiable Instruments, and Banking', 'units' => 3, 'year_level' => 3, 'trimester' => 3],
            ['code' => 'ETHICS101', 'description' => 'Professional Ethics for Accountants', 'units' => 3, 'year_level' => 3, 'trimester' => 3],

            // 4th Year - 1st Trimester
            ['code' => 'ACC401', 'description' => 'Forensic Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 1],
            ['code' => 'ACC402', 'description' => 'Public Sector Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 1],
            ['code' => 'AUDIT105', 'description' => 'Internal Auditing', 'units' => 3, 'year_level' => 4, 'trimester' => 1],
            ['code' => 'ACC403', 'description' => 'Environmental Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 1],
            ['code' => 'RESEARCH101', 'description' => 'Research Methods in Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 1],
            ['code' => 'ELECTIVE1', 'description' => 'Professional Elective 1', 'units' => 3, 'year_level' => 4, 'trimester' => 1],

            // 4th Year - 2nd Trimester
            ['code' => 'ACC404', 'description' => 'Strategic Cost Management', 'units' => 3, 'year_level' => 4, 'trimester' => 2],
            ['code' => 'ACC405', 'description' => 'Banking and Finance Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 2],
            ['code' => 'TAX104', 'description' => 'Tax Planning and Tax Research', 'units' => 3, 'year_level' => 4, 'trimester' => 2],
            ['code' => 'ACC406', 'description' => 'Contemporary Issues in Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 2],
            ['code' => 'STRAT101', 'description' => 'Strategic Management', 'units' => 3, 'year_level' => 4, 'trimester' => 2],
            ['code' => 'ELECTIVE2', 'description' => 'Professional Elective 2', 'units' => 3, 'year_level' => 4, 'trimester' => 2],

            // 4th Year - 3rd Trimester
            ['code' => 'ACC407', 'description' => 'Financial Reporting Standards', 'units' => 3, 'year_level' => 4, 'trimester' => 3],
            ['code' => 'ACC408', 'description' => 'Risk Management and Insurance', 'units' => 3, 'year_level' => 4, 'trimester' => 3],
            ['code' => 'AUDIT106', 'description' => 'Fraud Examination', 'units' => 3, 'year_level' => 4, 'trimester' => 3],
            ['code' => 'ACC409', 'description' => 'Accounting Theory and Practice', 'units' => 3, 'year_level' => 4, 'trimester' => 3],
            ['code' => 'THESIS101', 'description' => 'Accounting Research and Thesis Writing 1', 'units' => 3, 'year_level' => 4, 'trimester' => 3],
            ['code' => 'ELECTIVE3', 'description' => 'Professional Elective 3', 'units' => 3, 'year_level' => 4, 'trimester' => 3],

            // 5th Year - 1st Trimester
            ['code' => 'ACC501', 'description' => 'Advanced Financial Reporting', 'units' => 3, 'year_level' => 5, 'trimester' => 1],
            ['code' => 'ACC502', 'description' => 'Corporate Governance and Business Ethics', 'units' => 3, 'year_level' => 5, 'trimester' => 1],
            ['code' => 'ACC503', 'description' => 'Digital Accounting and Analytics', 'units' => 3, 'year_level' => 5, 'trimester' => 1],
            ['code' => 'AUDIT107', 'description' => 'Specialized Auditing Topics', 'units' => 3, 'year_level' => 5, 'trimester' => 1],
            ['code' => 'THESIS102', 'description' => 'Accounting Research and Thesis Writing 2', 'units' => 3, 'year_level' => 5, 'trimester' => 1],
            ['code' => 'PRACTICUM1', 'description' => 'Accounting Practicum 1', 'units' => 3, 'year_level' => 5, 'trimester' => 1],

            // 5th Year - 2nd Trimester
            ['code' => 'ACC504', 'description' => 'International Financial Reporting Standards', 'units' => 3, 'year_level' => 5, 'trimester' => 2],
            ['code' => 'ACC505', 'description' => 'Sustainability Accounting and Reporting', 'units' => 3, 'year_level' => 5, 'trimester' => 2],
            ['code' => 'ACC506', 'description' => 'Accounting for Mergers and Acquisitions', 'units' => 3, 'year_level' => 5, 'trimester' => 2],
            ['code' => 'ACC507', 'description' => 'Professional Practice and Career Development', 'units' => 3, 'year_level' => 5, 'trimester' => 2],
            ['code' => 'PRACTICUM2', 'description' => 'Accounting Practicum 2', 'units' => 6, 'year_level' => 5, 'trimester' => 2],
            ['code' => 'SEMINAR101', 'description' => 'Accounting Professional Seminar', 'units' => 3, 'year_level' => 5, 'trimester' => 2],

            // 5th Year - 3rd Trimester
            ['code' => 'ACC508', 'description' => 'Comprehensive Accounting Review', 'units' => 6, 'year_level' => 5, 'trimester' => 3],
            ['code' => 'ACC509', 'description' => 'CPA Board Examination Review', 'units' => 6, 'year_level' => 5, 'trimester' => 3],
            ['code' => 'CAPSTONE101', 'description' => 'Accounting Capstone Project', 'units' => 3, 'year_level' => 5, 'trimester' => 3],
            ['code' => 'PORTFOLIO101', 'description' => 'Professional Portfolio Development', 'units' => 3, 'year_level' => 5, 'trimester' => 3],
        ];

        $course = 'Bachelor of Accountancy';
        
        foreach ($accountancySubjects as $index => $subject) {
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
            'trimester' => $subjectData['trimester'],
            'course' => $course,
            'track' => $track,
            'sort_order' => $sortOrder,
        ]);
    }
}
