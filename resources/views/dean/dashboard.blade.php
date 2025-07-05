@extends('layouts.dean')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Faculty</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $facultyCount ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-file-signature text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Pending Applications</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ $pendingApplicationsCount ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-bullhorn text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Announcements</h3>
                    <p class="text-2xl font-bold text-orange-600">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('dean.grade-completion-applications') }}" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-file-alt text-purple-600 text-xl mr-3"></i>
                <div>
                    <span class="font-medium text-gray-800">Review Applications</span>
                    @if($pendingApplicationsCount > 0)
                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $pendingApplicationsCount }} pending
                        </span>
                    @endif
                </div>
            </a>
            
            <a href="{{ route('dean.approved-applications') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                <div>
                    <span class="font-medium text-gray-800">Approved Applications</span>
                    <span class="text-xs text-gray-500 block">View your signed applications</span>
                </div>
            </a>
            
            <a href="{{ route('dean.announcement') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-bullhorn text-blue-600 text-xl mr-3"></i>
                <span class="font-medium text-gray-800">Post Announcement</span>
            </a>
        </div>
    </div>


</div>
@endsection
