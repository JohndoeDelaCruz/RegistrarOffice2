@extends('layouts.dean')

@section('page-title', 'Grade Completion Applications')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Grade Completion Hub</h1>
                <p class="text-gray-600">Review and approve or reject student applications for grade completion</p>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-2">
                <span class="text-sm font-medium text-green-800">{{ $applications->count() }} pending application(s)</span>
            </div>
        </div>
    </div>

    @if($applications->count() > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-green-50 to-green-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-user mr-2"></i>Student
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-book mr-2"></i>Subject
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-grade mr-2"></i>Current Grade
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-file mr-2"></i>Document
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-calendar mr-2"></i>Submitted
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-info-circle mr-2"></i>Status
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-cog mr-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $index => $application)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 {{ $index % 2 == 1 ? 'bg-gray-25' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $application->student->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $application->student->student_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $application->subject->code }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->subject->description }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800 border border-red-200">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        {{ $application->current_grade }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($application->supporting_document)
                                        <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-medium">
                                            <i class="fas fa-file mr-1"></i>
                                            Available
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">
                                            <i class="fas fa-minus mr-1"></i>
                                            None
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-sm text-gray-900">{{ $application->created_at->format('M j, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->created_at->format('g:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <i class="fas fa-clock mr-1"></i>
                                        Pending Review
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button 
                                            onclick="viewApplication({{ $application->id }})"
                                            class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-sm font-medium"
                                            title="View Details"
                                        >
                                            <i class="fas fa-eye mr-1"></i>
                                            View
                                        </button>
                                        <button 
                                            onclick="reviewApplication({{ $application->id }}, 'approve')"
                                            class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors duration-200 text-sm font-medium"
                                            title="Approve Application"
                                        >
                                            <i class="fas fa-check mr-1"></i>
                                            Approve
                                        </button>
                                        <button 
                                            onclick="reviewApplication({{ $application->id }}, 'reject')"
                                            class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition-colors duration-200 text-sm font-medium"
                                            title="Reject Application"
                                        >
                                            <i class="fas fa-times mr-1"></i>
                                            Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-12">
            <div class="text-center">
                <div class="max-w-md mx-auto">
                    <div class="bg-gradient-to-r from-green-100 to-green-200 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-inbox text-uc-green text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">No Pending Applications</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        There are currently no grade completion applications pending your review.
                    </p>
                    <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-info-circle text-uc-green"></i>
                            <span class="text-sm font-medium text-gray-700">
                                New applications will appear here when students submit them.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Application Details Modal -->
<div id="applicationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-uc-green to-uc-green-dark text-white p-6">
                <button onclick="closeApplicationModal()" class="absolute top-4 right-4 text-white hover:text-gray-200 transition-colors duration-200 p-2 rounded-full hover:bg-white hover:bg-opacity-20">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div class="pr-12">
                    <h3 class="text-2xl font-bold">Application Details</h3>
                    <p class="text-green-100 text-sm mt-1">Review grade completion application</p>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6 space-y-6 overflow-y-auto max-h-[70vh]">
                <div id="applicationDetails">
                    <!-- Application details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-uc-green to-uc-green-dark text-white p-6">
                <button onclick="closeReviewModal()" class="absolute top-4 right-4 text-white hover:text-gray-200 transition-colors duration-200 p-2 rounded-full hover:bg-white hover:bg-opacity-20">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div class="pr-12">
                    <h3 class="text-2xl font-bold" id="reviewModalTitle">Review Application</h3>
                    <p class="text-green-100 text-sm mt-1">Make your decision on this application</p>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form id="reviewForm">
                    <div class="space-y-4">
                        <div id="reviewApplicationSummary">
                            <!-- Application summary will be loaded here -->
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-comment mr-2"></i>
                                Dean Remarks <span class="text-gray-500">(Optional)</span>
                            </label>
                            <textarea 
                                id="deanRemarks" 
                                rows="4" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uc-green focus:border-transparent"
                                placeholder="Add your remarks or reasons for your decision..."
                            ></textarea>
                        </div>
                        
                        <!-- Digital Signature Upload Section (shown only for approvals) -->
                        <div id="approvalMessageSection" class="bg-green-50 border border-green-200 rounded-lg p-4 hidden">
                            <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                Approval Confirmation
                            </h4>
                            <p class="text-sm text-gray-700 mb-2">
                                By approving this application, you confirm that:
                            </p>
                            <ul class="text-sm text-gray-700 list-disc list-inside space-y-1">
                                <li>The student's request meets the academic requirements</li>
                                <li>The supporting documentation is adequate</li>
                                <li>A completion deadline of 3 months will be set</li>
                                <li>The application will be forwarded to the appropriate faculty</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-4 mt-6">
                        <button type="button" onclick="closeReviewModal()" 
                                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                            Cancel
                        </button>
                        <button id="reviewSubmitButton" type="button" onclick="submitReview()" 
                                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium">
                            <i id="reviewSubmitIcon" class="fas fa-check mr-2"></i>
                            <span id="reviewSubmitLabel">Approve</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentApplicationId = null;
let currentReviewAction = null;

