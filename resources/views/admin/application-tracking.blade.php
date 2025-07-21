@extends('layouts.admin')

@section('page-title', 'Application Tracking')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Application Tracking</h1>
            <p class="text-gray-600">Monitor and track all grade completion applications</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-sync mr-2"></i>Refresh
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Status Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Pending Review</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ $applications->where('dean_status', null)->count() }}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Awaiting dean approval</span>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Approved</h3>
                <p class="text-3xl font-bold text-green-600">{{ $applications->where('dean_status', 'approved')->count() }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Dean approved applications</span>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Rejected</h3>
                <p class="text-3xl font-bold text-red-600">{{ $applications->where('dean_status', 'rejected')->count() }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Rejected by dean</span>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Applications</label>
            <div class="relative">
                <input type="text" placeholder="Search by student name or ID..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Time</option>
                <option value="today">Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Actions</label>
            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-undo mr-2"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Applications Table -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Student
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Subject
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Current Grade
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Submitted
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Dean Review
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($applications as $application)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                <i class="fas fa-user-graduate text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->student->name }}</div>
                                <div class="text-sm text-gray-500">{{ $application->student->student_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $application->subject->code }}</div>
                        <div class="text-sm text-gray-500">{{ $application->subject->description }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $application->current_grade }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        <div>{{ $application->created_at->format('M j, Y') }}</div>
                        <div class="text-xs">{{ $application->created_at->format('g:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($application->dean_status === null)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @elseif($application->dean_status === 'approved')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Approved
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>Rejected
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        @if($application->dean_reviewed_at)
                            <div>{{ $application->dean_reviewed_at->format('M j, Y') }}</div>
                            <div class="text-xs">{{ $application->dean_reviewed_at->format('g:i A') }}</div>
                        @else
                            <span class="text-gray-400">Not reviewed</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-2">
                            <button class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if($application->supporting_document)
                            <button class="text-green-600 hover:text-green-900 transition-colors duration-200" title="View Document">
                                <i class="fas fa-file-alt"></i>
                            </button>
                            @endif
                            @if($application->dean_status === 'approved')
                            <button class="text-purple-600 hover:text-purple-900 transition-colors duration-200" title="View Signed Document">
                                <i class="fas fa-file-signature"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-file-signature text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No applications found</p>
                        <p>Applications will appear here when students submit grade completion requests</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($applications->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $applications->links() }}
    </div>
    @endif
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Processing Time</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Average Review Time:</span>
                <span class="text-sm font-medium text-gray-800">2.3 days</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Fastest Review:</span>
                <span class="text-sm font-medium text-gray-800">4 hours</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Longest Review:</span>
                <span class="text-sm font-medium text-gray-800">7 days</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Grade Distribution</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">INC (Incomplete):</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('current_grade', 'INC')->count() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">NFE (No Final Exam):</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('current_grade', 'NFE')->count() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">NG (No Grade):</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('current_grade', 'NG')->count() }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Today:</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('created_at', '>=', today())->count() }} new</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">This Week:</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('created_at', '>=', now()->startOfWeek())->count() }} new</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">This Month:</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('created_at', '>=', now()->startOfMonth())->count() }} new</span>
            </div>
        </div>
    </div>
</div>
@endsection
