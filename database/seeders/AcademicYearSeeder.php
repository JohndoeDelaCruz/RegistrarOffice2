<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYears = [
            [
                'year' => '2022-2023',
                'start_date' => '2022-08-01',
                'end_date' => '2023-07-31',
                'is_current' => false,
            ],
            [
                'year' => '2023-2024',
                'start_date' => '2023-08-01',
                'end_date' => '2024-07-31',
                'is_current' => false,
            ],
            [
                'year' => '2024-2025',
                'start_date' => '2024-08-01',
                'end_date' => '2025-07-31',
                'is_current' => true,
            ],
        ];

        foreach ($academicYears as $year) {
            AcademicYear::create($year);
        }
    }
}
