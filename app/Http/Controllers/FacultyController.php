<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FacultyController extends Controller
{
    private function getLoggedInFaculty()
    {
        // First try to get from Laravel's built-in auth
        if (auth()->check() && auth()->user()->role === 'faculty') {
            return auth()->user();
        }
        
        // Then try to get from session
        $userId = session('user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user && $user->role === 'faculty') {
                return $user;
            }
        }
        
        // Fallback for demo purposes - this should ideally redirect to login
        return User::where('role', 'faculty')->first();
    }

    public function dashboard()
    {
        $faculty = $this->getLoggedInFaculty();
        return view('faculty.dashboard', compact('faculty'));
    }

    public function studentsChecklist()
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get all students with their basic information
        $students = User::where('role', 'student')
                       ->orderBy('name')
                       ->get(['id', 'name', 'student_id', 'course', 'track', 'email']);
        
        return view('faculty.students-checklist', compact('faculty', 'students'));
    }

    public function studentChecklistDetail($studentId)
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get the specific student
        $student = User::where('role', 'student')->findOrFail($studentId);
        
        // Get subjects grouped by year and trimester for the student's course and track
        $subjectsByYear = $student->getSubjectsByYearAndTrimester();
        
        // Get current academic year
        $currentAcademicYear = \App\Models\AcademicYear::getCurrentYear();
        
        // Calculate total units
        $totalUnits = $student->getAvailableSubjects()->sum('units');
        
        return view('faculty.student-checklist-detail', compact('faculty', 'student', 'subjectsByYear', 'currentAcademicYear', 'totalUnits'));
    }

    public function announcement()
    {
        $faculty = $this->getLoggedInFaculty();
        return view('faculty.announcement', compact('faculty'));
    }

    public function profile()
    {
        $faculty = $this->getLoggedInFaculty();
        return view('faculty.profile', compact('faculty'));
    }

    public function updateProfile(Request $request)
    {
        $faculty = $this->getLoggedInFaculty();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string|max:500',
            'office_location' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:100',
        ]);

        $faculty->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'office_location' => $request->office_location,
            'specialization' => $request->specialization,
            'education_level' => $request->education_level,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
        ]);

        return redirect()->route('faculty.profile')->with('success', 'Profile updated successfully!');
    }

    public function updateGrade(Request $request, $studentId, $subjectId)
    {
        try {
            $faculty = $this->getLoggedInFaculty();
            
            // Validate the request
            $request->validate([
                'grade' => 'required|string|max:10'
            ]);
            
            // Get the student and subject
            $student = User::where('role', 'student')->findOrFail($studentId);
            $subject = \App\Models\Subject::findOrFail($subjectId);
            
            // Get current academic year
            $currentAcademicYear = \App\Models\AcademicYear::getCurrentYear();
            $academicYearString = $currentAcademicYear ? $currentAcademicYear->year : '2024-2025';
            
            // Check if grade already exists
            $existingGrade = \App\Models\StudentGrade::where('user_id', $studentId)
                                                   ->where('subject_id', $subjectId)
                                                   ->first();
            
            if ($existingGrade) {
                // Update existing grade
                $existingGrade->update([
                    'grade' => $request->grade,
                    'is_completed' => true,
                    'completed_at' => now()
                ]);
            } else {
                // Create new grade
                \App\Models\StudentGrade::create([
                    'user_id' => $studentId,
                    'subject_id' => $subjectId,
                    'grade' => $request->grade,
                    'academic_year' => $academicYearString,
                    'is_completed' => true,
                    'completed_at' => now()
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Grade updated successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating grade: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeGrade(Request $request, $studentId, $subjectId)
    {
        try {
            $faculty = $this->getLoggedInFaculty();
            
            // Find and delete the grade
            $grade = \App\Models\StudentGrade::where('user_id', $studentId)
                                            ->where('subject_id', $subjectId)
                                            ->first();
            
            if ($grade) {
                $grade->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Grade removed successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Grade not found'
                ], 404);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing grade: ' . $e->getMessage()
            ], 500);
        }
    }
}
