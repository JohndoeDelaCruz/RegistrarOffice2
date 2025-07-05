<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GradeCompletionApplication;
use App\Models\Subject;
use Carbon\Carbon;

class DeanController extends Controller
{
    public function dashboard()
    {
        // Get the logged-in dean user
        $dean = $this->getLoggedInDean();
        
        // Get pending applications count
        $pendingApplicationsCount = GradeCompletionApplication::deanPending()->count();
        
        // Get student and faculty counts
        $studentsCount = User::where('role', 'student')->count();
        $facultyCount = User::where('role', 'faculty')->count();
        
        // Get deadline statistics for approved applications
        $approvedApplications = GradeCompletionApplication::where('dean_status', 'approved')
            ->whereNotNull('completion_deadline')
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
        
        return view('dean.dashboard', compact(
            'dean', 
            'pendingApplicationsCount', 
            'studentsCount', 
            'facultyCount',
            'overdueCount',
            'approachingDeadlineCount',
            'activeCount'
        ));
    }

    public function announcement()
    {
        $dean = $this->getLoggedInDean();
        return view('dean.announcement', compact('dean'));
    }

    public function profile()
    {
        $dean = $this->getLoggedInDean();
        return view('dean.profile', compact('dean'));
    }

    public function gradeCompletionApplications()
    {
        $dean = $this->getLoggedInDean();
        
        $applications = GradeCompletionApplication::with(['student', 'subject'])
            ->deanPending()
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('dean.grade-completion-applications', compact('dean', 'applications'));
    }

    public function approvedApplications()
    {
        $dean = $this->getLoggedInDean();
        
        $applications = GradeCompletionApplication::with(['student', 'subject'])
            ->where('dean_reviewed_by', $dean->id)
            ->where('dean_status', 'approved')
            ->orderBy('dean_reviewed_at', 'desc')
            ->get();
        
        return view('dean.approved-applications', compact('dean', 'applications'));
    }

    public function reviewApplication(Request $request, $application)
    {
        try {
            $request->validate([
                'action' => 'required|in:approve,reject',
                'dean_remarks' => 'nullable|string|max:1000',
                'dean_signature_file' => 'nullable|file|mimes:png,jpg,jpeg|max:2048'
            ]);

            $application = GradeCompletionApplication::findOrFail($application);
            $dean = $this->getLoggedInDean();

            if (!$dean) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dean user not found'
                ], 403);
            }

            $updateData = [
                'dean_status' => $request->action === 'approve' ? 'approved' : 'rejected',
                'dean_remarks' => $request->dean_remarks,
                'dean_reviewed_at' => Carbon::now(),
                'dean_reviewed_by' => $dean->id
            ];

            // Handle signature upload and deadline for approved applications
            if ($request->action === 'approve') {
                // Set deadline to 3 months (1 term) from approval date
                $updateData['completion_deadline'] = Carbon::now()->addMonths(3);
                
                if ($request->hasFile('dean_signature_file')) {
                    $file = $request->file('dean_signature_file');
                    $fileName = 'dean_signature_' . $application->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('dean_signatures', $fileName, 'public');
                    
                    $updateData['dean_signature'] = $filePath;
                    $updateData['dean_signature_type'] = 'uploaded_file';
                    $updateData['dean_signature_date'] = Carbon::now();
                }
            }

            $application->update($updateData);

            if ($request->action === 'approve') {
                $message = 'Application approved successfully and forwarded to faculty.';
            } else {
                $message = 'Application rejected. Student will be notified.';
            }

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

    public function getApplicationDetails($application)
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
                'dean_reviewed_at' => $application->dean_reviewed_at ? $application->dean_reviewed_at->format('F j, Y g:i A') : null
            ]
        ]);
    }

    public function viewDocument($application)
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
            abort(403, 'Application not approved');
        }
        
        return view('dean.signed-document', compact('application'));
    }

    public function viewSignature($application)
    {
        $application = GradeCompletionApplication::findOrFail($application);
        
        if (!$application->dean_signature || $application->dean_signature_type !== 'uploaded_file') {
            abort(404, 'Signature file not found');
        }
        
        $filePath = storage_path('app/public/' . $application->dean_signature);
        
        if (!file_exists($filePath)) {
            abort(404, 'Signature file not found');
        }
        
        $fileName = basename($application->dean_signature);
        $mimeType = mime_content_type($filePath);
        
        // Display signature image inline
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }

    /**
     * Get the currently logged-in dean user
     */
    private function getLoggedInDean()
    {
        // First try to get from Laravel's built-in auth
        if (auth()->check() && auth()->user()->role === 'dean') {
            return auth()->user();
        }
        
        // Then try to get from session
        $userId = session('user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user && $user->role === 'dean') {
                return $user;
            }
        }
        
        // Fallback for demo purposes - this should ideally redirect to login
        return User::where('role', 'dean')->first();
    }
}
