<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            // College of Engineering and Architecture (15 students)
            ['name' => 'John Michael Santos', 'course' => 'BS Architecture', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Maria Isabel Cruz', 'course' => 'BS Architecture', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Carlos Eduardo Reyes', 'course' => 'BS Architecture', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Ana Sofia Garcia', 'course' => 'BS Civil Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Roberto Luis Martinez', 'course' => 'BS Civil Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Elena Carmen Torres', 'course' => 'BS Civil Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Miguel Antonio Lopez', 'course' => 'BS Computer Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Patricia Rose Villanueva', 'course' => 'BS Computer Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Fernando Jose Mendoza', 'course' => 'BS Computer Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Cristina Mae Flores', 'course' => 'BS Electronics Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Rafael James Gomez', 'course' => 'BS Electronics Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Victoria Grace Valdez', 'course' => 'BS Electronics Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Gabriel Alexander Silva', 'course' => 'BS Environmental Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Alejandra Nicole Ramos', 'course' => 'BS Environmental Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],
            ['name' => 'Francisco David Hernandez', 'course' => 'BS Environmental Engineering', 'track' => null, 'college' => 'College of Engineering and Architecture'],

            // College of Information Technology and Computer Science (15 students)
            ['name' => 'John Doe', 'course' => 'BSIT', 'track' => 'Web Technology Track', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Jane Doe', 'course' => 'BSIT', 'track' => 'Cybersecurity Track', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Mark Anthony Luna', 'course' => 'BSIT', 'track' => 'Database Administration', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Sarah Michelle Castro', 'course' => 'BSIT', 'track' => 'Network Administration', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Kevin Joshua Morales', 'course' => 'BSIT', 'track' => 'Software Development', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Andrea Faith Jimenez', 'course' => 'BS Computer Science', 'track' => 'Software Engineering', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Daniel Patrick Perez', 'course' => 'BS Computer Science', 'track' => 'Game Development', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Samantha Joy Vargas', 'course' => 'BS Computer Science', 'track' => 'Artificial Intelligence', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Ryan Christopher Aguilar', 'course' => 'BS Computer Science', 'track' => 'Systems Programming', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Melissa Anne Ruiz', 'course' => 'BS Computer Science', 'track' => 'Mobile Development', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Joshua Emmanuel Navarro', 'course' => 'BS Data Analytics', 'track' => 'Business Intelligence', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Nicole Marie Ortega', 'course' => 'BS Data Analytics', 'track' => 'Data Science', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Christian Paul Guerrero', 'course' => 'BS Data Analytics', 'track' => 'Machine Learning', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Stephanie Rose Medina', 'course' => 'BS Data Analytics', 'track' => 'Statistical Analysis', 'college' => 'College of Information Technology and Computer Science'],
            ['name' => 'Brian Alexander Sandoval', 'course' => 'BS Data Analytics', 'track' => 'Data Visualization', 'college' => 'College of Information Technology and Computer Science'],

            // College of Business Administration (15 students)
            ['name' => 'Isabella Grace Fernandez', 'course' => 'BS Business Administration', 'track' => 'Management', 'college' => 'College of Business Administration'],
            ['name' => 'Matthew John Ramirez', 'course' => 'BS Business Administration', 'track' => 'Marketing', 'college' => 'College of Business Administration'],
            ['name' => 'Sophia Marie Gutierrez', 'course' => 'BS Business Administration', 'track' => 'Finance', 'college' => 'College of Business Administration'],
            ['name' => 'Nathan Carlos Vega', 'course' => 'BS Entrepreneurship', 'track' => 'Business Development', 'college' => 'College of Business Administration'],
            ['name' => 'Olivia Faith Romero', 'course' => 'BS Entrepreneurship', 'track' => 'Innovation Management', 'college' => 'College of Business Administration'],
            ['name' => 'Ethan Miguel Herrera', 'course' => 'BS Entrepreneurship', 'track' => 'Startup Operations', 'college' => 'College of Business Administration'],
            ['name' => 'Emma Catherine Molina', 'course' => 'BS Office Administration', 'track' => 'Executive Support', 'college' => 'College of Business Administration'],
            ['name' => 'Jacob Samuel Campos', 'course' => 'BS Office Administration', 'track' => 'Records Management', 'college' => 'College of Business Administration'],
            ['name' => 'Ava Elizabeth Moreno', 'course' => 'BS Office Administration', 'track' => 'Office Systems', 'college' => 'College of Business Administration'],
            ['name' => 'William Thomas Delgado', 'course' => 'BS Real Estate Management', 'track' => 'Property Development', 'college' => 'College of Business Administration'],
            ['name' => 'Mia Charlotte Paredes', 'course' => 'BS Real Estate Management', 'track' => 'Real Estate Sales', 'college' => 'College of Business Administration'],
            ['name' => 'James Benjamin Rivera', 'course' => 'BS Real Estate Management', 'track' => 'Property Management', 'college' => 'College of Business Administration'],
            ['name' => 'Charlotte Hope Salazar', 'course' => 'BS Digital Marketing', 'track' => 'Social Media Marketing', 'college' => 'College of Business Administration'],
            ['name' => 'Alexander Jose Fuentes', 'course' => 'BS Digital Marketing', 'track' => 'Content Marketing', 'college' => 'College of Business Administration'],
            ['name' => 'Harper Grace Varela', 'course' => 'BS Digital Marketing', 'track' => 'E-commerce Marketing', 'college' => 'College of Business Administration'],

            // College of Arts and Sciences (12 students)
            ['name' => 'Lucas David Morales', 'course' => 'BA English Language Studies', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Lily Rose Castillo', 'course' => 'BA English Language Studies', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Owen Michael Espinoza', 'course' => 'BA English Language Studies', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Zoe Isabella Rojas', 'course' => 'BA Political Science', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Henry Christopher Soto', 'course' => 'BA Political Science', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Grace Abigail Contreras', 'course' => 'BA Communication', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Logan Andrew Figueroa', 'course' => 'BA Communication', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Aria Michelle Guerrero', 'course' => 'BA Communication', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Sebastian Luis Mendez', 'course' => 'BS Psychology', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Maya Sophia Pacheco', 'course' => 'BS Psychology', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Jack Edward Ramos', 'course' => 'BS Behavioral Science', 'track' => null, 'college' => 'College of Arts and Sciences'],
            ['name' => 'Luna Victoria Santos', 'course' => 'BS Behavioral Science', 'track' => null, 'college' => 'College of Arts and Sciences'],

            // College of Teacher Education (12 students)
            ['name' => 'Caleb Jonathan Torres', 'course' => 'BS Elementary Education', 'track' => 'General Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Nora Adelaide Valdez', 'course' => 'BS Elementary Education', 'track' => 'General Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Ian Frederick Silva', 'course' => 'BS Elementary Education', 'track' => 'General Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Isla Katherine Ramos', 'course' => 'BS Elementary Education', 'track' => 'General Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Aaron Jacob Hernandez', 'course' => 'BS Elementary Education', 'track' => 'Special Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Stella Josephine Luna', 'course' => 'BS Elementary Education', 'track' => 'Special Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Eli Mason Castro', 'course' => 'BS Elementary Education', 'track' => 'Special Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Nova Scarlett Morales', 'course' => 'BS Elementary Education', 'track' => 'Special Education', 'college' => 'College of Teacher Education'],
            ['name' => 'Cole Harrison Jimenez', 'course' => 'BS Secondary Education', 'track' => 'Mathematics', 'college' => 'College of Teacher Education'],
            ['name' => 'Violet Penelope Perez', 'course' => 'BS Secondary Education', 'track' => 'English', 'college' => 'College of Teacher Education'],
            ['name' => 'Felix Theodore Vargas', 'course' => 'BS Secondary Education', 'track' => 'Science', 'college' => 'College of Teacher Education'],
            ['name' => 'Aurora Clementine Aguilar', 'course' => 'BS Secondary Education', 'track' => 'Social Studies', 'college' => 'College of Teacher Education'],

            // College of Criminal Justice Education (10 students)
            ['name' => 'Theo Augustus Ruiz', 'course' => 'BS Criminology', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Hazel Cordelia Navarro', 'course' => 'BS Criminology', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Oscar Maximilian Ortega', 'course' => 'BS Criminology', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Ivy Seraphina Guerrero', 'course' => 'BS Criminology', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Leo Constantine Medina', 'course' => 'BS Criminology', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Ruby Evangeline Sandoval', 'course' => 'BS Forensic Science', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Jasper Ambrose Fernandez', 'course' => 'BS Forensic Science', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Sage Genevieve Ramirez', 'course' => 'BS Forensic Science', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Atlas Cornelius Gutierrez', 'course' => 'BS Forensic Science', 'track' => null, 'college' => 'College of Criminal Justice Education'],
            ['name' => 'Iris Persephone Vega', 'course' => 'BS Forensic Science', 'track' => null, 'college' => 'College of Criminal Justice Education'],

            // College of Hospitality and Tourism Management (10 students)
            ['name' => 'Knox Ferdinand Romero', 'course' => 'BS Hospitality Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Wren Ophelia Herrera', 'course' => 'BS Hospitality Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Jude Lysander Molina', 'course' => 'BS Hospitality Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Fern Cassandra Campos', 'course' => 'BS Hospitality Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Rex Leander Moreno', 'course' => 'BS Hospitality Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Sage Minerva Delgado', 'course' => 'BS Tourism Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Cruz Evander Paredes', 'course' => 'BS Tourism Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Dawn Artemis Rivera', 'course' => 'BS Tourism Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Vale Orion Salazar', 'course' => 'BS Tourism Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],
            ['name' => 'Rain Athena Fuentes', 'course' => 'BS Tourism Management', 'track' => null, 'college' => 'College of Hospitality and Tourism Management'],

            // College of Law (10 students)
            ['name' => 'Phoenix Apollo Varela', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Sky Hera Morales', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Storm Zeus Castillo', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'River Demeter Espinoza', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Stone Poseidon Rojas', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Sage Aphrodite Soto', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Blaze Hermes Contreras', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Luna Artemis Figueroa', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Wolf Ares Guerrero', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],
            ['name' => 'Star Persephone Mendez', 'course' => 'Bachelor of Laws', 'track' => null, 'college' => 'College of Law'],

            // College of Accountancy (10 students)
            ['name' => 'Orion Titan Pacheco', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Echo Selene Ramos', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Atlas Helios Santos', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Nova Rhea Torres', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Zephyr Kronos Valdez', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Luna Iris Silva', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Solar Hyperion Ramos', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Star Thalia Hernandez', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Storm Oceanus Luna', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],
            ['name' => 'Rain Nyx Castro', 'course' => 'Bachelor of Accountancy', 'track' => null, 'college' => 'College of Accountancy'],

            // College of Nursing (10 students)
            ['name' => 'River Gaia Morales', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Dawn Hestia Jimenez', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Vale Hecate Perez', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Sage Nemesis Vargas', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Phoenix Tyche Aguilar', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Storm Nike Ruiz', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Ocean Phoebe Navarro', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Luna Clio Ortega', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Sky Melpomene Guerrero', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
            ['name' => 'Star Thalia Medina', 'course' => 'BS Nursing', 'track' => null, 'college' => 'College of Nursing'],
        ];

        foreach ($students as $index => $student) {
            $year = 2020 + ($index % 5); // Distribute across years 2020-2024
            $sequence = str_pad($index + 1000, 4, '0', STR_PAD_LEFT);
            $studentId = $year . '-' . substr($year, -2) . '-' . $sequence;
            
            // Generate proper email based on name for students
            $firstName = strtolower(explode(' ', $student['name'])[0]);
            $lastName = strtolower(explode(' ', $student['name'])[1]);
            $email = $firstName . '.' . $lastName . '.' . ($index + 1) . '@students.uc-bcf.edu.ph';

            User::create([
                'name' => $student['name'],
                'email' => $email,
                'password' => Hash::make('student123'),
                'role' => 'student',
                'course' => $student['course'],
                'track' => $student['track'],
                'college' => $student['college'],
                'student_id' => $studentId,
                'phone' => '+63 917 ' . str_pad(3000 + $index, 3, '0', STR_PAD_LEFT) . ' ' . str_pad($index + 2000, 4, '0', STR_PAD_LEFT),
                'date_of_birth' => '2000-01-01', // Default birth date for students
                'gender' => ($index % 2 == 0) ? 'Male' : 'Female', // Alternate gender
                'address' => 'Student Address, Baguio City, Philippines',
                'emergency_contact_name' => 'Parent/Guardian',
                'emergency_contact_phone' => '+63 917 000 0000',
                'emergency_contact_relationship' => 'Parent',
                'email_verified_at' => now(),
            ]);
        }
    }
}
