<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\StudentGrade;
use App\Models\AcademicYear;

class StudentController extends Controller
{
    private function getLoggedInStudent()
    {
        // First try to get from Laravel's built-in auth
        if (auth()->check() && auth()->user()->role === 'student') {
            return auth()->user();
        }
        
        // Then try to get from session
        $userId = session('user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user && $user->role === 'student') {
                return $user;
            }
        }
        
        // Fallback for demo purposes - this should ideally redirect to login
        return User::where('role', 'student')->whereNotNull('track')->first();
    }

    public function dashboard()
    {
        $student = $this->getLoggedInStudent();
        return view('student.dashboard', compact('student'));
    }

    public function announcement()
    {
        $student = $this->getLoggedInStudent();
        return view('student.announcement', compact('student'));
    }

    public function gradeCompletion()
    {
        $student = $this->getLoggedInStudent();
        return view('student.grade-completion', compact('student'));
    }

    public function profile()
    {
        $student = $this->getLoggedInStudent();
        return view('student.profile', compact('student'));
    }

    public function checklist()
    {
        $student = $this->getLoggedInStudent();
        
        // Get subjects grouped by year and trimester for the student's course and track
        $subjectsByYear = $student->getSubjectsByYearAndTrimester();
        
        // Get current academic year
        $currentAcademicYear = \App\Models\AcademicYear::getCurrentYear();
        
        // Calculate total units
        $totalUnits = $student->getAvailableSubjects()->sum('units');
        
        return view('student.checklist', compact('student', 'subjectsByYear', 'currentAcademicYear', 'totalUnits'));
    }

    public function updateProfile(Request $request)
    {
        $student = $this->getLoggedInStudent();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:100',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
        ]);

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully!');
    }
}
