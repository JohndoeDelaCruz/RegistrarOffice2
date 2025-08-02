@extends('layouts.student')

@section('page-title', 'Student Dashboard')

@section('content')
@isset($student)
    <!-- Welcome Card -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-xl font-semibold text-uc-green mb-2">Welcome, {{ $student->name }}!</h2>
        <p class="text-gray-600 mb-2">{{ $student->course }} - {{ $student->track }}</p>
        <p class="text-sm text-gray-500">Student ID: {{ $student->student_id }}</p>
    </div>

    <!-- Track Information -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Track Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="text-sm font-medium text-gray-600">Course</label>
                <p class="text-gray-800 font-medium">{{ $student->course }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="text-sm font-medium text-gray-600">Specialization Track</label>
                <p class="text-gray-800 font-medium">{{ $student->track }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="text-sm font-medium text-gray-600">Student ID</label>
                <p class="text-gray-800 font-medium">{{ $student->student_id }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="text-sm font-medium text-gray-600">Email</label>
                <p class="text-gray-800 font-medium">{{ $student->email }}</p>
            </div>
        </div>
    </div>

    <!-- Grade Completion Deadlines -->
    @if(isset($applications) && $applications->count() > 0)
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Grade Completion Deadlines</h3>
        
        <!-- Deadline Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-red-100 rounded-full p-2">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-semibold text-gray-800">Overdue</h4>
                        <p class="text-xl font-bold text-red-600">{{ $overdueCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-full p-2">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-semibold text-gray-800">Approaching</h4>
                        <p class="text-xl font-bold text-yellow-600">{{ $approachingDeadlineCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-full p-2">
                        <i class="fas fa-calendar-check text-green-600"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-semibold text-gray-800">Active</h4>
                        <p class="text-xl font-bold text-green-600">{{ $activeCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications List -->
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
                                    {{ $application->completion_deadline->format('M j, Y g:i A') }}
                                </span>
                                <div class="mt-1">
                                    @if($application->deadline_status === 'overdue')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>
                                            {{ abs($application->getDaysUntilDeadline()) }} days overdue
                                        </span>
                                    @else
                                        <div class="countdown-timer inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            {{ $application->deadline_status === 'approaching' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}"
                                             data-deadline="{{ $application->completion_deadline->toISOString() }}">
                                            <i class="fas fa-clock mr-1"></i>
                                            <span class="countdown-text">{{ $application->getDaysUntilDeadline() }} days left</span>
                                        </div>
                                    @endif
                                </div>
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
    @endif
@else
    <div class="bg-white rounded-lg shadow-sm p-6">
        <p class="text-gray-600">No student information available.</p>
    </div>
@endisset

@push('styles')
<style>
    .countdown-timer {
        transition: all 0.3s ease;
    }
    
    .countdown-urgent {
        animation: urgentPulse 2s infinite;
    }
    
    .countdown-critical {
        animation: criticalBlink 1s infinite;
    }
    
    @keyframes urgentPulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 0 6px rgba(245, 158, 11, 0);
        }
    }
    
    @keyframes criticalBlink {
        0%, 100% {
            background-color: rgb(254, 226, 226);
            color: rgb(153, 27, 27);
        }
        50% {
            background-color: rgb(239, 68, 68);
            color: white;
        }
    }
</style>
@endpush

@push('scripts')
<script>
// Countdown Timer Function
function updateCountdowns() {
    const countdownElements = document.querySelectorAll('.countdown-timer');
    
    countdownElements.forEach(element => {
        const deadlineStr = element.getAttribute('data-deadline');
        if (!deadlineStr) return;
        
        const deadline = new Date(deadlineStr);
        const now = new Date();
        const timeDiff = deadline.getTime() - now.getTime();
        
        const countdownTextElement = element.querySelector('.countdown-text');
        if (!countdownTextElement) return;
        
        if (timeDiff <= 0) {
            // Overdue - replace with overdue indicator
            element.innerHTML = `
                <i class="fas fa-exclamation-triangle mr-1"></i>
                OVERDUE
            `;
            element.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800';
            return;
        }
        
        // Calculate days, hours, minutes (ensure integers)
        const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        
        // Format countdown display (ensure no decimals)
        let countdownText = '';
        
        if (days > 0) {
            countdownText = `${Math.floor(days)}d ${Math.floor(hours)}h ${Math.floor(minutes)}m`;
        } else if (hours > 0) {
            countdownText = `${Math.floor(hours)}h ${Math.floor(minutes)}m`;
        } else {
            countdownText = `${Math.floor(minutes)}m`;
        }
        
        // Update styling based on urgency
        let baseClasses = 'countdown-timer inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ';
        
        // Remove existing animation classes
        element.classList.remove('countdown-urgent', 'countdown-critical');
        
        if (days === 0 && hours <= 2) {
            // Critical: less than 2 hours
            element.className = baseClasses + 'bg-red-100 text-red-800 countdown-critical';
        } else if (days === 0 && hours <= 6) {
            // Very urgent: less than 6 hours
            element.className = baseClasses + 'bg-red-100 text-red-800 countdown-urgent';
        } else if (days === 0) {
            // Urgent: less than 1 day
            element.className = baseClasses + 'bg-yellow-100 text-yellow-800 countdown-urgent';
        } else if (days <= 3) {
            // Approaching: 1-3 days
            element.className = baseClasses + 'bg-yellow-100 text-yellow-800';
        } else {
            // Normal: more than 3 days
            element.className = baseClasses + 'bg-green-100 text-green-800';
        }
        
        countdownTextElement.textContent = countdownText;
    });
}

// Update countdowns immediately and then every minute
document.addEventListener('DOMContentLoaded', function() {
    updateCountdowns();
    
    // Update every minute
    setInterval(updateCountdowns, 60000);
    
    // Update every 10 seconds for urgent deadlines (less than 1 day)
    setInterval(() => {
        const urgentElements = document.querySelectorAll('.countdown-urgent, .countdown-critical');
        if (urgentElements.length > 0) {
            updateCountdowns();
        }
    }, 10000);
});

// Update when page becomes visible (for browser tab switching)
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        updateCountdowns();
    }
});
</script>
@endpush

@endsection
