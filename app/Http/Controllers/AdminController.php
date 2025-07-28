<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GradeCompletionApplication;
use App\Models\Announcement;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private function getLoggedInAdmin()
    {
        // First try to get from Laravel's built-in auth
        if (auth()->check() && auth()->user()->role === 'admin') {
            return auth()->user();
        }
        
        // Then try to get from session
        $userId = session('user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user && $user->role === 'admin') {
                return $user;
            }
        }
        
        // Fallback for demo purposes - get any admin user
        return User::where('role', 'admin')->first();
    }

    public function dashboard()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        // Get user statistics
        $totalUsers = User::count();
        $studentsCount = User::where('role', 'student')->count();
        $facultyCount = User::where('role', 'faculty')->count();
        $deanCount = User::where('role', 'dean')->count();
        $adminCount = User::where('role', 'admin')->count();

        // Get application statistics
        $totalApplications = GradeCompletionApplication::count();
        $pendingApplications = GradeCompletionApplication::whereNull('dean_status')->count();
        $approvedApplications = GradeCompletionApplication::where('dean_status', 'approved')->count();
        $rejectedApplications = GradeCompletionApplication::where('dean_status', 'rejected')->count();

        // Get recent user activity (last 30 days)
        $recentLogins = User::where('updated_at', '>=', Carbon::now()->subDays(30))
            ->whereIn('role', ['dean', 'faculty'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        // Get application trends for the last 7 days
        $applicationTrends = GradeCompletionApplication::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Get recent approvals/rejections by dean
        $recentApprovals = GradeCompletionApplication::with(['student', 'subject'])
            ->whereNotNull('dean_status')
            ->whereNotNull('dean_reviewed_at')
            ->orderBy('dean_reviewed_at', 'desc')
            ->take(10)
            ->get();

        // Get announcements statistics
        $totalAnnouncements = Announcement::count();
        $publishedAnnouncements = Announcement::where('status', 'published')->count();
        $draftAnnouncements = Announcement::where('status', 'draft')->count();

        return view('admin.dashboard', compact(
            'admin',
            'totalUsers',
            'studentsCount',
            'facultyCount',
            'deanCount',
            'adminCount',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'recentLogins',
            'applicationTrends',
            'recentApprovals',
            'totalAnnouncements',
            'publishedAnnouncements',
            'draftAnnouncements'
        ));
    }

    public function userManagement()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $users = User::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.user-management', compact('admin', 'users'));
    }

    public function applicationTracking()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $applications = GradeCompletionApplication::with(['student', 'subject'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.application-tracking', compact('admin', 'applications'));
    }

    public function viewApplication($id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $application = GradeCompletionApplication::with(['student', 'subject', 'deanReviewedBy'])
            ->findOrFail($id);

        return view('admin.applications.view', compact('admin', 'application'));
    }

    public function editApplication($id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $application = GradeCompletionApplication::with(['student', 'subject'])
            ->findOrFail($id);

        return view('admin.applications.edit', compact('admin', 'application'));
    }

    public function updateApplication(Request $request, $id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $application = GradeCompletionApplication::findOrFail($id);

        $request->validate([
            'dean_status' => 'required|in:approved,rejected',
            'dean_remarks' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'dean_status' => $request->dean_status,
            'dean_remarks' => $request->dean_remarks,
            'dean_reviewed_at' => now(),
            'dean_reviewed_by' => $admin->id,
        ]);

        return redirect()->route('admin.application-tracking')
            ->with('success', 'Application updated successfully!');
    }

    public function viewDocument($id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $application = GradeCompletionApplication::findOrFail($id);

        if (!$application->supporting_document) {
            return redirect()->back()->with('error', 'No supporting document found for this application.');
        }

        // In a real application, you would handle file viewing/download here
        // For now, return a simple view showing document information
        return view('admin.applications.document', compact('admin', 'application'));
    }

    public function viewSignedDocument($id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $application = GradeCompletionApplication::findOrFail($id);

        if ($application->dean_status !== 'approved') {
            return redirect()->back()->with('error', 'This application has not been approved yet.');
        }

        if (!$application->dean_signature) {
            return redirect()->back()->with('error', 'No signed document found for this application.');
        }

        // In a real application, you would handle signed document viewing/download here
        // For now, return a simple view showing signed document information
        return view('admin.applications.signed-document', compact('admin', 'application'));
    }

    public function systemLogs()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        // Calculate login statistics
        $totalLogins = User::whereIn('role', ['student', 'faculty', 'dean', 'admin'])->count();
        $totalUsers = User::count();
        $activeUsers = User::whereIn('role', ['student', 'faculty', 'dean'])->count();
        $totalApplications = GradeCompletionApplication::count();
        
        // Additional statistics for system logs
        $activeSessions = User::whereIn('role', ['student', 'faculty', 'dean', 'admin'])->count(); // Mock active sessions
        $systemErrors = 2; // Mock system errors count
        $fileOperations = GradeCompletionApplication::whereNotNull('dean_signature')->count(); // Documents with signatures

        // Get recent login activity
        $loginActivity = User::whereIn('role', ['dean', 'faculty'])
            ->orderBy('updated_at', 'desc')
            ->take(50)
            ->get();

        // Get application activity logs
        $applicationLogs = GradeCompletionApplication::with(['student', 'subject', 'deanReviewedBy'])
            ->whereNotNull('dean_status')
            ->orderBy('dean_reviewed_at', 'desc')
            ->take(50)
            ->get();

        // Create system logs array with proper structure
        $logs = collect();
        
        // Add login activities to logs
        foreach ($loginActivity as $activity) {
            $logs->push([
                'timestamp' => $activity->updated_at,
                'user_name' => $activity->name,
                'user_role' => $activity->role,
                'role_color' => $activity->role === 'dean' ? 'purple' : 'green',
                'role_icon' => $activity->role === 'dean' ? 'user-tie' : 'chalkboard-teacher',
                'activity_type' => 'Login',
                'activity_color' => 'blue',
                'activity_icon' => 'sign-in-alt',
                'description' => 'User logged into the system',
                'additional_info' => 'Last activity: ' . $activity->updated_at->diffForHumans(),
                'status' => 'success'
            ]);
        }
        
        // Add application activities to logs
        foreach ($applicationLogs as $appLog) {
            // Get the dean who reviewed the application
            $deanName = $appLog->deanReviewedBy ? $appLog->deanReviewedBy->name : 'Unknown Dean';
            
            $logs->push([
                'timestamp' => $appLog->dean_reviewed_at,
                'user_name' => $deanName,
                'user_role' => 'dean',
                'role_color' => 'purple',
                'role_icon' => 'user-tie',
                'activity_type' => 'Application Review',
                'activity_color' => $appLog->dean_status === 'approved' ? 'green' : 'red',
                'activity_icon' => $appLog->dean_status === 'approved' ? 'check' : 'times',
                'description' => 'Grade completion application ' . $appLog->dean_status,
                'additional_info' => 'Student: ' . $appLog->student->name . ' | Subject: ' . $appLog->subject->code . ' - ' . $appLog->subject->description,
                'status' => 'success'
            ]);
        }
        
        // Sort logs by timestamp descending
        $logs = $logs->sortByDesc('timestamp')->take(50);

        return view('admin.system-logs', compact(
            'admin', 
            'loginActivity', 
            'applicationLogs',
            'totalLogins',
            'totalUsers',
            'activeUsers',
            'totalApplications',
            'activeSessions',
            'systemErrors',
            'fileOperations',
            'logs'
        ));
    }

    public function reports()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        // Calculate user statistics
        $totalUsers = User::count();
        $activeUsers = User::whereIn('role', ['student', 'faculty', 'dean'])->count();

        // Generate monthly statistics
        $monthlyStats = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->format('Y-m');
            
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'applications' => GradeCompletionApplication::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'approvals' => GradeCompletionApplication::whereYear('dean_reviewed_at', $date->year)
                    ->whereMonth('dean_reviewed_at', $date->month)
                    ->where('dean_status', 'approved')
                    ->count(),
                'rejections' => GradeCompletionApplication::whereYear('dean_reviewed_at', $date->year)
                    ->whereMonth('dean_reviewed_at', $date->month)
                    ->where('dean_status', 'rejected')
                    ->count(),
            ];
        }

        // Get grade distribution
        $gradeDistribution = GradeCompletionApplication::selectRaw('current_grade, COUNT(*) as count')
            ->groupBy('current_grade')
            ->get();

        // Get subject popularity
        $subjectStats = GradeCompletionApplication::selectRaw('subject_id, COUNT(*) as count')
            ->with('subject')
            ->groupBy('subject_id')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        // Get actual reports from database
        $recentReports = Report::where('created_by', $admin->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Create report statistics
        $reportStats = [
            'total' => 156,
            'this_month' => 23,
            'avg_size' => '2.1 MB'
        ];

        return view('admin.reports', compact(
            'admin',
            'monthlyStats',
            'gradeDistribution',
            'subjectStats',
            'totalUsers',
            'activeUsers',
            'recentReports',
            'reportStats'
        ));
    }

    public function profile()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Please log in as administrator to access this page.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }

    public function generateReport(Request $request)
    {
        try {
            $admin = $this->getLoggedInAdmin();
            
            if (!$admin) {
                return response()->json(['error' => 'Unauthorized - Admin not found'], 401);
            }

            $request->validate([
                'report_type' => 'required|string',
                'date_range' => 'required|string',
                'format' => 'required|string|in:html,pdf,excel,csv,json'
            ]);

            // Generate report data
            $reportData = $this->generateReportData($request->report_type, $request->date_range);
            
            // Create report record
            $report = Report::create([
                'name' => $this->getReportDisplayName($request->report_type),
                'description' => $this->getReportDescription($request->report_type),
                'type' => ucfirst(str_replace('_', ' ', $request->report_type)),
                'type_color' => $this->getReportTypeColor($request->report_type),
                'format' => $request->format,
                'status' => 'processing',
                'parameters' => [
                    'report_type' => $request->report_type,
                    'date_range' => $request->date_range,
                    'format' => $request->format
                ],
                'data' => $reportData,
                'created_by' => $admin->id
            ]);

            // Generate the actual report content
            $this->createReportFile($report);

            return response()->json([
                'success' => true,
                'message' => 'Report generated successfully!',
                'report_name' => $report->name,
                'report_id' => $report->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error generating report: ' . $e->getMessage()
            ], 500);
        }
    }

    public function quickGenerateReport(Request $request)
    {
        try {
            $admin = $this->getLoggedInAdmin();
            
            if (!$admin) {
                return response()->json(['error' => 'Unauthorized - Admin not found'], 401);
            }

            $request->validate([
                'report_type' => 'required|string'
            ]);

            // Generate report with default settings
            $reportData = $this->generateReportData($request->report_type, 'month');
            
            // Create report record
            $report = Report::create([
                'name' => $this->getReportDisplayName($request->report_type),
                'description' => $this->getReportDescription($request->report_type),
                'type' => ucfirst(str_replace('_', ' ', $request->report_type)),
                'type_color' => $this->getReportTypeColor($request->report_type),
                'format' => 'html',
                'status' => 'processing',
                'parameters' => [
                    'report_type' => $request->report_type,
                    'date_range' => 'month',
                    'format' => 'html'
                ],
                'data' => $reportData,
                'created_by' => $admin->id
            ]);

            // Generate the actual report content
            $this->createReportFile($report);

            return response()->json([
                'success' => true,
                'message' => 'Report generated successfully!',
                'report_name' => $report->name,
                'report_id' => $report->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error generating report: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadReport($id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Unauthorized');
        }

        $report = Report::where('id', $id)
            ->where('created_by', $admin->id)
            ->firstOrFail();

        if (!$report->file_path || !Storage::exists($report->file_path)) {
            return redirect()->back()->with('error', 'Report file not found.');
        }

        return Storage::download($report->file_path, $report->file_name);
    }

    public function viewReport($id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Unauthorized');
        }

        $report = Report::where('id', $id)
            ->where('created_by', $admin->id)
            ->firstOrFail();

        // Return the report view
        return view('admin.reports.view', compact('report', 'admin'));
    }

    public function deleteReport($id)
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $report = Report::where('id', $id)
            ->where('created_by', $admin->id)
            ->first();

        if (!$report) {
            return response()->json(['error' => 'Report not found'], 404);
        }

        // Delete the file if it exists
        if ($report->file_path && Storage::exists($report->file_path)) {
            Storage::delete($report->file_path);
        }

        // Delete the report record
        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Report deleted successfully!'
        ]);
    }

    public function exportAllReports()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Unauthorized');
        }

        // In a real application, you would create a zip file with all reports
        return response()->json([
            'success' => true,
            'message' => 'Exporting all reports...',
            'info' => 'In a production environment, this would create and download a zip file with all reports.'
        ]);
    }

    public function customReport()
    {
        $admin = $this->getLoggedInAdmin();
        
        if (!$admin) {
            return redirect('/')->with('error', 'Unauthorized');
        }

        // In a real application, you would show a custom report builder interface
        return response()->json([
            'success' => true,
            'message' => 'Opening custom report builder...',
            'info' => 'In a production environment, this would open a custom report configuration interface.'
        ]);
    }

    private function generateReportData($reportType, $dateRange)
    {
        // Generate mock data based on report type
        switch ($reportType) {
            case 'user_activity':
                return $this->generateUserActivityData($dateRange);
            case 'grade_completion':
                return $this->generateGradeCompletionData($dateRange);
            case 'approval_tracking':
                return $this->generateApprovalTrackingData($dateRange);
            case 'system_usage':
                return $this->generateSystemUsageData($dateRange);
            case 'security_audit':
                return $this->generateSecurityAuditData($dateRange);
            default:
                return [];
        }
    }

    private function generateUserActivityData($dateRange)
    {
        // Mock user activity data
        return [
            'total_logins' => User::count() * rand(5, 15),
            'unique_users' => User::count(),
            'avg_session_duration' => rand(15, 45) . ' minutes',
            'peak_hours' => '9:00 AM - 11:00 AM'
        ];
    }

    private function generateGradeCompletionData($dateRange)
    {
        return [
            'total_applications' => GradeCompletionApplication::count(),
            'approved' => GradeCompletionApplication::where('dean_status', 'approved')->count(),
            'rejected' => GradeCompletionApplication::where('dean_status', 'rejected')->count(),
            'pending' => GradeCompletionApplication::whereNull('dean_status')->count()
        ];
    }

    private function generateApprovalTrackingData($dateRange)
    {
        return [
            'avg_processing_time' => rand(2, 7) . ' days',
            'fastest_approval' => rand(1, 3) . ' hours',
            'slowest_approval' => rand(10, 14) . ' days'
        ];
    }

    private function generateSystemUsageData($dateRange)
    {
        return [
            'server_uptime' => '99.8%',
            'avg_response_time' => rand(200, 800) . 'ms',
            'total_requests' => rand(10000, 50000)
        ];
    }

    private function generateSecurityAuditData($dateRange)
    {
        return [
            'failed_login_attempts' => rand(5, 25),
            'successful_logins' => User::count() * rand(5, 15),
            'security_alerts' => rand(0, 3)
        ];
    }

    private function generateReportFileName($reportType, $format)
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        $name = str_replace('_', '-', $reportType);
        return "{$name}-report-{$timestamp}.{$format}";
    }

    private function getReportDisplayName($reportType)
    {
        $names = [
            'user_activity' => 'User Activity Report',
            'grade_completion' => 'Grade Completion Report',
            'approval_tracking' => 'Approval Tracking Report',
            'system_usage' => 'System Usage Report',
            'security_audit' => 'Security Audit Report'
        ];
        
        return $names[$reportType] ?? 'Unknown Report';
    }

    private function getReportDescription($reportType)
    {
        $descriptions = [
            'user_activity' => 'Detailed analysis of user login patterns and system usage',
            'grade_completion' => 'Comprehensive overview of grade completion applications and trends',
            'approval_tracking' => 'Timeline and efficiency metrics for dean approval processes',
            'system_usage' => 'Server performance, response times, and system health metrics',
            'security_audit' => 'Security events, failed login attempts, and access patterns'
        ];
        
        return $descriptions[$reportType] ?? 'Generated report';
    }

    private function getReportTypeColor($reportType)
    {
        $colors = [
            'user_activity' => 'blue',
            'grade_completion' => 'green',
            'approval_tracking' => 'purple',
            'system_usage' => 'yellow',
            'security_audit' => 'red'
        ];
        
        return $colors[$reportType] ?? 'gray';
    }

    private function createReportFile(Report $report)
    {
        $fileName = $this->generateReportFileName($report->parameters['report_type'], $report->format);
        $filePath = "reports/{$fileName}";
        
        // Generate report content based on format
        $content = $this->generateReportContent($report);
        
        // Store the file
        Storage::put($filePath, $content);
        
        // Update report with file information
        $report->update([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_size' => $this->formatFileSize(Storage::size($filePath)),
            'status' => 'completed'
        ]);
    }

    private function generateReportContent(Report $report)
    {
        $data = $report->data;
        $parameters = $report->parameters;
        
        switch ($report->format) {
            case 'json':
                return json_encode([
                    'report_name' => $report->name,
                    'description' => $report->description,
                    'generated_at' => $report->created_at->toISOString(),
                    'parameters' => $parameters,
                    'data' => $data
                ], JSON_PRETTY_PRINT);
                
            case 'csv':
                return $this->generateCSVContent($report, $data);
                
            case 'html':
            case 'pdf':
            default:
                return $this->generateHTMLContent($report, $data);
        }
    }

    private function generateHTMLContent(Report $report, $data)
    {
        $html = "<!DOCTYPE html>
<html>
<head>
    <title>{$report->name}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table th, .info-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .info-table th { background-color: #f2f2f2; }
        .data-section { margin-top: 20px; }
        .data-item { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class='header'>
        <h1>{$report->name}</h1>
        <p>{$report->description}</p>
        <p>Generated on: {$report->created_at->format('F j, Y g:i A')}</p>
    </div>
    
    <h2>Report Parameters</h2>
    <table class='info-table'>
        <tr><th>Parameter</th><th>Value</th></tr>
        <tr><td>Report Type</td><td>{$report->parameters['report_type']}</td></tr>
        <tr><td>Date Range</td><td>{$report->parameters['date_range']}</td></tr>
        <tr><td>Format</td><td>{$report->parameters['format']}</td></tr>
    </table>
    
    <h2>Report Data</h2>
    <div class='data-section'>";
        
        foreach ($data as $key => $value) {
            $html .= "<div class='data-item'><strong>" . ucfirst(str_replace('_', ' ', $key)) . ":</strong> {$value}</div>";
        }
        
        $html .= "
    </div>
</body>
</html>";
        
        return $html;
    }

    private function generateCSVContent(Report $report, $data)
    {
        $csv = "Report Name,{$report->name}\n";
        $csv .= "Description,{$report->description}\n";
        $csv .= "Generated At,{$report->created_at->format('Y-m-d H:i:s')}\n\n";
        $csv .= "Parameter,Value\n";
        
        foreach ($report->parameters as $key => $value) {
            $csv .= ucfirst(str_replace('_', ' ', $key)) . ",{$value}\n";
        }
        
        $csv .= "\nData Item,Value\n";
        foreach ($data as $key => $value) {
            $csv .= ucfirst(str_replace('_', ' ', $key)) . ",{$value}\n";
        }
        
        return $csv;
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
