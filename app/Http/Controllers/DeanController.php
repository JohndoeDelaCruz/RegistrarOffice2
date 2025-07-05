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
        
        return view('dean.dashboard', compact('dean', 'pendingApplicationsCount'));
    }

    public function digitalSignature()
    {
        $dean = $this->getLoggedInDean();
        return view('dean.digital-signature', compact('dean'));
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
                'dean_signature' => 'nullable|string|max:5000',
                'dean_signature_file' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
                'signature_type' => 'nullable|string|in:auto,custom,file'
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

            // Add signature for approved applications
            if ($request->action === 'approve') {
                $signatureType = $request->signature_type ?? 'auto';
                
                if ($signatureType === 'file' && $request->hasFile('dean_signature_file')) {
                    // Handle file upload
                    $file = $request->file('dean_signature_file');
                    $fileName = 'dean_signature_' . $application->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('dean_signatures', $fileName, 'public');
                    
                    $updateData['dean_signature'] = $filePath;
                    $updateData['dean_signature_type'] = 'uploaded_file';
                } elseif ($signatureType === 'custom' && $request->dean_signature) {
                    $updateData['dean_signature'] = $request->dean_signature;
                    $updateData['dean_signature_type'] = 'custom_text';
                } else {
                    // Auto-generated signature
                    $updateData['dean_signature'] = $this->getDeanDigitalSignature($dean);
                    $updateData['dean_signature_type'] = 'auto_generated';
                }
                
                $updateData['dean_signature_date'] = Carbon::now();
            }

            $application->update($updateData);

            if ($request->action === 'approve') {
                $message = 'Application approved successfully with digital signature and forwarded to faculty.';
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

        $signatureDisplay = '';
        if ($application->dean_signature_type === 'uploaded_file') {
            $signatureDisplay = 'Uploaded signature file';
        } else {
            $signatureDisplay = $application->dean_signature;
        }

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
                'dean_signature' => $signatureDisplay,
                'dean_signature_type' => $application->dean_signature_type,
                'dean_signature_date' => $application->dean_signature_date ? $application->dean_signature_date->format('F j, Y g:i A') : null,
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
        
        // For images and PDFs, display inline
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

    private function getDeanDigitalSignature($dean)
    {
        // This would typically come from a dean signatures table or user profile
        // For now, we'll create a simple digital signature
        return "Digitally signed by: " . $dean->first_name . " " . $dean->last_name . "\n" .
               "Position: Dean\n" .
               "Date: " . now()->format('F j, Y g:i A') . "\n" .
               "Signature ID: DEAN-" . $dean->id . "-" . time();
    }
}
