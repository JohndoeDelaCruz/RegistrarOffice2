@extends('layouts.student')

@section('page-title', 'Student Dashboard')

@section('content')
@isset($student)
    <!-- Welcome Card -->
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 mb-4 sm:mb-6">
        <h2 class="text-lg sm:text-xl font-semibold text-uc-green mb-2">Welcome, {{ $student->name }}!</h2>
        <p class="text-sm sm:text-base text-gray-600 mb-2">{{ $student->course }} - {{ $student->track }}</p>
        <p class="text-xs sm:text-sm text-gray-500">Student ID: {{ $student->student_id }}</p>
    </div>

    <!-- Track Information -->
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 mb-4 sm:mb-6">
        <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Track Information</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label class="text-xs sm:text-sm font-medium text-gray-600">Course</label>
                <p class="text-sm sm:text-base text-gray-800">{{ $student->course }}</p>
            </div>
            <div class="space-y-1">
                <label class="text-xs sm:text-sm font-medium text-gray-600">Specialization Track</label>
                <p class="text-sm sm:text-base text-gray-800">{{ $student->track }}</p>
            </div>
            <div class="space-y-1">
                <label class="text-xs sm:text-sm font-medium text-gray-600">Student ID</label>
                <p class="text-sm sm:text-base text-gray-800">{{ $student->student_id }}</p>
            </div>
            <div class="space-y-1">
                <label class="text-xs sm:text-sm font-medium text-gray-600">Email</label>
                <p class="text-sm sm:text-base text-gray-800 break-all">{{ $student->email }}</p>
            </div>
        </div>
    </div>

    <!-- Grade Completion Deadlines -->
    @if(isset($applications) && $applications->count() > 0)
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 mb-4 sm:mb-6">
        <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Grade Completion Deadlines</h3>
        
        <!-- Deadline Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-6">
            <div class="bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4">
                <div class="flex items-center">
                    <div class="bg-red-100 rounded-full p-2 flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                    </div>
                    <div class="ml-3 min-w-0">
                        <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Overdue</h4>
                        <p class="text-lg sm:text-xl font-bold text-red-600">{{ $overdueCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 sm:p-4">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-full p-2 flex-shrink-0">
                        <i class="fas fa-clock text-yellow-600 text-sm"></i>
                    </div>
                    <div class="ml-3 min-w-0">
                        <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Approaching</h4>
                        <p class="text-lg sm:text-xl font-bold text-yellow-600">{{ $approachingDeadlineCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-3 sm:p-4">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-full p-2 flex-shrink-0">
                        <i class="fas fa-calendar-check text-green-600 text-sm"></i>
                    </div>
                    <div class="ml-3 min-w-0">
                        <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Active</h4>
                        <p class="text-lg sm:text-xl font-bold text-green-600">{{ $activeCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications List - Mobile Cards and Desktop Table -->
        <!-- Mobile View (Cards) -->
        <div class="block md:hidden space-y-4">
            @foreach($applications as $application)
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 truncate">{{ $application->subject->code }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $application->subject->description }}</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 ml-2 flex-shrink-0">
                            {{ $application->current_grade }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-gray-500">Deadline:</span>
                            <div class="mt-1">
                                <div class="font-medium {{ $application->deadline_status === 'overdue' ? 'text-red-600' : ($application->deadline_status === 'approaching' ? 'text-yellow-600' : 'text-green-600') }}">
                                    {{ $application->completion_deadline->format('M j, Y') }}
                                </div>
                                <div class="text-xs {{ $application->deadline_status === 'overdue' ? 'text-red-500' : ($application->deadline_status === 'approaching' ? 'text-yellow-500' : 'text-gray-500') }}">
                                    @if($application->deadline_status === 'overdue')
                                        {{ abs($application->getDaysUntilDeadline()) }} days overdue
                                    @else
                                        {{ $application->getDaysUntilDeadline() }} days left
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <span class="text-gray-500">Status:</span>
                            <div class="mt-1">
                                @if($application->deadline_status === 'overdue')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Overdue
                                    </span>
                                @elseif($application->deadline_status === 'approaching')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Urgent
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-calendar-check mr-1"></i>
                                        Active
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Desktop View (Table) -->
        <div class="hidden md:block">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Current Grade</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->subject->code }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->subject->description }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $application->current_grade }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-sm font-medium {{ $application->deadline_status === 'overdue' ? 'text-red-600' : ($application->deadline_status === 'approaching' ? 'text-yellow-600' : 'text-green-600') }}">
                                        {{ $application->completion_deadline->format('M j, Y') }}
                                    </span>
                                    <span class="text-xs {{ $application->deadline_status === 'overdue' ? 'text-red-500' : ($application->deadline_status === 'approaching' ? 'text-yellow-500' : 'text-gray-500') }}">
                                        @if($application->deadline_status === 'overdue')
                                            {{ abs($application->getDaysUntilDeadline()) }} days overdue
                                        @else
                                            {{ $application->getDaysUntilDeadline() }} days left
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                @if($application->deadline_status === 'overdue')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Overdue
                                    </span>
                                @elseif($application->deadline_status === 'approaching')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Urgent
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-calendar-check mr-1"></i>
                                        Active
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@else
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
        <p class="text-gray-600">No student information available.</p>
    </div>
@endisset
@endsection
