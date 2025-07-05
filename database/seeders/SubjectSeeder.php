<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course = 'BSIT'; // Updated to match student data
        
        // Common subjects (no specific track)
        $commonSubjects = [
            // First Year - First Trimester
            ['code' => 'GE 101', 'description' => 'Understanding the Self', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'GE 102', 'description' => 'Mathematics in the Modern World', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'GE 103', 'description' => 'Purposive Communication', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 101', 'description' => 'Introduction to Computing', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 102', 'description' => 'Computer Programming 1', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 101', 'description' => 'Physical Education 1', 'units' => 2, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // First Year - Second Trimester
            ['code' => 'GE 104', 'description' => 'Art Appreciation', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'GE 105', 'description' => 'Science, Technology and Society', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'CS 103', 'description' => 'Computer Programming 2', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 104', 'description' => 'Discrete Mathematics', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 105', 'description' => 'Web Development 1', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 102', 'description' => 'Physical Education 2', 'units' => 2, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // First Year - Third Trimester
            ['code' => 'GE 106', 'description' => 'Ethics', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 1],
            ['code' => 'GE 107', 'description' => 'The Contemporary World', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 2],
            ['code' => 'CS 106', 'description' => 'Data Structures and Algorithms', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 107', 'description' => 'Computer Architecture', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 108', 'description' => 'Database Management Systems', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 103', 'description' => 'Physical Education 3', 'units' => 2, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 6],

            // Second Year - First Trimester
            ['code' => 'GE 201', 'description' => 'Readings in Philippine History', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'CS 201', 'description' => 'Object-Oriented Programming', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'CS 202', 'description' => 'Information Management', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 203', 'description' => 'Operating Systems', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 204', 'description' => 'Web Development 2', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 201', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // Second Year - Second Trimester
            ['code' => 'GE 202', 'description' => 'Life and Works of Rizal', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'CS 205', 'description' => 'Computer Networks', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'CS 206', 'description' => 'Software Engineering 1', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 207', 'description' => 'Human Computer Interaction', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 208', 'description' => 'Systems Analysis and Design', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'NSTP 201', 'description' => 'National Service Training Program 1', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // Second Year - Third Trimester
            ['code' => 'GE 203', 'description' => 'Gender and Society', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 1],
            ['code' => 'CS 209', 'description' => 'Advanced Database Systems', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 2],
            ['code' => 'CS 210', 'description' => 'Information Security', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 211', 'description' => 'Programming Languages', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 212', 'description' => 'Project Management', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 5],
            ['code' => 'NSTP 202', 'description' => 'National Service Training Program 2', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 6],

            // Third Year Common Subjects
            ['code' => 'GE 301', 'description' => 'Environmental Science', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 6],
            ['code' => 'GE 302', 'description' => 'Social Issues and Professional Practice', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 6],
            ['code' => 'GE 303', 'description' => 'Entrepreneurship', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 6],
        ];

        // Web Technology Track Subjects
        $webTechSubjects = [
            // Third Year - First Trimester
            ['code' => 'CS 301', 'description' => 'Advanced Web Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 1],
            ['code' => 'CS 302', 'description' => 'Frontend Frameworks', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 2],
            ['code' => 'CS 303', 'description' => 'Backend Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 3],
            ['code' => 'CS 304', 'description' => 'API Development & Integration', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 4],
            ['code' => 'CS 305', 'description' => 'Web Performance Optimization', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 5],

            // Third Year - Second Trimester
            ['code' => 'CS 306', 'description' => 'Mobile Web Development', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 1],
            ['code' => 'CS 307', 'description' => 'Progressive Web Apps', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 2],
            ['code' => 'CS 308', 'description' => 'Web Analytics & SEO', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 3],
            ['code' => 'CS 309', 'description' => 'E-commerce Development', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 4],
            ['code' => 'CS 310', 'description' => 'Content Management Systems', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 5],

            // Third Year - Third Trimester
            ['code' => 'CS 311', 'description' => 'Full Stack Development Project', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 1],
            ['code' => 'CS 312', 'description' => 'Web Capstone Project 1', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 2],
            ['code' => 'CS 313', 'description' => 'Advanced JavaScript & Frameworks', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 3],
            ['code' => 'CS 314', 'description' => 'DevOps & Cloud Deployment', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 4],
            ['code' => 'CS 315', 'description' => 'Web Development Internship Prep', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 5],
        ];

        // Cybersecurity Track Subjects
        $cyberSecuritySubjects = [
            // Third Year - First Trimester
            ['code' => 'CS 301', 'description' => 'Network Security Fundamentals', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Cybersecurity Track', 'sort_order' => 1],
            ['code' => 'CS 302', 'description' => 'Ethical Hacking & Penetration Testing', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Cybersecurity Track', 'sort_order' => 2],
            ['code' => 'CS 303', 'description' => 'Digital Forensics', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Cybersecurity Track', 'sort_order' => 3],
            ['code' => 'CS 304', 'description' => 'Incident Response & Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Cybersecurity Track', 'sort_order' => 4],
            ['code' => 'CS 305', 'description' => 'Risk Assessment & Compliance', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Cybersecurity Track', 'sort_order' => 5],

            // Third Year - Second Trimester
            ['code' => 'CS 306', 'description' => 'Advanced Network Security', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Cybersecurity Track', 'sort_order' => 1],
            ['code' => 'CS 307', 'description' => 'Cybersecurity Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Cybersecurity Track', 'sort_order' => 2],
            ['code' => 'CS 308', 'description' => 'Malware Analysis', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Cybersecurity Track', 'sort_order' => 3],
            ['code' => 'CS 309', 'description' => 'Security Architecture Design', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Cybersecurity Track', 'sort_order' => 4],
            ['code' => 'CS 310', 'description' => 'Wireless & Mobile Security', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Cybersecurity Track', 'sort_order' => 5],

            // Third Year - Third Trimester
            ['code' => 'CS 311', 'description' => 'Advanced Penetration Testing', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Cybersecurity Track', 'sort_order' => 1],
            ['code' => 'CS 312', 'description' => 'Security Capstone Project 1', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Cybersecurity Track', 'sort_order' => 2],
            ['code' => 'CS 313', 'description' => 'Cloud Security & Compliance', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Cybersecurity Track', 'sort_order' => 3],
            ['code' => 'CS 314', 'description' => 'Security Operations Center (SOC)', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Cybersecurity Track', 'sort_order' => 4],
            ['code' => 'CS 315', 'description' => 'Cybersecurity Internship Prep', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Cybersecurity Track', 'sort_order' => 5],
        ];

        // Insert all subjects
        foreach ($commonSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($webTechSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($cyberSecuritySubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }
    }
}
