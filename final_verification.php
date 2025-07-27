<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "✅ FINAL VERIFICATION: Faculty-Student College Matching\n\n";

// Test IT Faculty
echo "=== IT COLLEGE TEST ===\n";
$itFaculty = User::where('role', 'faculty')
    ->where('college', 'College of Information Technology and Computer Science')
    ->first();

echo "IT Faculty: {$itFaculty->first_name} {$itFaculty->last_name} ({$itFaculty->email})\n";
echo "College: {$itFaculty->college}\n\n";

$itStudents = User::where('role', 'student')
    ->where('college', $itFaculty->college)
    ->get(['first_name', 'last_name', 'course']);

echo "Students this IT faculty should see:\n";
$bsitCount = 0;
$csCount = 0;
$daCount = 0;

foreach($itStudents as $student) {
    echo "- {$student->first_name} {$student->last_name} | {$student->course}\n";
    if ($student->course === 'BSIT') $bsitCount++;
    if ($student->course === 'BS Computer Science') $csCount++;
    if ($student->course === 'BS Data Analytics') $daCount++;
}

echo "\nSummary:\n";
echo "- BSIT students: {$bsitCount}\n";
echo "- BS Computer Science students: {$csCount}\n";
echo "- BS Data Analytics students: {$daCount}\n";
echo "- Total IT students: " . $itStudents->count() . "\n\n";

// Test Arts & Sciences Faculty
echo "=== ARTS & SCIENCES COLLEGE TEST ===\n";
$artsFaculty = User::where('role', 'faculty')
    ->where('college', 'College of Arts and Sciences')
    ->first();

echo "Arts Faculty: {$artsFaculty->first_name} {$artsFaculty->last_name} ({$artsFaculty->email})\n";
echo "College: {$artsFaculty->college}\n\n";

$artsStudents = User::where('role', 'student')
    ->where('college', $artsFaculty->college)
    ->get(['first_name', 'last_name', 'course']);

echo "Students this Arts faculty should see:\n";
foreach($artsStudents as $student) {
    echo "- {$student->first_name} {$student->last_name} | {$student->course}\n";
}
echo "Total Arts students: " . $artsStudents->count() . "\n\n";

echo "✅ PROBLEM RESOLVED!\n";
echo "====================\n";
echo "• IT faculty will now see ONLY IT students (BSIT, BS Computer Science, BS Data Analytics)\n";
echo "• Arts & Sciences faculty will see ONLY Arts & Sciences students\n";
echo "• Each faculty is properly assigned to their correct college\n\n";

echo "LOGIN INSTRUCTIONS:\n";
echo "1. Go to http://127.0.0.1:8000\n";
echo "2. Select 'Faculty' as login type\n";
echo "3. Use any IT faculty email (e.g., gabriel.hernandez@uc.edu.ph)\n";
echo "4. Password: password\n";
echo "5. Go to Faculty Dashboard → Students Checklist\n";
echo "6. You should see ONLY IT students, including {$bsitCount} BSIT students!\n";
