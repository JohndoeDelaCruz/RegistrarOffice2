<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DeanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use App\Models\User;

Route::get('/', function () {
    return view('student-select');
});

// Rules and Guidelines - accessible to all authenticated users
Route::get('/rules-guidelines', [PageController::class, 'rulesGuidelines'])->name('rules-guidelines');

// Direct access to faculty dashboard for testing
Route::get('/faculty', function () {
    return redirect('/faculty/dashboard');
});

// Direct access to dean dashboard for testing
Route::get('/dean', function () {
    return redirect('/dean/dashboard');
});

// Login Routes
Route::post('/student-login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Student Dashboard Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/announcement', [StudentController::class, 'announcement'])->name('announcement');
    Route::get('/grade-completion', [StudentController::class, 'gradeCompletion'])->name('grade-completion');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    // Route::get('/checklist', [StudentController::class, 'checklist'])->name('checklist'); // Removed checklist functionality
    Route::post('/grade-completion/apply', [StudentController::class, 'applyForGradeCompletion'])->name('grade-completion.apply');
});

// Faculty Dashboard Routes
Route::prefix('faculty')->name('faculty.')->group(function () {
    Route::get('/dashboard', [FacultyController::class, 'dashboard'])->name('dashboard');
    Route::get('/grade-management', [FacultyController::class, 'gradeManagement'])->name('grade-management');
    Route::get('/grade-management/{student}/grades', [FacultyController::class, 'getStudentGrades'])->name('grade-management.student-grades');
    Route::post('/grade-management/update', [FacultyController::class, 'updateStudentGrade'])->name('grade-management.update');
    Route::get('/students-checklist', [FacultyController::class, 'studentsChecklist'])->name('students-checklist');
    Route::get('/student/{student}/checklist', [FacultyController::class, 'studentChecklistDetail'])->name('student-checklist-detail');
    Route::post('/student/{student}/subject/{subject}/grade', [FacultyController::class, 'updateGrade'])->name('student.update-grade');
    Route::delete('/student/{student}/subject/{subject}/grade', [FacultyController::class, 'removeGrade'])->name('student.remove-grade');
    Route::get('/announcement', [FacultyController::class, 'announcement'])->name('announcement');
    Route::post('/announcement/create', [FacultyController::class, 'createAnnouncement'])->name('announcement.create');
    Route::post('/announcement/{announcement}/publish', [FacultyController::class, 'publishAnnouncement'])->name('announcement.publish');
    Route::delete('/announcement/{announcement}', [FacultyController::class, 'deleteAnnouncement'])->name('announcement.delete');
    Route::get('/profile', [FacultyController::class, 'profile'])->name('profile');
    Route::put('/profile', [FacultyController::class, 'updateProfile'])->name('profile.update');
    Route::get('/grade-completion-applications', [FacultyController::class, 'gradeCompletionApplications'])->name('grade-completion-applications');
    Route::post('/grade-completion-applications/{application}/process', [FacultyController::class, 'processGradeApplication'])->name('grade-completion-applications.process');
    Route::get('/grade-completion-applications/{application}/details', [FacultyController::class, 'getGradeApplicationDetails'])->name('grade-completion-applications.details');
    Route::get('/grade-completion-applications/{application}/document', [FacultyController::class, 'viewApplicationDocument'])->name('grade-completion-applications.document');
    Route::get('/grade-completion-applications/{application}/signed-document', [FacultyController::class, 'generateSignedDocument'])->name('grade-completion-applications.signed-document');
});

// Dean Dashboard Routes
Route::prefix('dean')->name('dean.')->group(function () {
    Route::get('/dashboard', [DeanController::class, 'dashboard'])->name('dashboard');
    Route::get('/announcement', [DeanController::class, 'announcement'])->name('announcement');
    Route::post('/announcement/create', [DeanController::class, 'createAnnouncement'])->name('announcement.create');
    Route::post('/announcement/{announcement}/publish', [DeanController::class, 'publishAnnouncement'])->name('announcement.publish');
    Route::delete('/announcement/{announcement}', [DeanController::class, 'deleteAnnouncement'])->name('announcement.delete');
    Route::get('/profile', [DeanController::class, 'profile'])->name('profile');
    Route::get('/grade-completion-applications', [DeanController::class, 'gradeCompletionApplications'])->name('grade-completion-applications');
    Route::get('/approved-applications', [DeanController::class, 'approvedApplications'])->name('approved-applications');
    Route::post('/grade-completion-applications/{application}/review', [DeanController::class, 'reviewApplication'])->name('grade-completion-applications.review');
    Route::get('/grade-completion-applications/{application}/details', [DeanController::class, 'getApplicationDetails'])->name('grade-completion-applications.details');
    Route::get('/grade-completion-applications/{application}/document', [DeanController::class, 'viewDocument'])->name('grade-completion-applications.document');
    Route::get('/grade-completion-applications/{application}/signed-document', [DeanController::class, 'generateSignedDocument']);
});

// Routes to switch between students for testing
Route::get('/student-webtech', function () {
    $student = User::where('track', 'Web Technology Track')->first();
    return view('student.dashboard', compact('student'))->with('page-title', 'Web Technology Student Dashboard');
});

Route::get('/student-netsec', function () {
    $student = User::where('track', 'Network Security Track')->first();
    return view('student.dashboard', compact('student'))->with('page-title', 'Network Security Student Dashboard');
});
