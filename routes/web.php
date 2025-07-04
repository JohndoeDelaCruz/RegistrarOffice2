<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Models\User;

Route::get('/', function () {
    return view('student-select');
});

// Direct access to faculty dashboard for testing
Route::get('/faculty', function () {
    return redirect('/faculty/dashboard');
});

// Student Login
Route::post('/student-login', [StudentLoginController::class, 'login'])->name('student.login');
Route::post('/logout', [StudentLoginController::class, 'logout'])->name('logout');

// Student Dashboard Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/announcement', [StudentController::class, 'announcement'])->name('announcement');
    Route::get('/grade-completion', [StudentController::class, 'gradeCompletion'])->name('grade-completion');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::get('/checklist', [StudentController::class, 'checklist'])->name('checklist');
});

// Faculty Dashboard Routes
Route::prefix('faculty')->name('faculty.')->group(function () {
    Route::get('/dashboard', [FacultyController::class, 'dashboard'])->name('dashboard');
    Route::get('/students-checklist', [FacultyController::class, 'studentsChecklist'])->name('students-checklist');
    Route::get('/announcement', [FacultyController::class, 'announcement'])->name('announcement');
    Route::get('/profile', [FacultyController::class, 'profile'])->name('profile');
    Route::put('/profile', [FacultyController::class, 'updateProfile'])->name('profile.update');
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
