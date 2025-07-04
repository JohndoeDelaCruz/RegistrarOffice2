<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Models\User;

Route::get('/', function () {
    return view('student-select');
});

// Student Login
Route::post('/student-login', [StudentLoginController::class, 'login'])->name('student.login');

// Student Dashboard Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/announcement', [StudentController::class, 'announcement'])->name('announcement');
    Route::get('/grade-completion', [StudentController::class, 'gradeCompletion'])->name('grade-completion');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::get('/checklist', [StudentController::class, 'checklist'])->name('checklist');
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

// Logout route (placeholder - you may need to implement authentication)
Route::post('/logout', function () {
    // Add logout logic here when authentication is implemented
    return redirect('/');
})->name('logout');
