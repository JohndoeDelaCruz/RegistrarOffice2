@extends('layouts.admin')

@section('page-title', 'Admin Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Welcome back, {{ $admin->name ?? 'Administrator' }}!</h1>
            <p class="text-gray-600">University of the Cordilleras - Administrative Control Panel</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-lg px-3 py-2 sm:px-4 sm:py-2">
            <span class="text-sm font-medium text-red-800">{{ now()->format('F j, Y') }}</span>
        </div>
    </div>
</div>

<!-- System Overview Stats -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full flex-shrink-0">
                <i class="fas fa-file-signature text-green-600 text-xl"></i>
            </div>
            <div class="ml-4 min-w-0">
                <h3 class="text-lg font-semibold text-gray-800 truncate">Applications</h3>
                <p class="text-2xl font-bold text-green-600">{{ $totalApplications }}</p>
                <p class="text-sm text-gray-500">Grade completion</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
        <div class="flex items-center">
            <div class="bg-yellow-100 p-3 rounded-full flex-shrink-0">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4 min-w-0">
                <h3 class="text-lg font-semibold text-gray-800 truncate">Pending</h3>
                <p class="text-2xl font-bold text-yellow-600">{{ $pendingApplications }}</p>
                <p class="text-sm text-gray-500">Awaiting review</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
        <div class="flex items-center">
            <div class="bg-purple-100 p-3 rounded-full flex-shrink-0">
                <i class="fas fa-bullhorn text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4 min-w-0">
                <h3 class="text-lg font-semibold text-gray-800 truncate">Announcements</h3>
                <p class="text-2xl font-bold text-purple-600">{{ $publishedAnnouncements }}</p>
                <p class="text-sm text-gray-500">Published</p>
            </div>
        </div>
    </div>
</div>

<!-- Application Status Overview -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Application Status Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-2 rounded-full mr-3">
                    <i class="fas fa-hourglass-half text-yellow-600"></i>
                </div>
                <span class="font-medium text-gray-700">Pending Review</span>
            </div>
            <div class="text-right">
                <span class="text-xl font-bold text-gray-800">{{ $pendingApplications }}</span>
                <span class="text-sm text-gray-500 block">{{ $totalApplications > 0 ? round(($pendingApplications / $totalApplications) * 100, 1) : 0 }}%</span>
            </div>
        </div>
        
        <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
            <div class="flex items-center">
                <div class="bg-green-100 p-2 rounded-full mr-3">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <span class="font-medium text-gray-700">Approved</span>
            </div>
            <div class="text-right">
                <span class="text-xl font-bold text-gray-800">{{ $approvedApplications }}</span>
                <span class="text-sm text-gray-500 block">{{ $totalApplications > 0 ? round(($approvedApplications / $totalApplications) * 100, 1) : 0 }}%</span>
            </div>
        </div>
        
        <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
            <div class="flex items-center">
                <div class="bg-red-100 p-2 rounded-full mr-3">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
                <span class="font-medium text-gray-700">Rejected</span>
            </div>
            <div class="text-right">
                <span class="text-xl font-bold text-gray-800">{{ $rejectedApplications }}</span>
                <span class="text-sm text-gray-500 block">{{ $totalApplications > 0 ? round(($rejectedApplications / $totalApplications) * 100, 1) : 0 }}%</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Recent Dean Approvals</h2>
        <div class="space-y-3">
            @forelse($recentApprovals as $approval)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                <div class="flex items-center">
                    <div class="bg-{{ $approval->dean_status === 'approved' ? 'green' : 'red' }}-100 p-2 rounded-full mr-3">
                        <i class="fas fa-{{ $approval->dean_status === 'approved' ? 'check' : 'times' }} text-{{ $approval->dean_status === 'approved' ? 'green' : 'red' }}-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $approval->student->name }}</p>
                        <p class="text-sm text-gray-500">{{ $approval->subject->code }} • {{ $approval->dean_reviewed_at ? $approval->dean_reviewed_at->format('M j, Y') : 'Pending' }}</p>
                    </div>
                </div>
                <span class="text-xs px-2 py-1 bg-{{ $approval->dean_status === 'approved' ? 'green' : 'red' }}-100 text-{{ $approval->dean_status === 'approved' ? 'green' : 'red' }}-600 rounded-full">
                    {{ ucfirst($approval->dean_status) }}
                </span>
            </div>
            @empty
            <div class="text-center py-4 text-gray-500">
                <i class="fas fa-info-circle mb-2"></i>
                <p>No recent approvals</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.user-management') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
            <i class="fas fa-users text-blue-600 text-xl mr-3"></i>
            <div>
                <span class="font-medium text-gray-800 block">Manage Users</span>
                <p class="text-sm text-gray-600">View and edit user accounts</p>
            </div>
        </a>
        
        <a href="{{ route('admin.application-tracking') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
            <i class="fas fa-file-signature text-green-600 text-xl mr-3"></i>
            <div>
                <span class="font-medium text-gray-800 block">Track Applications</span>
                <p class="text-sm text-gray-600">Monitor grade completion requests</p>
            </div>
        </a>
        
        <a href="{{ route('admin.system-logs') }}" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
            <i class="fas fa-clipboard-list text-purple-600 text-xl mr-3"></i>
            <div>
                <span class="font-medium text-gray-800 block">System Logs</span>
                <p class="text-sm text-gray-600">View activity and audit trail</p>
            </div>
        </a>
        
        <a href="{{ route('admin.reports') }}" class="flex items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition-colors duration-200">
            <i class="fas fa-chart-bar text-yellow-600 text-xl mr-3"></i>
            <div>
                <span class="font-medium text-gray-800 block">Generate Reports</span>
                <p class="text-sm text-gray-600">Analytics and statistics</p>
            </div>
        </a>
    </div>
</div>
@endsection