function viewApplication(applicationId) {
    currentApplicationId = applicationId;
    
    // Show loading state
    document.getElementById('applicationDetails').innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-2xl text-uc-green"></i><p class="text-gray-600 mt-2">Loading application details...</p></div>';
    document.getElementById('applicationModal').classList.remove('hidden');
    
    // Fetch application details
    fetch(`/dean/grade-completion-applications/${applicationId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayApplicationDetails(data.application);
            } else {
                showAlert('Error loading application details', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while loading application details', 'error');
        });
}

function displayApplicationDetails(application) {
    const detailsHtml = `
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
                ${application.supporting_document ? `
                <div>
                    <span class="text-sm font-medium text-gray-700">Supporting Document:</span>
                    <div class="mt-2 flex items-center space-x-3">
                        <a href="/dean/grade-completion-applications/${application.id}/document" target="_blank" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-sm">
                            <i class="fas fa-file mr-2"></i>
                            View Document
                        </a>
                        <a href="/dean/grade-completion-applications/${application.id}/document?download=1" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors duration-200 text-sm">
                            <i class="fas fa-download mr-2"></i>
                            Download
                        </a>
                        <span class="text-xs text-gray-500">
                            ${application.supporting_document.split('/').pop()}
                        </span>
                    </div>
                </div>
                ` : '<div class="text-sm text-gray-500 flex items-center"><i class="fas fa-info-circle mr-2"></i>No supporting document submitted</div>'}
            </div>
        </div>
        
        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <button onclick="reviewApplication(${application.id}, 'reject')" 
                    class="px-6 py-3 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition-colors duration-200 font-medium">
                <i class="fas fa-times mr-2"></i>
                Reject Application
            </button>
            <button onclick="reviewApplication(${application.id}, 'approve')" 
                    class="px-6 py-3 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors duration-200 font-medium">
                <i class="fas fa-check mr-2"></i>
                Approve Application
            </button>
        </div>
    `;
    
    document.getElementById('applicationDetails').innerHTML = detailsHtml;
}

function reviewApplication(applicationId, action) {
    console.log('reviewApplication called:', applicationId, action);
    console.log('DOM elements available:', {
        approvalMessageSection: !!document.getElementById('approvalMessageSection'),
        reviewModal: !!document.getElementById('reviewModal'),
        submitButton: !!document.getElementById('reviewSubmitButton')
    });
    
    currentApplicationId = applicationId;
    currentReviewAction = action;
    
    // Close application modal if it's open (but don't reset currentApplicationId)
    const applicationModal = document.getElementById('applicationModal');
    if (applicationModal) {
        applicationModal.classList.add('hidden');
    }
    
    // Set modal title and summary
    const titleText = action === 'approve' ? 'Approve Application' : 'Reject Application';
    const actionText = action === 'approve' ? 'approve' : 'reject';
    
    const reviewModalTitle = document.getElementById('reviewModalTitle');
    const reviewApplicationSummary = document.getElementById('reviewApplicationSummary');
    
    if (reviewModalTitle) {
        reviewModalTitle.textContent = titleText;
    }
    
    if (reviewApplicationSummary) {
        reviewApplicationSummary.innerHTML = `
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <p class="text-sm text-gray-700">
                    You are about to <strong class="${action === 'approve' ? 'text-green-600' : 'text-red-600'}">${actionText}</strong> this grade completion application.
                    ${action === 'approve' ? 'The application will be forwarded to the faculty for further processing.' : 'The student will be notified of the rejection and your remarks.'}
                </p>
            </div>
        `;
    }
    
    // Reset form
    const deanRemarks = document.getElementById('deanRemarks');
    if (deanRemarks) {
        deanRemarks.value = '';
    }
    
    // Show/hide approval message section based on action
    const approvalMessageSection = document.getElementById('approvalMessageSection');
    if (approvalMessageSection) {
        if (action === 'approve') {
            approvalMessageSection.classList.remove('hidden');
        } else {
            approvalMessageSection.classList.add('hidden');
        }
    }
    
    // Show review modal
    const reviewModal = document.getElementById('reviewModal');
    if (reviewModal) {
        reviewModal.classList.remove('hidden');
    }
    
    // Update submit button label, icon, and color
    const submitButton = document.getElementById('reviewSubmitButton');
    const submitIcon = document.getElementById('reviewSubmitIcon');
    const submitLabel = document.getElementById('reviewSubmitLabel');
    
    if (submitButton && submitIcon && submitLabel) {
        if (action === 'approve') {
            submitButton.className = 'px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium';
            submitIcon.className = 'fas fa-check mr-2';
            submitLabel.textContent = 'Approve';
        } else {
            submitButton.className = 'px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium';
            submitIcon.className = 'fas fa-times mr-2';
            submitLabel.textContent = 'Reject';
        }
    }
}

function submitReview() {
    const remarks = document.getElementById('deanRemarks').value.trim();
    
    if (currentReviewAction === 'reject' && !remarks) {
        showAlert('Please provide remarks for rejection', 'error');
        return;
    }
    
    // Show loading state
    const submitButton = document.querySelector('[onclick="submitReview()"]');
    if (!submitButton) {
        showAlert('Submit button not found', 'error');
        return;
    }
    
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
    submitButton.disabled = true;
    
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        showAlert('CSRF token not found', 'error');
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        return;
    }
    
    // Create FormData for the request
    const formData = new FormData();
    formData.append('action', currentReviewAction);
    formData.append('dean_remarks', remarks);
    formData.append('_token', csrfToken.getAttribute('content'));
    
    // Submit review
    fetch(`/dean/grade-completion-applications/${currentApplicationId}/review`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            closeReviewModal();
            
            // If there's a redirect URL (for approvals), redirect after a short delay
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                // Otherwise just reload the page
                setTimeout(() => location.reload(), 1500);
            }
        } else {
            showAlert('Error: ' + (data.message || 'Failed to submit review'), 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred while submitting your review: ' + error.message, 'error');
    })
    .finally(() => {
        // Reset button state
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
    });
}

function closeApplicationModal() {
    document.getElementById('applicationModal').classList.add('hidden');
    currentApplicationId = null;
}

function closeReviewModal() {
    document.getElementById('reviewModal').classList.add('hidden');
    
    currentApplicationId = null;
    currentReviewAction = null;
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

document.addEventListener('DOMContentLoaded', function() {
    // Any initialization code that needs to run after DOM is loaded
});
</script>
@endsection
