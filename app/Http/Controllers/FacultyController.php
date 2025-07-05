<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GradeCompletionApplication;
use Carbon\Carbon;

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
        
        // Get pending grade completion applications count
        $pendingGradeApplications = GradeCompletionApplication::where('dean_status', 'approved')
            ->whereNull('faculty_status')
            ->count();
        
        // Get total students count
        $studentsCount = User::where('role', 'student')->count();
        
        return view('faculty.dashboard', compact('faculty', 'pendingGradeApplications', 'studentsCount'));
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

    public function gradeCompletionApplications()
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get applications that are approved by dean and sent to faculty
        $applications = GradeCompletionApplication::with(['student', 'subject'])
            ->where('dean_status', 'approved')
            ->whereNull('faculty_status') // Only show applications not yet processed by faculty
            ->orderBy('dean_reviewed_at', 'desc')
            ->get();
        
        return view('faculty.grade-completion-applications', compact('faculty', 'applications'));
    }

    public function viewApplication($id)
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get the application details
        $application = GradeCompletionApplication::with('student')->findOrFail($id);
        
        return view('faculty.view-grade-completion-application', compact('faculty', 'application'));
    }

    public function approveApplication(Request $request, $id)
    {
        try {
            $faculty = $this->getLoggedInFaculty();
            
            // Get the application
            $application = GradeCompletionApplication::findOrFail($id);
            
            // Approve the application
            $application->update([
                'status' => 'approved',
                'approved_by' => $faculty->id,
                'approved_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Application approved successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error approving application: ' . $e->getMessage()
            ], 500);
        }
    }

    public function disapproveApplication(Request $request, $id)
    {
        try {
            $faculty = $this->getLoggedInFaculty();
            
            // Get the application
            $application = GradeCompletionApplication::findOrFail($id);
            
            // Disapprove the application
            $application->update([
                'status' => 'disapproved',
                'approved_by' => $faculty->id,
                'approved_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Application disapproved successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error disapproving application: ' . $e->getMessage()
            ], 500);
        }
    }

    public function processGradeApplication(Request $request, $application)
    {
        try {
            $request->validate([
                'action' => 'required|in:complete,reject',
                'faculty_remarks' => 'nullable|string|max:1000',
                'new_grade' => 'required_if:action,complete|string|max:10'
            ]);

            $application = GradeCompletionApplication::findOrFail($application);
            $faculty = $this->getLoggedInFaculty();

            if (!$faculty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Faculty user not found'
                ], 403);
            }

            $updateData = [
                'faculty_status' => $request->action === 'complete' ? 'completed' : 'rejected',
                'faculty_remarks' => $request->faculty_remarks,
                'faculty_processed_at' => Carbon::now(),
                'faculty_processed_by' => $faculty->id
            ];

            // If completing the grade, update the student's grade
            if ($request->action === 'complete') {
                $updateData['final_grade'] = $request->new_grade;
                
                // Update the student's grade in the StudentGrade table
                \App\Models\StudentGrade::updateOrCreate(
                    [
                        'user_id' => $application->student_id,
                        'subject_id' => $application->subject_id
                    ],
                    [
                        'grade' => $request->new_grade,
                        'is_completed' => true,
                        'completed_at' => now(),
                        'academic_year' => $application->academic_year ?? '2024-2025'
                    ]
                );
            }

            $application->update($updateData);

            $message = $request->action === 'complete' 
                ? 'Grade completion processed successfully. Student grade has been updated.'
                : 'Grade completion application rejected. Student will be notified.';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getGradeApplicationDetails($application)
    {
        $application = GradeCompletionApplication::with(['student', 'subject'])
            ->findOrFail($application);

        return response()->json([
            'success' => true,
            'application' => [
                'id' => $application->id,
                'student_name' => $application->student->first_name . ' ' . $application->student->last_name,
                'student_id' => $application->student->student_id,
                'subject_code' => $application->subject->code,
                'subject_name' => $application->subject->description,
                'current_grade' => $application->current_grade,
                'reason' => $application->reason,
                'supporting_document' => $application->supporting_document,
                'created_at' => $application->created_at->format('F j, Y g:i A'),
                'dean_status' => $application->dean_status,
                'dean_remarks' => $application->dean_remarks,
                'dean_reviewed_at' => $application->dean_reviewed_at ? $application->dean_reviewed_at->format('F j, Y g:i A') : null,
                'dean_signature' => $application->dean_signature,
                'dean_signature_type' => $application->dean_signature_type,
                'faculty_status' => $application->faculty_status,
                'faculty_remarks' => $application->faculty_remarks
            ]
        ]);
    }

    public function viewApplicationDocument($application)
    {
        $application = GradeCompletionApplication::findOrFail($application);
        
        if (!$application->supporting_document) {
            abort(404, 'Document not found');
        }
        
        $filePath = storage_path('app/public/' . $application->supporting_document);
        
        if (!file_exists($filePath)) {
            abort(404, 'Document file not found');
        }
        
        $fileName = basename($application->supporting_document);
        $mimeType = mime_content_type($filePath);
        
        // For PDFs, display inline; for images, display inline; for other files, force download
        if (str_contains($mimeType, 'pdf') || str_contains($mimeType, 'image')) {
            return response()->file($filePath, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $fileName . '"'
            ]);
        } else {
            return response()->download($filePath, $fileName);
        }
    }

    public function generateSignedDocument($application)
    {
        $application = GradeCompletionApplication::with(['student', 'subject'])->findOrFail($application);
        
        if ($application->dean_status !== 'approved') {
            abort(403, 'Application not approved by Dean');
        }
        
        return view('faculty.signed-document', compact('application'));
    }
}
