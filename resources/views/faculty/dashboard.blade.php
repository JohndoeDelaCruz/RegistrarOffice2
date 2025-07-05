@extends('layouts.faculty')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome back, {{ $faculty->first_name ?? 'Faculty' }}!</h1>
                <p class="text-gray-600">Faculty Management System</p>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-2">
                <span class="text-sm font-medium text-green-800">{{ now()->format('F j, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Students</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $studentsCount ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-file-signature text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Grade Applications</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $pendingGradeApplications ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-clipboard-check text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Completed</h3>
                    <p class="text-2xl font-bold text-purple-600">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('faculty.students-checklist') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-list-check text-blue-600 text-xl mr-3"></i>
                <div>
                    <span class="font-medium text-gray-800">Students' Checklist</span>
                    <p class="text-sm text-gray-600">View and manage student grades</p>
                </div>
            </a>
            
            <a href="{{ route('faculty.grade-completion-applications') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-file-signature text-green-600 text-xl mr-3"></i>
                <div>
                    <span class="font-medium text-gray-800">Grade Completion</span>
                    <p class="text-sm text-gray-600">Process dean-approved applications</p>
                </div>
            </a>
            
            <a href="{{ route('faculty.announcement') }}" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-bullhorn text-purple-600 text-xl mr-3"></i>
                <div>
                    <span class="font-medium text-gray-800">Announcements</span>
                    <p class="text-sm text-gray-600">Post announcements</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Activity</h2>
        <div class="space-y-3">
            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                <div class="bg-blue-100 p-2 rounded-full mr-3">
                    <i class="fas fa-info-circle text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-800">Ready to manage student grades and applications</p>
                    <p class="text-xs text-gray-500">{{ now()->format('F j, Y g:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Deadline Monitoring -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Grade Completion Deadlines</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Overdue Applications -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-red-100 rounded-full p-3">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Overdue</h3>
                        <p class="text-2xl font-bold text-red-600">{{ $overdueCount }}</p>
                        <p class="text-sm text-red-600">Past deadline</p>
                    </div>
                </div>
            </div>

            <!-- Approaching Deadline -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-full p-3">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Approaching</h3>
                        <p class="text-2xl font-bold text-yellow-600">{{ $approachingDeadlineCount }}</p>
                        <p class="text-sm text-yellow-600">Within 30 days</p>
                    </div>
                </div>
            </div>

            <!-- Active Applications -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-full p-3">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Active</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $activeCount }}</p>
                        <p class="text-sm text-green-600">Within deadline</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
