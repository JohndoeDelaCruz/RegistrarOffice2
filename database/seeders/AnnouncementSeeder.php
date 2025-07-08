<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
use App\Models\User;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the dean user
        $dean = User::where('role', 'dean')->first();
        
        if (!$dean) {
            return;
        }

        $announcements = [
            [
                'title' => 'Welcome to Academic Year 2024-2025',
                'content' => 'Dear Students and Faculty,

We warmly welcome everyone to the new Academic Year 2024-2025. This year brings new opportunities for learning, growth, and academic excellence. 

Please note the following important dates:
- Classes begin: August 15, 2024
- Add/Drop period: August 15-22, 2024
- Midterm examinations: October 15-20, 2024
- Final examinations: December 10-15, 2024

We wish everyone a successful and fulfilling academic year.

Best regards,
Dean Roberto Martinez',
                'category' => 'academic',
                'audience' => 'all',
                'priority' => 'high',
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'created_by' => $dean->id,
            ],
            [
                'title' => 'Grade Completion Application Deadline Reminder',
                'content' => 'This is a reminder for all students with INC (Incomplete) or NFE (No Final Exam) grades:

The deadline for submitting grade completion applications is approaching. Please ensure you submit your applications with all required supporting documents before the deadline.

Steps to apply:
1. Log into your student portal
2. Navigate to Grade Completion
3. Select the subject with INC/NFE grade
4. Fill out the application form completely
5. Upload supporting documents
6. Submit for dean approval

For questions or assistance, please contact the Registrar\'s Office.

Dean Roberto Martinez
Office of the Dean',
                'category' => 'urgent',
                'audience' => 'students',
                'priority' => 'urgent',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'created_by' => $dean->id,
            ],
            [
                'title' => 'Updated COVID-19 Health Protocols',
                'content' => 'In line with the latest health guidelines, please be informed of the updated COVID-19 protocols for the university:

1. Mask wearing is optional but encouraged in all indoor spaces
2. Maintain physical distancing when possible
3. Hand sanitizing stations are available throughout the campus
4. Students experiencing symptoms should stay home and inform their instructors
5. Vaccination is still encouraged for all members of the university community

These protocols are subject to change based on local health authority recommendations.

Stay safe and healthy!

University Health Services
Dean Roberto Martinez',
                'category' => 'administrative',
                'audience' => 'all',
                'priority' => 'high',
                'status' => 'published',
                'published_at' => now()->subDays(7),
                'created_by' => $dean->id,
            ],
            [
                'title' => 'Library Hours Extension During Finals Week',
                'content' => 'To support students during the final examination period, the university library will extend its operating hours:

Regular Hours:
Monday - Friday: 8:00 AM - 6:00 PM
Saturday: 9:00 AM - 4:00 PM
Sunday: Closed

Finals Week Hours (December 5-15):
Monday - Friday: 7:00 AM - 10:00 PM
Saturday: 8:00 AM - 8:00 PM
Sunday: 10:00 AM - 6:00 PM

Additional study spaces will be available in the following locations:
- Computer Laboratory 1 & 2
- Student Activity Center
- Cafeteria (after 6:00 PM)

Good luck with your examinations!

Library Services
Approved by: Dean Roberto Martinez',
                'category' => 'academic',
                'audience' => 'students',
                'priority' => 'normal',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'expires_at' => now()->addDays(30),
                'created_by' => $dean->id,
            ],
            [
                'title' => 'Faculty Meeting - Curriculum Review',
                'content' => 'All faculty members are required to attend the upcoming curriculum review meeting.

Date: January 20, 2025
Time: 2:00 PM - 5:00 PM
Venue: Conference Room A, Administration Building

Agenda:
1. Review of current curriculum
2. Proposed changes for 2025-2026
3. Industry feedback integration
4. Assessment methods update
5. Technology integration plans

Please bring:
- Course syllabi for your assigned subjects
- Student feedback reports
- Industry partnership proposals (if any)

Light refreshments will be served.

Dean Roberto Martinez
Office of the Dean',
                'category' => 'administrative',
                'audience' => 'faculty',
                'priority' => 'high',
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'expires_at' => now()->addDays(15),
                'created_by' => $dean->id,
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
