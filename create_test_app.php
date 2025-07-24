<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\GradeCompletionApplication;
use App\Models\User;
use App\Models\Subject;

try {
    // Find a student and subject
    $student = User::where('role', 'student')->first();
    $subject = Subject::first();
    
    if (!$student) {
        echo "No student found\n";
        exit(1);
    }
    
    if (!$subject) {
        echo "No subject found\n";  
        exit(1);
    }
    
    echo "Student: {$student->name} (ID: {$student->id})\n";
    echo "Subject: {$subject->description} ({$subject->code})\n";
    
    // Create a pending application
    $application = GradeCompletionApplication::create([
        'student_id' => $student->id,
        'subject_id' => $subject->id,
        'current_grade' => 'INC',
        'reason' => 'Test application for dean approval - Incomplete coursework due to illness',
        'dean_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    echo "Created test application with ID: {$application->id}\n";
    echo "Status: {$application->dean_status}\n";
    
    // Check current counts
    echo "\nApplication counts:\n";
    echo "Total: " . GradeCompletionApplication::count() . "\n";
    echo "Pending: " . GradeCompletionApplication::where('dean_status', 'pending')->count() . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
