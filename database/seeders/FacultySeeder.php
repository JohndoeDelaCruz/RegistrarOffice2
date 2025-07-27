<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing faculty data
        User::where('role', 'faculty')->delete();
        Faculty::truncate();
        
        $faculties = [
            // College of Engineering and Architecture (5 faculty)
            ['name' => 'Dr. Maria Santos', 'email' => 'maria.santos@uc.edu.ph', 'department' => 'College of Engineering and Architecture', 'specialization' => 'Software Engineering & Web Development', 'position' => 'Professor'],
            ['name' => 'Engr. Juan Dela Cruz', 'email' => 'juan.delacruz@uc.edu.ph', 'department' => 'College of Engineering and Architecture', 'specialization' => 'Civil Engineering & Structural Design', 'position' => 'Associate Professor'],
            ['name' => 'Arch. Ana Reyes', 'email' => 'ana.reyes@uc.edu.ph', 'department' => 'College of Engineering and Architecture', 'specialization' => 'Architectural Design & Planning', 'position' => 'Assistant Professor'],
            ['name' => 'Engr. Carlos Lopez', 'email' => 'carlos.lopez@uc.edu.ph', 'department' => 'College of Engineering and Architecture', 'specialization' => 'Electronics & Communications', 'position' => 'Professor'],
            ['name' => 'Dr. Elena Garcia', 'email' => 'elena.garcia@uc.edu.ph', 'department' => 'College of Engineering and Architecture', 'specialization' => 'Environmental Engineering', 'position' => 'Associate Professor'],

            // College of Arts and Sciences (5 faculty)
            ['name' => 'Dr. Roberto Martinez', 'email' => 'roberto.martinez@uc.edu.ph', 'department' => 'College of Arts and Sciences', 'specialization' => 'English Language & Literature', 'position' => 'Professor'],
            ['name' => 'Prof. Sofia Villanueva', 'email' => 'sofia.villanueva@uc.edu.ph', 'department' => 'College of Arts and Sciences', 'specialization' => 'Political Science & Governance', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Miguel Torres', 'email' => 'miguel.torres@uc.edu.ph', 'department' => 'College of Arts and Sciences', 'specialization' => 'Mass Communication & Media', 'position' => 'Assistant Professor'],
            ['name' => 'Dr. Carmen Flores', 'email' => 'carmen.flores@uc.edu.ph', 'department' => 'College of Arts and Sciences', 'specialization' => 'Psychology & Behavioral Science', 'position' => 'Professor'],
            ['name' => 'Prof. Antonio Cruz', 'email' => 'antonio.cruz@uc.edu.ph', 'department' => 'College of Arts and Sciences', 'specialization' => 'Behavioral Science Research', 'position' => 'Associate Professor'],

            // College of Business Administration (5 faculty)
            ['name' => 'Dr. Isabel Mendoza', 'email' => 'isabel.mendoza@uc.edu.ph', 'department' => 'College of Business Administration', 'specialization' => 'Business Management & Strategy', 'position' => 'Professor'],
            ['name' => 'Prof. Rafael Gomez', 'email' => 'rafael.gomez@uc.edu.ph', 'department' => 'College of Business Administration', 'specialization' => 'Entrepreneurship & Innovation', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Cristina Valdez', 'email' => 'cristina.valdez@uc.edu.ph', 'department' => 'College of Business Administration', 'specialization' => 'Office Administration & Management', 'position' => 'Assistant Professor'],
            ['name' => 'Prof. Fernando Silva', 'email' => 'fernando.silva@uc.edu.ph', 'department' => 'College of Business Administration', 'specialization' => 'Real Estate & Property Management', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Patricia Ramos', 'email' => 'patricia.ramos@uc.edu.ph', 'department' => 'College of Business Administration', 'specialization' => 'Digital Marketing & E-commerce', 'position' => 'Professor'],

            // College of Information Technology and Computer Science (5 faculty)
            ['name' => 'Dr. Gabriel Hernandez', 'email' => 'gabriel.hernandez@uc.edu.ph', 'department' => 'College of Information Technology and Computer Science', 'specialization' => 'Computer Science & Algorithms', 'position' => 'Professor'],
            ['name' => 'Prof. Victoria Luna', 'email' => 'victoria.luna@uc.edu.ph', 'department' => 'College of Information Technology and Computer Science', 'specialization' => 'Data Analytics & Machine Learning', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Ricardo Morales', 'email' => 'ricardo.morales@uc.edu.ph', 'department' => 'College of Information Technology and Computer Science', 'specialization' => 'Information Technology & Systems', 'position' => 'Assistant Professor'],
            ['name' => 'Prof. Alejandra Castro', 'email' => 'alejandra.castro@uc.edu.ph', 'department' => 'College of Information Technology and Computer Science', 'specialization' => 'Database Management & Security', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Francisco Jimenez', 'email' => 'francisco.jimenez@uc.edu.ph', 'department' => 'College of Information Technology and Computer Science', 'specialization' => 'Network Administration & Cybersecurity', 'position' => 'Professor'],

            // College of Teacher Education (4 faculty)
            ['name' => 'Dr. Margarita Perez', 'email' => 'margarita.perez@uc.edu.ph', 'department' => 'College of Teacher Education', 'specialization' => 'Elementary Education & Curriculum', 'position' => 'Professor'],
            ['name' => 'Prof. Eduardo Vargas', 'email' => 'eduardo.vargas@uc.edu.ph', 'department' => 'College of Teacher Education', 'specialization' => 'Secondary Education & Pedagogy', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Beatriz Aguilar', 'email' => 'beatriz.aguilar@uc.edu.ph', 'department' => 'College of Teacher Education', 'specialization' => 'Educational Psychology & Assessment', 'position' => 'Assistant Professor'],
            ['name' => 'Prof. Domingo Ruiz', 'email' => 'domingo.ruiz@uc.edu.ph', 'department' => 'College of Teacher Education', 'specialization' => 'Educational Technology & Innovation', 'position' => 'Associate Professor'],

            // College of Criminal Justice Education (4 faculty)
            ['name' => 'Dr. Rodrigo Navarro', 'email' => 'rodrigo.navarro@uc.edu.ph', 'department' => 'College of Criminal Justice Education', 'specialization' => 'Criminology & Criminal Law', 'position' => 'Professor'],
            ['name' => 'Prof. Esperanza Ortega', 'email' => 'esperanza.ortega@uc.edu.ph', 'department' => 'College of Criminal Justice Education', 'specialization' => 'Forensic Science & Investigation', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Alfredo Guerrero', 'email' => 'alfredo.guerrero@uc.edu.ph', 'department' => 'College of Criminal Justice Education', 'specialization' => 'Criminal Justice Administration', 'position' => 'Assistant Professor'],
            ['name' => 'Prof. Rocio Medina', 'email' => 'rocio.medina@uc.edu.ph', 'department' => 'College of Criminal Justice Education', 'specialization' => 'Crime Scene Investigation', 'position' => 'Associate Professor'],

            // College of Law (3 faculty)
            ['name' => 'Atty. Benjamin Sandoval', 'email' => 'benjamin.sandoval@uc.edu.ph', 'department' => 'College of Law', 'specialization' => 'Constitutional Law & Jurisprudence', 'position' => 'Professor'],
            ['name' => 'Atty. Luz Fernandez', 'email' => 'luz.fernandez@uc.edu.ph', 'department' => 'College of Law', 'specialization' => 'Civil Law & Contracts', 'position' => 'Associate Professor'],
            ['name' => 'Atty. Emilio Ramirez', 'email' => 'emilio.ramirez@uc.edu.ph', 'department' => 'College of Law', 'specialization' => 'Criminal Law & Procedure', 'position' => 'Assistant Professor'],

            // College of Accountancy (3 faculty)
            ['name' => 'CPA Dr. Norma Gutierrez', 'email' => 'norma.gutierrez@uc.edu.ph', 'department' => 'College of Accountancy', 'specialization' => 'Financial Accounting & Auditing', 'position' => 'Professor'],
            ['name' => 'CPA Prof. Sergio Vega', 'email' => 'sergio.vega@uc.edu.ph', 'department' => 'College of Accountancy', 'specialization' => 'Management Accounting & Finance', 'position' => 'Associate Professor'],
            ['name' => 'CPA Dr. Alicia Romero', 'email' => 'alicia.romero@uc.edu.ph', 'department' => 'College of Accountancy', 'specialization' => 'Taxation & Business Law', 'position' => 'Assistant Professor'],

            // College of Nursing (3 faculty)
            ['name' => 'RN Dr. Claudia Herrera', 'email' => 'claudia.herrera@uc.edu.ph', 'department' => 'College of Nursing', 'specialization' => 'Medical-Surgical Nursing', 'position' => 'Professor'],
            ['name' => 'RN Prof. Javier Molina', 'email' => 'javier.molina@uc.edu.ph', 'department' => 'College of Nursing', 'specialization' => 'Community Health Nursing', 'position' => 'Associate Professor'],
            ['name' => 'RN Dr. Adriana Campos', 'email' => 'adriana.campos@uc.edu.ph', 'department' => 'College of Nursing', 'specialization' => 'Pediatric & Maternal Nursing', 'position' => 'Assistant Professor'],

            // College of Hospitality and Tourism Management (3 faculty)
            ['name' => 'Dr. Hector Moreno', 'email' => 'hector.moreno@uc.edu.ph', 'department' => 'College of Hospitality and Tourism Management', 'specialization' => 'Hotel Management & Operations', 'position' => 'Professor'],
            ['name' => 'Prof. Leticia Delgado', 'email' => 'leticia.delgado@uc.edu.ph', 'department' => 'College of Hospitality and Tourism Management', 'specialization' => 'Tourism Planning & Development', 'position' => 'Associate Professor'],
            ['name' => 'Dr. Salvador Paredes', 'email' => 'salvador.paredes@uc.edu.ph', 'department' => 'College of Hospitality and Tourism Management', 'specialization' => 'Food Service & Culinary Arts', 'position' => 'Assistant Professor'],
        ];

        foreach ($faculties as $index => $faculty) {
            $facultyId = 'FAC-2025-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            $phone = '+63 917 ' . str_pad(2000 + $index, 3, '0', STR_PAD_LEFT) . ' ' . str_pad($index + 1000, 4, '0', STR_PAD_LEFT);

            // Create Faculty record
            Faculty::create([
                'name' => $faculty['name'],
                'email' => $faculty['email'],
                'faculty_id' => $facultyId,
                'department' => $faculty['department'],
                'position' => $faculty['position'],
                'phone' => $phone,
                'date_of_birth' => '1980-01-01', // Default birth date
                'gender' => 'Male', // Default gender
                'address' => 'University of the Cordilleras, Baguio City, Philippines',
                'office_location' => 'Faculty Office Building',
                'specialization' => $faculty['specialization'],
                'education_level' => 'PhD in ' . explode(' & ', $faculty['specialization'])[0],
                'emergency_contact_name' => 'Emergency Contact',
                'emergency_contact_phone' => '+63 917 000 0000',
                'emergency_contact_relationship' => 'Family',
            ]);

            // Create corresponding User account for login
            User::create([
                'name' => $faculty['name'],
                'email' => $faculty['email'],
                'password' => Hash::make('faculty123'),
                'role' => 'faculty',
                'college' => $faculty['department'], // Fix: Use college instead of course
                'course' => 'Faculty', // Faculty course field
                'track' => null,
                'student_id' => $facultyId,
                'phone' => $phone,
                'date_of_birth' => '1980-01-01',
                'gender' => 'Male',
                'address' => 'University of the Cordilleras, Baguio City, Philippines',
                'emergency_contact_name' => 'Emergency Contact',
                'emergency_contact_phone' => '+63 917 000 0000',
                'emergency_contact_relationship' => 'Family',
                'email_verified_at' => now(),
            ]);
        }
    }
}
