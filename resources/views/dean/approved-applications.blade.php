@extends('layouts.dean')

@section('page-title', 'Reviewed Applications')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Reviewed Applications</h1>
                <p class="text-gray-600">View all applications you have reviewed (approved and rejected)</p>
            </div>
            <div class="flex space-x-4">
                <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-2">
                    <span class="text-sm font-medium text-green-800">{{ $applications->where('dean_status', 'approved')->count() }} approved</span>
                </div>
                <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-2">
                    <span class="text-sm font-medium text-red-800">{{ $applications->where('dean_status', 'rejected')->count() }} rejected</span>
                </div>
            </div>
        </div>
    </div>

    @if($applications->count() > 0)
        @php
            $approvedApplications = $applications->where('dean_status', 'approved');
            $rejectedApplications = $applications->where('dean_status', 'rejected');
        @endphp

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- Approved Applications Section -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        Approved Applications ({{ $approvedApplications->count() }})
                    </h2>
                </div>
                @if($approvedApplications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-green-50 to-green-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-green-600 uppercase tracking-wider">
                                        <i class="fas fa-user mr-1"></i>Student
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-green-600 uppercase tracking-wider">
                                        <i class="fas fa-book mr-1"></i>Subject
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-green-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-1"></i>Date
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-green-600 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-1"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($approvedApplications as $index => $application)
                                    <tr class="hover:bg-green-50 transition-colors duration-200">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-gradient-to-r from-green-400 to-emerald-500 rounded-full w-8 h-8 flex items-center justify-center text-white font-bold text-sm">
                                                    {{ strtoupper(substr($application->student->name, 0, 1)) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ Str::limit($application->student->name, 15) }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $application->student->student_id }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $application->subject->code }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($application->subject->description, 20) }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-center text-sm text-gray-600">
                                            <div class="flex flex-col items-center">
                                                <span class="font-medium text-green-600 text-xs">{{ $application->dean_reviewed_at->format('M j') }}</span>
                                                <span class="text-xs text-gray-500">{{ $application->dean_reviewed_at->format('g:i A') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-center">
                                            <div class="flex flex-col items-center space-y-1">
                                                <button onclick="viewApprovedApplication({{ $application->id }})" 
                                                        class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors duration-200 text-xs font-medium">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    View
                                                </button>
                                                <button onclick="viewSignedDocument({{ $application->id }})" 
                                                        class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-xs font-medium">
                                                    <i class="fas fa-file-signature mr-1"></i>
                                                    Signed
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-check-circle text-2xl text-green-600"></i>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-1">No Approved Applications</h4>
                        <p class="text-xs text-gray-600">No applications have been approved yet.</p>
                    </div>
                @endif
            </div>

            <!-- Rejected Applications Section -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-times-circle mr-3"></i>
                        Rejected Applications ({{ $rejectedApplications->count() }})
                    </h2>
                </div>
                @if($rejectedApplications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-red-50 to-red-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-red-600 uppercase tracking-wider">
                                        <i class="fas fa-user mr-1"></i>Student
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-red-600 uppercase tracking-wider">
                                        <i class="fas fa-book mr-1"></i>Subject
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-red-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-1"></i>Date
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-red-600 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-1"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($rejectedApplications as $index => $application)
                                    <tr class="hover:bg-red-50 transition-colors duration-200">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-gradient-to-r from-red-400 to-red-500 rounded-full w-8 h-8 flex items-center justify-center text-white font-bold text-sm">
                                                    {{ strtoupper(substr($application->student->name, 0, 1)) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ Str::limit($application->student->name, 15) }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $application->student->student_id }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $application->subject->code }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($application->subject->description, 20) }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-center text-sm text-gray-600">
                                            <div class="flex flex-col items-center">
                                                <span class="font-medium text-red-600 text-xs">{{ $application->dean_reviewed_at->format('M j') }}</span>
                                                <span class="text-xs text-gray-500">{{ $application->dean_reviewed_at->format('g:i A') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-center">
                                            <div class="flex flex-col items-center space-y-1">
                                                <button onclick="viewRejectedApplication({{ $application->id }})" 
                                                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition-colors duration-200 text-xs font-medium">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    View
                                                </button>
                                                <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-500 rounded-lg text-xs font-medium cursor-not-allowed">
                                                    <i class="fas fa-ban mr-1"></i>
                                                    N/A
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-times-circle text-2xl text-red-600"></i>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-1">No Rejected Applications</h4>
                        <p class="text-xs text-gray-600">No applications have been rejected yet.</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-12">
            <div class="text-center">
                <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-times text-3xl text-gray-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">No Reviewed Applications</h3>
                <p class="text-gray-600 mb-6">You haven't reviewed any grade completion applications yet.</p>
                <a href="/dean/grade-completion-applications" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-clipboard-list mr-2"></i>
                    View Pending Applications
                </a>
            </div>
        </div>
    @endif
</div>

<!-- View Application Modal -->
<div id="viewApplicationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeViewApplicationModal()"></div>
        
        <div class="inline-block w-full max-w-4xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
            <div id="modalHeader" class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 id="modalTitle" class="text-xl font-bold text-white flex items-center">
                        <!-- Dynamic title will be set by JavaScript -->
                    </h3>
                    <button onclick="closeViewApplicationModal()" class="text-white hover:text-gray-200 transition-colors duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="px-6 py-6">
                <div id="applicationDetails" class="space-y-6">
                    <!-- Application details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewApprovedApplication(applicationId) {
    viewApplication(applicationId, 'approved');
}

function viewRejectedApplication(applicationId) {
    viewApplication(applicationId, 'rejected');
}

function viewApplication(applicationId, status) {
    // Set modal header based on status
    const modalHeader = document.getElementById('modalHeader');
    const modalTitle = document.getElementById('modalTitle');
    
    if (status === 'approved') {
        modalHeader.className = 'bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4';
        modalTitle.innerHTML = '<i class="fas fa-check-circle mr-3"></i>Approved Application Details';
    } else {
        modalHeader.className = 'bg-gradient-to-r from-red-500 to-red-600 px-6 py-4';
        modalTitle.innerHTML = '<i class="fas fa-times-circle mr-3"></i>Rejected Application Details';
    }
    
    // Show loading state
    document.getElementById('applicationDetails').innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-2xl text-gray-600"></i><p class="text-gray-600 mt-2">Loading application details...</p></div>';
    document.getElementById('viewApplicationModal').classList.remove('hidden');
    
    // Fetch application details
    fetch(`/dean/grade-completion-applications/${applicationId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayApplicationDetails(data.application, status);
            } else {
                showAlert('Error loading application details', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while loading application details', 'error');
        });
}

function displayApplicationDetails(application, status) {
    const statusClass = status === 'approved' ? 'green' : 'red';
    const statusIcon = status === 'approved' ? 'fa-check-circle' : 'fa-times-circle';
    const statusText = status === 'approved' ? 'Approved' : 'Rejected';
    const statusDescription = status === 'approved' ? 'This application has been approved and forwarded to faculty' : 'This application has been rejected';
    
    const detailsHtml = `
        <div class="bg-${statusClass}-50 border border-${statusClass}-200 rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas ${statusIcon} text-${statusClass}-600 text-2xl mr-3"></i>
                    <div>
                        <h4 class="font-semibold text-${statusClass}-800">Application ${statusText}</h4>
                        <p class="text-sm text-${statusClass}-700">${statusDescription}</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-${statusClass}-100 text-${statusClass}-800">
                    <i class="fas ${statusIcon} mr-1"></i>
                    ${statusText}
                </span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-user text-blue-600 mr-2"></i>Student Information
                </h4>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Name:</span>
                        <span class="text-sm font-medium text-gray-800">${application.student_name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Student ID:</span>
                        <span class="text-sm font-medium text-gray-800">${application.student_id}</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-book text-green-600 mr-2"></i>Subject Information
                </h4>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Subject Code:</span>
                        <span class="text-sm font-medium text-gray-800">${application.subject_code}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Subject Name:</span>
                        <span class="text-sm font-medium text-gray-800">${application.subject_name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Current Grade:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            ${application.current_grade}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                <i class="fas fa-edit text-yellow-600 mr-2"></i>Application Details
            </h4>
            <div class="space-y-3">
                <div>
                    <span class="text-sm font-medium text-gray-700">Submitted:</span>
                    <span class="text-sm text-gray-600 ml-2">${application.created_at}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-700">Reason for Application:</span>
                    <div class="mt-2 p-3 bg-white border border-gray-200 rounded-lg">
                        <p class="text-sm text-gray-800 whitespace-pre-wrap">${application.reason}</p>
                    </div>
                </div>
                ${status === 'rejected' && application.dean_remarks ? `
                <div>
                    <span class="text-sm font-medium text-gray-700">Rejection Reason:</span>
                    <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-800 whitespace-pre-wrap">${application.dean_remarks}</p>
                    </div>
                </div>
                ` : ''}
                ${application.supporting_document ? `
                <div>
                    <span class="text-sm font-medium text-gray-700">Supporting Document:</span>
                    <div class="mt-2 flex items-center space-x-3">
                        <a href="/dean/grade-completion-applications/${application.id}/document" target="_blank" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-sm">
                            <i class="fas fa-file mr-2"></i>
                            View Document
                        </a>
                        <span class="text-xs text-gray-500">
                            ${application.supporting_document.split('/').pop()}
                        </span>
                    </div>
                </div>
                ` : '<div class="text-sm text-gray-500 flex items-center"><i class="fas fa-info-circle mr-2"></i>No supporting document submitted</div>'}
            </div>
        </div>
    `;
    
    document.getElementById('applicationDetails').innerHTML = detailsHtml;
}

function viewSignedDocument(applicationId) {
    window.open(`/dean/grade-completion-applications/${applicationId}/signed-document`, '_blank');
}

function closeViewApplicationModal() {
    document.getElementById('viewApplicationModal').classList.add('hidden');
}

function showAlert(message, type) {
    const alert = document.createElement('div');
    alert.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    alert.innerHTML = `
        <div class="flex items-center space-x-2">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

// Countdown Timer Functions
function updateCountdownTimers() {
    const timers = document.querySelectorAll('[data-deadline]');
    const now = new Date().getTime();
    
    timers.forEach(timer => {
        const deadline = parseInt(timer.getAttribute('data-deadline'));
        const timeLeft = deadline - now;
        
        if (timeLeft > 0) {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            let timeString = '';
            let colorClass = '';
            
            if (days > 0) {
                timeString = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                if (days <= 1) {
                    colorClass = 'text-orange-600 font-bold';
                } else if (days <= 7) {
                    colorClass = 'text-yellow-600 font-semibold';
                } else if (days <= 30) {
                    colorClass = 'text-blue-600';
                } else {
                    colorClass = 'text-green-600';
                }
            } else if (hours > 0) {
                timeString = `${hours}h ${minutes}m ${seconds}s`;
                colorClass = 'text-orange-600 font-bold animate-pulse';
            } else if (minutes > 0) {
                timeString = `${minutes}m ${seconds}s`;
                colorClass = 'text-red-600 font-bold animate-pulse';
            } else {
                timeString = `${seconds}s`;
                colorClass = 'text-red-600 font-bold animate-pulse';
            }
            
            const timerElement = timer.querySelector('.countdown-timer');
            if (timerElement) {
                timerElement.textContent = timeString;
                timerElement.className = `countdown-timer ${colorClass}`;
            }
        } else {
            // Time's up!
            const timerElement = timer.querySelector('.countdown-timer');
            if (timerElement) {
                timerElement.textContent = 'EXPIRED';
                timerElement.className = 'countdown-timer text-red-600 font-bold animate-pulse';
            }
        }
    });
}

// Start the countdown timers
document.addEventListener('DOMContentLoaded', function() {
    updateCountdownTimers();
    // Update every second
    setInterval(updateCountdownTimers, 1000);
});
</script>

<style>
/* Countdown Timer Styling */
.countdown-timer {
    display: inline-block;
    padding: 2px 6px;
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 4px;
    font-family: 'Courier New', 'Monaco', monospace;
    font-size: 11px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.countdown-timer.animate-pulse {
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Urgency-based styling */
.countdown-timer.text-red-600 {
    background-color: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.countdown-timer.text-orange-600 {
    background-color: rgba(234, 88, 12, 0.1);
    border: 1px solid rgba(234, 88, 12, 0.3);
}

.countdown-timer.text-yellow-600 {
    background-color: rgba(202, 138, 4, 0.1);
    border: 1px solid rgba(202, 138, 4, 0.3);
}
</style>
@endsection
