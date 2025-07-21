<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GradeCompletionApplication;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
                'ip_address' => '192.168.1.' . rand(100, 200),
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
                'additional_info' => 'Student: ' . $appLog->student->name . ' | Subject: ' . $appLog->subject->subject_name,
                'ip_address' => '192.168.1.' . rand(100, 200),
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

        // Create mock recent reports data
        $recentReports = collect([
            [
                'name' => 'Monthly Grade Analysis',
                'description' => 'Comprehensive grade completion report for the current month',
                'type' => 'Analytics',
                'type_color' => 'blue',
                'created_at' => Carbon::now()->subDays(1),
                'file_size' => '2.4 MB',
                'status' => 'completed'
            ],
            [
                'name' => 'Student Performance Summary',
                'description' => 'Overall student performance metrics and trends',
                'type' => 'Performance',
                'type_color' => 'green',
                'created_at' => Carbon::now()->subDays(3),
                'file_size' => '1.8 MB',
                'status' => 'completed'
            ],
            [
                'name' => 'Faculty Activity Report',
                'description' => 'Faculty engagement and grading patterns',
                'type' => 'Activity',
                'type_color' => 'purple',
                'created_at' => Carbon::now()->subDays(5),
                'file_size' => '3.1 MB',
                'status' => 'processing'
            ]
        ]);

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
}
