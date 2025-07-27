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
        $this->createBSITSubjects();
        $this->createLawSubjects();
        $this->createAccountancySubjects();
    }

    private function createBSITSubjects()
    {
        $course = 'BSIT'; // Course code for BSIT students
        
        // Common subjects (no specific track) - Years 1 & 2
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
            ['code' => 'CS 202', 'description' => 'Systems Analysis and Design', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 203', 'description' => 'Computer Networks', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 204', 'description' => 'Operating Systems', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 201', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // Second Year - Second Trimester
            ['code' => 'GE 202', 'description' => 'Life and Works of Rizal', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'CS 205', 'description' => 'Software Engineering', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'CS 206', 'description' => 'Web Development 2', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 207', 'description' => 'Information Security', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 208', 'description' => 'Human Computer Interaction', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'NSTP 201', 'description' => 'National Service Training Program 1', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // Second Year - Third Trimester
            ['code' => 'GE 203', 'description' => 'Gender and Society', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 1],
            ['code' => 'CS 209', 'description' => 'Advanced Database Systems', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 2],
            ['code' => 'CS 210', 'description' => 'IT Project Management', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 3],
            ['code' => 'CS 211', 'description' => 'Mobile Application Development', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 4],
            ['code' => 'CS 212', 'description' => 'Capstone Project 1', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 5],
            ['code' => 'NSTP 202', 'description' => 'National Service Training Program 2', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 6],

            // Third Year Common Subjects
            ['code' => 'GE 301', 'description' => 'Environmental Science', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 6],
            ['code' => 'GE 302', 'description' => 'Social Issues and Professional Practice', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 6],
            ['code' => 'GE 303', 'description' => 'Entrepreneurship', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 6],
        ];

        // Web Technology Track Subjects (Year 3)
        $webTechSubjects = [
            // Third Year - First Trimester
            ['code' => 'CS 301', 'description' => 'Advanced Web Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 1],
            ['code' => 'CS 302', 'description' => 'Frontend Frameworks', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 2],
            ['code' => 'CS 303', 'description' => 'Backend Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 3],
            ['code' => 'CS 304', 'description' => 'API Development & Integration', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 4],
            ['code' => 'CS 305', 'description' => 'Web Security Fundamentals', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Web Technology Track', 'sort_order' => 5],

            // Third Year - Second Trimester
            ['code' => 'CS 306', 'description' => 'Full Stack Development', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 1],
            ['code' => 'CS 307', 'description' => 'Progressive Web Applications', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 2],
            ['code' => 'CS 308', 'description' => 'Web Performance Optimization', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 3],
            ['code' => 'CS 309', 'description' => 'E-commerce Development', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 4],
            ['code' => 'CS 310', 'description' => 'Web Analytics & SEO', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Web Technology Track', 'sort_order' => 5],

            // Third Year - Third Trimester
            ['code' => 'CS 311', 'description' => 'Advanced JavaScript Technologies', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 1],
            ['code' => 'CS 312', 'description' => 'Web Development Capstone Project 1', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 2],
            ['code' => 'CS 313', 'description' => 'Content Management Systems', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 3],
            ['code' => 'CS 314', 'description' => 'DevOps & Cloud Deployment', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 4],
            ['code' => 'CS 315', 'description' => 'Web Development Internship Prep', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Web Technology Track', 'sort_order' => 5],
        ];

        // Cybersecurity Track Subjects (Year 3)
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

        // Database Administration Track Subjects (Year 3)
        $databaseAdminSubjects = [
            // Third Year - First Trimester
            ['code' => 'CS 301', 'description' => 'Advanced Database Design', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Database Administration', 'sort_order' => 1],
            ['code' => 'CS 302', 'description' => 'Database Performance Tuning', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Database Administration', 'sort_order' => 2],
            ['code' => 'CS 303', 'description' => 'Data Warehousing & Business Intelligence', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Database Administration', 'sort_order' => 3],
            ['code' => 'CS 304', 'description' => 'Database Security & Backup Recovery', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Database Administration', 'sort_order' => 4],
            ['code' => 'CS 305', 'description' => 'NoSQL & Big Data Technologies', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Database Administration', 'sort_order' => 5],

            // Third Year - Second Trimester
            ['code' => 'CS 306', 'description' => 'Oracle Database Administration', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Database Administration', 'sort_order' => 1],
            ['code' => 'CS 307', 'description' => 'MySQL & PostgreSQL Administration', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Database Administration', 'sort_order' => 2],
            ['code' => 'CS 308', 'description' => 'Database Automation & Scripting', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Database Administration', 'sort_order' => 3],
            ['code' => 'CS 309', 'description' => 'Cloud Database Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Database Administration', 'sort_order' => 4],
            ['code' => 'CS 310', 'description' => 'Database Migration & Integration', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Database Administration', 'sort_order' => 5],

            // Third Year - Third Trimester
            ['code' => 'CS 311', 'description' => 'Advanced SQL & Query Optimization', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Database Administration', 'sort_order' => 1],
            ['code' => 'CS 312', 'description' => 'Database Capstone Project 1', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Database Administration', 'sort_order' => 2],
            ['code' => 'CS 313', 'description' => 'Database Monitoring & Analytics', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Database Administration', 'sort_order' => 3],
            ['code' => 'CS 314', 'description' => 'Enterprise Database Solutions', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Database Administration', 'sort_order' => 4],
            ['code' => 'CS 315', 'description' => 'Database Administration Internship Prep', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Database Administration', 'sort_order' => 5],
        ];

        // Network Administration Track Subjects (Year 3)
        $networkAdminSubjects = [
            // Third Year - First Trimester
            ['code' => 'CS 301', 'description' => 'Network Infrastructure Design', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Network Administration', 'sort_order' => 1],
            ['code' => 'CS 302', 'description' => 'Cisco Network Configuration', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Network Administration', 'sort_order' => 2],
            ['code' => 'CS 303', 'description' => 'Network Security Implementation', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Network Administration', 'sort_order' => 3],
            ['code' => 'CS 304', 'description' => 'Network Troubleshooting & Diagnostics', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Network Administration', 'sort_order' => 4],
            ['code' => 'CS 305', 'description' => 'Wireless Network Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Network Administration', 'sort_order' => 5],

            // Third Year - Second Trimester
            ['code' => 'CS 306', 'description' => 'Windows Server Administration', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Network Administration', 'sort_order' => 1],
            ['code' => 'CS 307', 'description' => 'Linux Server Administration', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Network Administration', 'sort_order' => 2],
            ['code' => 'CS 308', 'description' => 'Network Monitoring & Performance', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Network Administration', 'sort_order' => 3],
            ['code' => 'CS 309', 'description' => 'Virtual Private Networks (VPN)', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Network Administration', 'sort_order' => 4],
            ['code' => 'CS 310', 'description' => 'Network Automation & Scripting', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Network Administration', 'sort_order' => 5],

            // Third Year - Third Trimester
            ['code' => 'CS 311', 'description' => 'Enterprise Network Solutions', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Network Administration', 'sort_order' => 1],
            ['code' => 'CS 312', 'description' => 'Network Capstone Project 1', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Network Administration', 'sort_order' => 2],
            ['code' => 'CS 313', 'description' => 'Cloud Network Architecture', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Network Administration', 'sort_order' => 3],
            ['code' => 'CS 314', 'description' => 'Network Compliance & Documentation', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Network Administration', 'sort_order' => 4],
            ['code' => 'CS 315', 'description' => 'Network Administration Internship Prep', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Network Administration', 'sort_order' => 5],
        ];

        // Software Development Track Subjects (Year 3)
        $softwareDevSubjects = [
            // Third Year - First Trimester
            ['code' => 'CS 301', 'description' => 'Advanced Software Engineering', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Software Development', 'sort_order' => 1],
            ['code' => 'CS 302', 'description' => 'Mobile Application Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Software Development', 'sort_order' => 2],
            ['code' => 'CS 303', 'description' => 'Software Architecture & Design Patterns', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Software Development', 'sort_order' => 3],
            ['code' => 'CS 304', 'description' => 'Agile Software Development', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Software Development', 'sort_order' => 4],
            ['code' => 'CS 305', 'description' => 'Software Testing & Quality Assurance', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => 'Software Development', 'sort_order' => 5],

            // Third Year - Second Trimester
            ['code' => 'CS 306', 'description' => 'Full Stack Web Development', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Software Development', 'sort_order' => 1],
            ['code' => 'CS 307', 'description' => 'API Development & Integration', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Software Development', 'sort_order' => 2],
            ['code' => 'CS 308', 'description' => 'DevOps & Continuous Integration', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Software Development', 'sort_order' => 3],
            ['code' => 'CS 309', 'description' => 'Cloud Application Development', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Software Development', 'sort_order' => 4],
            ['code' => 'CS 310', 'description' => 'Microservices Architecture', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => 'Software Development', 'sort_order' => 5],

            // Third Year - Third Trimester
            ['code' => 'CS 311', 'description' => 'Advanced Programming Concepts', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Software Development', 'sort_order' => 1],
            ['code' => 'CS 312', 'description' => 'Software Development Capstone Project 1', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Software Development', 'sort_order' => 2],
            ['code' => 'CS 313', 'description' => 'Enterprise Application Development', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Software Development', 'sort_order' => 3],
            ['code' => 'CS 314', 'description' => 'Software Project Management', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Software Development', 'sort_order' => 4],
            ['code' => 'CS 315', 'description' => 'Software Development Internship Prep', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => 'Software Development', 'sort_order' => 5],
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

        foreach ($databaseAdminSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($networkAdminSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($softwareDevSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }
    }

    private function createLawSubjects()
    {
        $course = 'Bachelor of Laws'; // Course code for Law students
        
        // Common law subjects (no specific track)
        $commonLawSubjects = [
            // First Year - First Trimester
            ['code' => 'LAW 101', 'description' => 'Introduction to Law', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 102', 'description' => 'Legal Research and Writing', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 103', 'description' => 'Persons and Family Relations', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'GE 101', 'description' => 'Understanding the Self', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'GE 102', 'description' => 'Purposive Communication', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 101', 'description' => 'Physical Education 1', 'units' => 2, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // First Year - Second Trimester
            ['code' => 'LAW 104', 'description' => 'Constitutional Law 1', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 105', 'description' => 'Obligations and Contracts', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 106', 'description' => 'Torts and Damages', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'GE 103', 'description' => 'The Contemporary World', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'GE 104', 'description' => 'Mathematics in the Modern World', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 102', 'description' => 'Physical Education 2', 'units' => 2, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // First Year - Third Trimester
            ['code' => 'LAW 107', 'description' => 'Criminal Law 1', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 108', 'description' => 'Property Law', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 109', 'description' => 'Legal Ethics', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 3],
            ['code' => 'GE 105', 'description' => 'Readings in Philippine History', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 4],
            ['code' => 'GE 106', 'description' => 'Art Appreciation', 'units' => 3, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 103', 'description' => 'Physical Education 3', 'units' => 2, 'year_level' => 1, 'trimester' => 3, 'track' => null, 'sort_order' => 6],

            // Second Year - First Trimester
            ['code' => 'LAW 201', 'description' => 'Constitutional Law 2', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 202', 'description' => 'Criminal Law 2', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 203', 'description' => 'Sales and Credit Transactions', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 204', 'description' => 'Partnership and Corporation Law', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'GE 107', 'description' => 'Science, Technology and Society', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'PE 201', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // Second Year - Second Trimester
            ['code' => 'LAW 205', 'description' => 'Civil Procedure', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 206', 'description' => 'Criminal Procedure', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 207', 'description' => 'Evidence', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 208', 'description' => 'Negotiable Instruments Law', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'GE 202', 'description' => 'Life and Works of Rizal', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'NSTP 201', 'description' => 'National Service Training Program 1', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // Second Year - Third Trimester
            ['code' => 'LAW 209', 'description' => 'Labor Law', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 210', 'description' => 'Banking and Insurance Law', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 211', 'description' => 'Agency and Trust Receipts', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 212', 'description' => 'Legal Medicine', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 4],
            ['code' => 'GE 203', 'description' => 'Gender and Society', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 5],
            ['code' => 'NSTP 202', 'description' => 'National Service Training Program 2', 'units' => 3, 'year_level' => 2, 'trimester' => 3, 'track' => null, 'sort_order' => 6],

            // Third Year - First Trimester
            ['code' => 'LAW 301', 'description' => 'Administrative Law', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 302', 'description' => 'Taxation Law 1', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 303', 'description' => 'Public International Law', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 304', 'description' => 'Conflict of Laws', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 305', 'description' => 'Wills and Succession', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'GE 301', 'description' => 'Environmental Science', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // Third Year - Second Trimester
            ['code' => 'LAW 306', 'description' => 'Taxation Law 2', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 307', 'description' => 'Private International Law', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 308', 'description' => 'Public Corporations Law', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 309', 'description' => 'Remedial Law 1', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 310', 'description' => 'Land Titles and Deeds', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'GE 302', 'description' => 'Social Issues and Professional Practice', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // Third Year - Third Trimester
            ['code' => 'LAW 311', 'description' => 'Remedial Law 2', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 312', 'description' => 'Intellectual Property Law', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 313', 'description' => 'Legal Forms and Notarial Practice', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 314', 'description' => 'Human Rights Law', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 315', 'description' => 'Environmental Law', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 5],
            ['code' => 'GE 303', 'description' => 'Entrepreneurship', 'units' => 3, 'year_level' => 3, 'trimester' => 3, 'track' => null, 'sort_order' => 6],

            // Fourth Year - First Trimester
            ['code' => 'LAW 401', 'description' => 'Legal Clinic 1', 'units' => 6, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 402', 'description' => 'Practical Exercises in Civil Law', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 403', 'description' => 'Practical Exercises in Criminal Law', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 404', 'description' => 'Practical Exercises in Commercial Law', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 405', 'description' => 'Legal Research and Thesis Writing 1', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 5],

            // Fourth Year - Second Trimester
            ['code' => 'LAW 406', 'description' => 'Legal Clinic 2', 'units' => 6, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 407', 'description' => 'Practical Exercises in Labor Law', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 408', 'description' => 'Practical Exercises in Taxation Law', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 409', 'description' => 'Alternative Dispute Resolution', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 410', 'description' => 'Legal Research and Thesis Writing 2', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 5],

            // Fourth Year - Third Trimester
            ['code' => 'LAW 411', 'description' => 'Legal Clinic 3', 'units' => 6, 'year_level' => 4, 'trimester' => 3, 'track' => null, 'sort_order' => 1],
            ['code' => 'LAW 412', 'description' => 'Bar Review in Civil Law', 'units' => 3, 'year_level' => 4, 'trimester' => 3, 'track' => null, 'sort_order' => 2],
            ['code' => 'LAW 413', 'description' => 'Bar Review in Criminal Law', 'units' => 3, 'year_level' => 4, 'trimester' => 3, 'track' => null, 'sort_order' => 3],
            ['code' => 'LAW 414', 'description' => 'Bar Review in Commercial Law', 'units' => 3, 'year_level' => 4, 'trimester' => 3, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 415', 'description' => 'Legal Research and Thesis Defense', 'units' => 3, 'year_level' => 4, 'trimester' => 3, 'track' => null, 'sort_order' => 5],
        ];

        // Civil Law Specialization Track
        $civilLawSubjects = [
            ['code' => 'LAW 501', 'description' => 'Advanced Civil Law Procedure', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => 'Civil Law', 'sort_order' => 6],
            ['code' => 'LAW 502', 'description' => 'Family Law and Social Services', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => 'Civil Law', 'sort_order' => 6],
            ['code' => 'LAW 503', 'description' => 'Property and Real Estate Law', 'units' => 3, 'year_level' => 4, 'trimester' => 3, 'track' => 'Civil Law', 'sort_order' => 6],
        ];

        // Criminal Law Specialization Track
        $criminalLawSubjects = [
            ['code' => 'LAW 511', 'description' => 'Advanced Criminal Law and Procedure', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => 'Criminal Law', 'sort_order' => 6],
            ['code' => 'LAW 512', 'description' => 'Criminal Investigation and Forensics', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => 'Criminal Law', 'sort_order' => 6],
            ['code' => 'LAW 513', 'description' => 'Juvenile Justice and Rehabilitation', 'units' => 3, 'year_level' => 4, 'trimester' => 3, 'track' => 'Criminal Law', 'sort_order' => 6],
        ];

        // Insert all law subjects
        foreach ($commonLawSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($civilLawSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($criminalLawSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }
    }

    private function createAccountancySubjects()
    {
        $course = 'Bachelor of Science in Accountancy'; // Course code for Accountancy students
        
        // Common accountancy subjects (no specific track)
        $commonAccountancySubjects = [
            // First Year - First Semester
            ['code' => 'GE 101', 'description' => 'Understanding the Self', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'GE 102', 'description' => 'Purposive Communication', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'GE 103', 'description' => 'Mathematics in the Modern World', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'GE 104', 'description' => 'Readings in Philippine History', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'ACC 101', 'description' => 'Fundamentals of Accounting', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'ECON 101', 'description' => 'Microeconomics', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 6],
            ['code' => 'PE 101', 'description' => 'Physical Education 1', 'units' => 2, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 7],
            ['code' => 'NSTP 101', 'description' => 'National Service Training Program 1', 'units' => 3, 'year_level' => 1, 'trimester' => 1, 'track' => null, 'sort_order' => 8],

            // First Year - Second Semester
            ['code' => 'GE 105', 'description' => 'The Contemporary World', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'GE 106', 'description' => 'Art Appreciation', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'GE 107', 'description' => 'Science, Technology and Society', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'GE 108', 'description' => 'Ethics', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'ACC 102', 'description' => 'Advanced Financial Accounting', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'ECON 102', 'description' => 'Macroeconomics', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 6],
            ['code' => 'PE 102', 'description' => 'Physical Education 2', 'units' => 2, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 7],
            ['code' => 'NSTP 102', 'description' => 'National Service Training Program 2', 'units' => 3, 'year_level' => 1, 'trimester' => 2, 'track' => null, 'sort_order' => 8],

            // Second Year - First Semester
            ['code' => 'GE 109', 'description' => 'Life and Works of Rizal', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'MATH 201', 'description' => 'Business Mathematics', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 201', 'description' => 'Intermediate Accounting 1', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'ACC 202', 'description' => 'Cost Accounting and Control', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 201', 'description' => 'Business Law and Ethics', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'STAT 201', 'description' => 'Business Statistics', 'units' => 3, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 6],
            ['code' => 'PE 201', 'description' => 'Physical Education 3', 'units' => 2, 'year_level' => 2, 'trimester' => 1, 'track' => null, 'sort_order' => 7],

            // Second Year - Second Semester
            ['code' => 'GE 110', 'description' => 'Gender and Society', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'MATH 202', 'description' => 'Mathematics of Investment', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 203', 'description' => 'Intermediate Accounting 2', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'ACC 204', 'description' => 'Management Accounting', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'TAX 201', 'description' => 'Taxation 1', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'IT 201', 'description' => 'Information Technology for Accountants', 'units' => 3, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 6],
            ['code' => 'PE 202', 'description' => 'Physical Education 4', 'units' => 2, 'year_level' => 2, 'trimester' => 2, 'track' => null, 'sort_order' => 7],

            // Third Year - First Semester
            ['code' => 'ACC 301', 'description' => 'Intermediate Accounting 3', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'ACC 302', 'description' => 'Advanced Accounting 1', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 303', 'description' => 'Auditing Theory', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'TAX 301', 'description' => 'Taxation 2', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'FIN 301', 'description' => 'Financial Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'MGT 301', 'description' => 'Operations Management', 'units' => 3, 'year_level' => 3, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // Third Year - Second Semester
            ['code' => 'ACC 304', 'description' => 'Advanced Accounting 2', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'ACC 305', 'description' => 'Auditing Problems', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 306', 'description' => 'Accounting for Government and Non-Profit', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'TAX 302', 'description' => 'Business Tax', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'FIN 302', 'description' => 'Investment and Portfolio Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'MGT 302', 'description' => 'Strategic Management', 'units' => 3, 'year_level' => 3, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // Fourth Year - First Semester
            ['code' => 'ACC 401', 'description' => 'Advanced Accounting 3', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'ACC 402', 'description' => 'Advanced Auditing', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 403', 'description' => 'Management Advisory Services', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'ACC 404', 'description' => 'Accounting Research Methods', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'LAW 401', 'description' => 'Corporate Law', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 5],
            ['code' => 'ECON 401', 'description' => 'Managerial Economics', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => null, 'sort_order' => 6],

            // Fourth Year - Second Semester
            ['code' => 'ACC 405', 'description' => 'Forensic Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'ACC 406', 'description' => 'International Accounting', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 407', 'description' => 'Accounting Information Systems', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'ACC 408', 'description' => 'Professional Ethics for Accountants', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'ACC 409', 'description' => 'Comprehensive Accounting Review 1', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
            ['code' => 'MGT 401', 'description' => 'Entrepreneurship and Business Planning', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => null, 'sort_order' => 6],

            // Fifth Year - First Semester
            ['code' => 'ACC 501', 'description' => 'Practicum in Public Accounting', 'units' => 6, 'year_level' => 5, 'trimester' => 1, 'track' => null, 'sort_order' => 1],
            ['code' => 'ACC 502', 'description' => 'Comprehensive Accounting Review 2', 'units' => 3, 'year_level' => 5, 'trimester' => 1, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 503', 'description' => 'CPA Board Exam Review - Theory of Accounts', 'units' => 3, 'year_level' => 5, 'trimester' => 1, 'track' => null, 'sort_order' => 3],
            ['code' => 'ACC 504', 'description' => 'CPA Board Exam Review - Auditing Theory', 'units' => 3, 'year_level' => 5, 'trimester' => 1, 'track' => null, 'sort_order' => 4],
            ['code' => 'ACC 505', 'description' => 'Accounting Thesis 1', 'units' => 3, 'year_level' => 5, 'trimester' => 1, 'track' => null, 'sort_order' => 5],

            // Fifth Year - Second Semester
            ['code' => 'ACC 506', 'description' => 'Practicum in Management Accounting', 'units' => 6, 'year_level' => 5, 'trimester' => 2, 'track' => null, 'sort_order' => 1],
            ['code' => 'ACC 507', 'description' => 'CPA Board Exam Review - Auditing Problems', 'units' => 3, 'year_level' => 5, 'trimester' => 2, 'track' => null, 'sort_order' => 2],
            ['code' => 'ACC 508', 'description' => 'CPA Board Exam Review - Management Services', 'units' => 3, 'year_level' => 5, 'trimester' => 2, 'track' => null, 'sort_order' => 3],
            ['code' => 'ACC 509', 'description' => 'CPA Board Exam Review - Business Law and Taxation', 'units' => 3, 'year_level' => 5, 'trimester' => 2, 'track' => null, 'sort_order' => 4],
            ['code' => 'ACC 510', 'description' => 'Accounting Thesis 2', 'units' => 3, 'year_level' => 5, 'trimester' => 2, 'track' => null, 'sort_order' => 5],
        ];

        // Public Accounting Specialization Track
        $publicAccountingSubjects = [
            ['code' => 'ACC 601', 'description' => 'Advanced Public Accounting Practice', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => 'Public Accounting', 'sort_order' => 7],
            ['code' => 'ACC 602', 'description' => 'Tax Consulting and Planning', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => 'Public Accounting', 'sort_order' => 7],
            ['code' => 'ACC 603', 'description' => 'Public Sector Auditing', 'units' => 3, 'year_level' => 5, 'trimester' => 1, 'track' => 'Public Accounting', 'sort_order' => 6],
            ['code' => 'ACC 604', 'description' => 'International Auditing Standards', 'units' => 3, 'year_level' => 5, 'trimester' => 2, 'track' => 'Public Accounting', 'sort_order' => 6],
        ];

        // Management Accounting Specialization Track
        $managementAccountingSubjects = [
            ['code' => 'ACC 611', 'description' => 'Strategic Cost Management', 'units' => 3, 'year_level' => 4, 'trimester' => 1, 'track' => 'Management Accounting', 'sort_order' => 7],
            ['code' => 'ACC 612', 'description' => 'Performance Management and Control', 'units' => 3, 'year_level' => 4, 'trimester' => 2, 'track' => 'Management Accounting', 'sort_order' => 7],
            ['code' => 'ACC 613', 'description' => 'Corporate Financial Analysis', 'units' => 3, 'year_level' => 5, 'trimester' => 1, 'track' => 'Management Accounting', 'sort_order' => 6],
            ['code' => 'ACC 614', 'description' => 'Internal Audit and Risk Management', 'units' => 3, 'year_level' => 5, 'trimester' => 2, 'track' => 'Management Accounting', 'sort_order' => 6],
        ];

        // Insert all accountancy subjects
        foreach ($commonAccountancySubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($publicAccountingSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }

        foreach ($managementAccountingSubjects as $subject) {
            Subject::create(array_merge($subject, ['course' => $course]));
        }
    }
}
