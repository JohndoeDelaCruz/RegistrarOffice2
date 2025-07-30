<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GradeCompletionApplication;
use App\Models\FacultyNotification;
use App\Models\Announcement;
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
        
        // Fallback for demo purposes - but log this for debugging
        \Log::warning('FacultyController: Using fallback faculty selection. This might indicate a login issue.');
        return User::where('role', 'faculty')->first();
    }

    public function dashboard()
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get pending grade completion applications count for faculty's college students only
        $pendingGradeApplications = GradeCompletionApplication::where('dean_status', 'approved')
            ->whereNull('faculty_status')
            ->whereHas('student', function($query) use ($faculty) {
                $query->where('college', $faculty->college);
            })
            ->count();
        
        // Get total students count for faculty's college only
        $studentsCount = User::where('role', 'student')
            ->where('college', $faculty->college)
            ->count();
        
        // Get deadline statistics for approved applications from faculty's college students
        $approvedApplications = GradeCompletionApplication::where('dean_status', 'approved')
            ->whereNotNull('completion_deadline')
            ->whereHas('student', function($query) use ($faculty) {
                $query->where('college', $faculty->college);
            })
            ->get();
            
        $overdueCount = $approvedApplications->filter(function($app) {
            return $app->isDeadlinePassed();
        })->count();
        
        $approachingDeadlineCount = $approvedApplications->filter(function($app) {
            return $app->isDeadlineApproaching(30);
        })->count();
        
        $activeCount = $approvedApplications->filter(function($app) {
            return $app->deadline_status === 'active';
        })->count();
        
        // Get deadline notifications for this faculty
        $notifications = FacultyNotification::with(['application.student', 'application.subject'])
            ->where('faculty_id', $faculty->id)
            ->unread()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $unreadNotificationsCount = FacultyNotification::where('faculty_id', $faculty->id)
            ->unread()
            ->count();
        
        return view('faculty.dashboard', compact(
            'faculty', 
            'pendingGradeApplications', 
            'studentsCount',
            'overdueCount',
            'approachingDeadlineCount',
            'activeCount',
            'notifications',
            'unreadNotificationsCount'
        ));
    }

    public function studentsChecklist()
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get students from faculty's college only
        $students = User::where('role', 'student')
                       ->where('college', $faculty->college)
                       ->orderBy('name')
                       ->get(['id', 'name', 'student_id', 'course', 'track', 'email']);
        
        return view('faculty.students-checklist', compact('faculty', 'students'));
    }

    public function studentChecklistDetail($studentId)
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get the specific student from faculty's college only
        $student = User::where('role', 'student')
                      ->where('college', $faculty->college)
                      ->findOrFail($studentId);
        
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
        
        if (!$faculty) {
            return redirect('/')->with('error', 'Please log in as faculty to access this page.');
        }
        
        // Get dean announcements for faculty (audience: all or faculty)
        $deanAnnouncements = Announcement::published()
            ->forAudience('faculty')
            ->orderBy('published_at', 'desc')
            ->get();
        
        // Get faculty's own published announcements
        $facultyPublishedAnnouncements = Announcement::published()
            ->where('created_by', $faculty->id)
            ->orderBy('published_at', 'desc')
            ->get();
        
        // Get faculty's draft announcements
        $facultyDraftAnnouncements = Announcement::draft()
            ->where('created_by', $faculty->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('faculty.announcement', compact(
            'faculty', 
            'deanAnnouncements', 
            'facultyPublishedAnnouncements', 
            'facultyDraftAnnouncements'
        ));
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
            
            // Define allowed grade statuses
            $allowedStatuses = ['NFE', 'INC', 'NG', 'Failed'];
            
            // Validate the request
            $request->validate([
                'grade' => 'required|string|in:' . implode(',', $allowedStatuses)
            ]);
            
            // Get the student and subject (ensure student is from faculty's college)
            $student = User::where('role', 'student')
                          ->where('college', $faculty->college)
                          ->findOrFail($studentId);
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
                    'is_completed' => false, // Status grades indicate incomplete work
                    'completed_at' => null
                ]);
            } else {
                // Create new grade
                \App\Models\StudentGrade::create([
                    'user_id' => $studentId,
                    'subject_id' => $subjectId,
                    'grade' => $request->grade,
                    'academic_year' => $academicYearString,
                    'is_completed' => false, // Status grades indicate incomplete work
                    'completed_at' => null
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Grade status updated successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating grade status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeGrade(Request $request, $studentId, $subjectId)
    {
        try {
            $faculty = $this->getLoggedInFaculty();
            
            // Find and delete the grade status
            $grade = \App\Models\StudentGrade::where('user_id', $studentId)
                                           ->where('subject_id', $subjectId)
                                           ->first();
            
            if ($grade) {
                $grade->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Grade status cleared successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No grade status found to clear'
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing grade status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function gradeCompletionApplications()
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get applications from faculty's college that are approved by dean and sent to faculty
        $applications = GradeCompletionApplication::with(['student', 'subject'])
            ->where('dean_status', 'approved')
            ->whereNull('faculty_status') // Only show applications not yet processed by faculty
            ->whereHas('student', function($query) use ($faculty) {
                $query->where('college', $faculty->college);
            })
            ->orderBy('dean_reviewed_at', 'desc')
            ->get();
        
        return view('faculty.grade-completion-applications', compact('faculty', 'applications'));
    }

    public function viewApplication($id)
    {
        $faculty = $this->getLoggedInFaculty();
        
        // Get the application details with college filtering
        $application = GradeCompletionApplication::with('student')
            ->whereHas('student', function($query) use ($faculty) {
                $query->where('college', $faculty->college);
            })
            ->findOrFail($id);
        
        return view('faculty.view-grade-completion-application', compact('faculty', 'application'));
    }

    public function approveApplication(Request $request, $id)
    {
        try {
            $faculty = $this->getLoggedInFaculty();
            
            // Get the application with college filtering
            $application = GradeCompletionApplication::whereHas('student', function($query) use ($faculty) {
                    $query->where('college', $faculty->college);
                })
                ->findOrFail($id);
            
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
            
            // Get the application with college filtering
            $application = GradeCompletionApplication::whereHas('student', function($query) use ($faculty) {
                    $query->where('college', $faculty->college);
                })
                ->findOrFail($id);
            
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

            $faculty = $this->getLoggedInFaculty();
            
            $application = GradeCompletionApplication::whereHas('student', function($query) use ($faculty) {
                    $query->where('college', $faculty->college);
                })
                ->findOrFail($application);

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
        $faculty = $this->getLoggedInFaculty();
        
        $application = GradeCompletionApplication::with(['student', 'subject'])
            ->whereHas('student', function($query) use ($faculty) {
                $query->where('college', $faculty->college);
            })
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

    public function viewApplicationDocument(Request $request, $application)
    {
        $faculty = $this->getLoggedInFaculty();
        
        $application = GradeCompletionApplication::whereHas('student', function($query) use ($faculty) {
                $query->where('college', $faculty->college);
            })
            ->findOrFail($application);
        
        if (!$application->supporting_document) {
            abort(404, 'Document not found');
        }
        
        $filePath = storage_path('app/public/' . $application->supporting_document);
        
        if (!file_exists($filePath)) {
            abort(404, 'Document file not found');
        }
        
        // Use original filename if available, otherwise fall back to stored filename
        $fileName = $application->original_filename ?: basename($application->supporting_document);
        $mimeType = mime_content_type($filePath);
        
        // If download parameter is present, force download
        if ($request->get('download')) {
            return response()->download($filePath, $fileName);
        }
        
        // Display all files inline by default
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }

    public function generateSignedDocument($application)
    {
        $faculty = $this->getLoggedInFaculty();
        
        $application = GradeCompletionApplication::with(['student', 'subject'])
            ->whereHas('student', function($query) use ($faculty) {
                $query->where('college', $faculty->college);
            })
            ->findOrFail($application);
        
        if ($application->dean_status !== 'approved') {
            abort(403, 'Application not approved by Dean');
        }
        
        return view('faculty.signed-document', compact('application'));
    }

    /**
     * Create a new announcement
     */
    public function createAnnouncement(Request $request)
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return redirect('/')->with('error', 'Please log in as faculty to access this page.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:general,academic,administrative,urgent',
            'priority' => 'required|in:normal,high,urgent',
            'action' => 'required|in:save_draft,publish'
        ]);
        
        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->category = $request->category;
        $announcement->audience = 'students'; // Faculty can only create announcements for students
        $announcement->priority = $request->priority;
        $announcement->created_by = $faculty->id;
        
        if ($request->action === 'publish') {
            $announcement->is_published = true;
            $announcement->is_draft = false;
            $announcement->published_at = now();
        } else {
            $announcement->is_published = false;
            $announcement->is_draft = true;
            $announcement->published_at = null;
        }
        
        $announcement->save();
        
        $message = $request->action === 'publish' ? 'Announcement published successfully!' : 'Announcement saved as draft!';
        
        return redirect()->route('faculty.announcement')->with('success', $message);
    }

    /**
     * Publish a draft announcement
     */
    public function publishAnnouncement(Request $request, Announcement $announcement)
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return redirect('/')->with('error', 'Please log in as faculty to access this page.');
        }
        
        // Check if the faculty owns this announcement
        if ($announcement->created_by !== $faculty->id) {
            return redirect()->route('faculty.announcement')->with('error', 'You can only publish your own announcements.');
        }
        
        $announcement->is_published = true;
        $announcement->is_draft = false;
        $announcement->published_at = now();
        $announcement->save();
        
        return redirect()->route('faculty.announcement')->with('success', 'Announcement published successfully!');
    }

    /**
     * Delete an announcement
     */
    public function deleteAnnouncement(Request $request, Announcement $announcement)
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return redirect('/')->with('error', 'Please log in as faculty to access this page.');
        }
        
        // Check if the faculty owns this announcement
        if ($announcement->created_by !== $faculty->id) {
            return redirect()->route('faculty.announcement')->with('error', 'You can only delete your own announcements.');
        }
        
        $announcement->delete();
        
        return redirect()->route('faculty.announcement')->with('success', 'Announcement deleted successfully!');
    }

    public function gradeManagement()
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return redirect('/')->with('error', 'Please log in as faculty to access this page.');
        }
        
        // Get students from faculty's college who have dean-approved grade completion applications
        $studentsWithIncompleteGrades = User::where('role', 'student')
            ->where('college', $faculty->college)
            ->whereHas('gradeCompletionApplications', function ($query) {
                $query->where('dean_status', 'approved');
            })
            ->with(['gradeCompletionApplications' => function ($query) {
                $query->where('dean_status', 'approved')
                      ->with('subject');
            }])
            ->get();
        
        return view('faculty.grade-management', compact('faculty', 'studentsWithIncompleteGrades'));
    }

    public function getStudentGrades($studentId)
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return response()->json(['success' => false, 'message' => 'Please log in as faculty to access this page.']);
        }
        
        // Get the student
        $student = User::where('id', $studentId)
            ->where('role', 'student')
            ->first();
        
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found.']);
        }
        
        // Get student's dean-approved grade completion applications
        $applications = GradeCompletionApplication::with('subject')
            ->where('student_id', $studentId)
            ->where('dean_status', 'approved')
            ->get();
        
        return response()->json([
            'success' => true,
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'student_id' => $student->student_id,
                'course' => $student->course,
                'track' => $student->track
            ],
            'applications' => $applications->map(function ($application) {
                return [
                    'id' => $application->id,
                    'current_grade' => $application->current_grade,
                    'final_grade' => $application->final_grade,
                    'completion_deadline' => $application->completion_deadline ? $application->completion_deadline->format('M j, Y') : null,
                    'faculty_status' => $application->faculty_status,
                    'subject' => [
                        'id' => $application->subject->id,
                        'code' => $application->subject->code,
                        'description' => $application->subject->description,
                        'units' => $application->subject->units
                    ]
                ];
            })
        ]);
    }

    public function updateStudentGrade(Request $request)
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return response()->json(['success' => false, 'message' => 'Please log in as faculty to perform this action.']);
        }
        
        $request->validate([
            'application_id' => 'required|exists:grade_completion_applications,id',
            'final_grade' => 'required|numeric|min:1|max:100'
        ]);
        
        // Find the grade completion application
        $application = GradeCompletionApplication::where('id', $request->application_id)
            ->where('dean_status', 'approved')
            ->first();
        
        if (!$application) {
            return response()->json(['success' => false, 'message' => 'Grade completion application not found or not approved by dean.']);
        }
        
        // Update the application with final grade
        $application->update([
            'final_grade' => $request->final_grade,
            'faculty_status' => 'completed',
            'faculty_processed_at' => now(),
            'faculty_processed_by' => $faculty->id,
            'faculty_remarks' => 'Grade completion processed'
        ]);
        
        // Also update the actual student grade record
        $studentGrade = \App\Models\StudentGrade::where('user_id', $application->student_id)
            ->where('subject_id', $application->subject_id)
            ->first();
        
        if ($studentGrade) {
            $studentGrade->update([
                'grade' => $request->final_grade,
                'is_completed' => true,
                'completed_at' => now()
            ]);
        }
        
        return response()->json(['success' => true, 'message' => 'Grade updated successfully!']);
    }

    /**
     * Display all notifications for the faculty
     */
    public function notifications()
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return redirect('/')->with('error', 'Please log in as faculty to access this page.');
        }
        
        $notifications = FacultyNotification::with(['application.student', 'application.subject'])
            ->where('faculty_id', $faculty->id)
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        $unreadCount = FacultyNotification::where('faculty_id', $faculty->id)
            ->where('is_read', false)
            ->count();
        
        return view('faculty.notifications', compact('faculty', 'notifications', 'unreadCount'));
    }

    /**
     * Mark notification as read
     */
    public function markNotificationAsRead($id)
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return response()->json(['success' => false, 'message' => 'Authentication required'], 401);
        }
        
        $notification = FacultyNotification::where('id', $id)
            ->where('faculty_id', $faculty->id)
            ->first();
        
        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }
        
        $notification->markAsRead();
        
        return response()->json(['success' => true, 'message' => 'Notification marked as read']);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllNotificationsAsRead()
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return response()->json(['success' => false, 'message' => 'Authentication required'], 401);
        }
        
        FacultyNotification::where('faculty_id', $faculty->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        
        return response()->json(['success' => true, 'message' => 'All notifications marked as read']);
    }

    /**
     * Get unread notifications count
     */
    public function getUnreadNotificationsCount()
    {
        $faculty = $this->getLoggedInFaculty();
        
        if (!$faculty) {
            return response()->json(['success' => false, 'message' => 'Authentication required'], 401);
        }
        
        $count = FacultyNotification::where('faculty_id', $faculty->id)
            ->unread()
            ->count();
        
        return response()->json(['success' => true, 'count' => $count]);
    }
}
