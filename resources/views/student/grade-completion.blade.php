@extends('layouts.student')

@section('page-title', 'Grade Completion')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Header Section -->
    <div class="border-b border-gray-200 pb-4 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Grade Completion Applications</h1>
                <p class="text-gray-600">Apply for completion of INC and NFE grades</p>
                <p class="text-sm text    });
}

function showRejectionReason(reason) {
    document.getElementById('rejectionReasonText').textContent = reason;
    document.getElementById('rejectionReasonModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeRejectionModal() {
    document.getElementById('rejectionReasonModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('completionModal');
    const modalContent = modal.querySelector('.bg-white');
    
    if (event.target === modal && !modalContent.contains(event.target)) {
        closeCompletionModal();
    }
    
    const rejectionModal = document.getElementById('rejectionReasonModal');
    const rejectionModalContent = rejectionModal.querySelector('.bg-white');
    
    if (event.target === rejectionModal && !rejectionModalContent.contains(event.target)) {
        closeRejectionModal();
    }
});tudent ID: {{ $student->student_id }} | {{ $student->name }}</p>
            </div>
        </div>
    </div>

    @if($incompleteSubjects->count() > 0)
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                    Subjects Requiring Completion
                </h2>
                <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-2">
                    <span class="text-sm font-medium text-blue-800">{{ $incompleteSubjects->count() }} subject(s) pending</span>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-code mr-2"></i>Subject Code
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-book mr-2"></i>Subject Description
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-weight mr-2"></i>Units
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-grade mr-2"></i>Current Grade
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-2"></i>Status
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-cog mr-2"></i>Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($incompleteSubjects as $index => $subject)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 {{ $index % 2 == 1 ? 'bg-gray-25' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-book-open text-blue-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $subject->code }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 leading-relaxed">{{ $subject->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $subject->units }} units
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800 border border-red-200">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>
                                            {{ $subject->grades->first()->grade }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if(in_array($subject->id, $existingApplications))
                                            @php
                                                $application = $applicationStatus[$subject->id] ?? null;
                                            @endphp
                                            @if($application)
                                                @if($application->dean_status == 'pending')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        Pending Dean Review
                                                    </span>
                                                @elseif($application->dean_status == 'approved')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                                        <i class="fas fa-check mr-1"></i>
                                                        Approved by Dean
                                                    </span>
                                                @elseif($application->dean_status == 'rejected')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                                        <i class="fas fa-times mr-1"></i>
                                                        Rejected by Dean
                                                    </span>
                                                @endif
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Applied
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                Not Applied
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if(!in_array($subject->id, $existingApplications))
                                            <button 
                                                onclick="openCompletionModal({{ $subject->id }}, '{{ $subject->code }}', '{{ $subject->description }}', '{{ $subject->grades->first()->grade }}')"
                                                class="inline-flex items-center px-4 py-2 bg-gray-100 text-black rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105 border-2 border-black"
                                                title="Apply for Completion"
                                            >
                                                <i class="fas fa-paper-plane mr-2"></i>
                                                Apply for Completion
                                            </button>
                                        @else
                                            @php
                                                $application = $applicationStatus[$subject->id] ?? null;
                                            @endphp
                                            @if($application && $application->dean_status == 'rejected')
                                                <div class="space-y-2">
                                                    <div class="flex items-center justify-center space-x-2 text-red-500">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span class="text-sm font-medium">Application Rejected</span>
                                                    </div>
                                                    @if($application->dean_remarks)
                                                        <button 
                                                            onclick="showRejectionReason('{{ addslashes($application->dean_remarks) }}')"
                                                            class="text-sm text-blue-600 hover:text-blue-800 underline"
                                                        >
                                                            View Reason
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="flex items-center justify-center space-x-2 text-gray-500">
                                                    <i class="fas fa-check-circle text-green-500"></i>
                                                    <span class="text-sm font-medium">Already Applied</span>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="bg-gradient-to-r from-green-100 to-blue-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-green-600 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Great Job!</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    You don't have any subjects with INC or NFE grades that require completion. 
                    Keep up the excellent work!
                </p>
                <div class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fas fa-info-circle text-blue-600"></i>
                        <span class="text-sm font-medium text-gray-700">
                            If you receive any INC or NFE grades in the future, you can return here to apply for completion.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Grade Completion Application Modal -->
<div id="completionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6 relative">
                <button onclick="closeCompletionModal()" class="absolute top-4 right-4 text-white hover:text-gray-200 transition-colors duration-200 p-2 rounded-full hover:bg-white hover:bg-opacity-20 z-10">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div class="pr-12">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-file-alt text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-black drop-shadow-sm">Grade Completion Application</h3>
                            <p class="text-black text-sm mt-1 drop-shadow-sm">Submit your application for grade completion</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Body with Custom Scrollbar -->
            <div class="p-6 space-y-6 overflow-y-auto max-h-[70vh] modal-body-scroll">
                <!-- Subject Information Card -->
            <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="bg-red-100 rounded-full p-2">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800">Subject Details</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Subject Code</p>
                        <p class="text-lg font-bold text-gray-800" id="modalSubjectCode"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Current Grade</p>
                        <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium" id="modalCurrentGrade"></span>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="text-sm font-medium text-gray-600">Subject Description</p>
                    <p class="text-gray-800" id="modalSubjectDescription"></p>
                </div>
            </div>
            
            <!-- Application Form -->
            <form id="completionForm" class="space-y-6">
                <!-- Reason Section -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center space-x-2 mb-3">
                        <i class="fas fa-edit text-blue-600"></i>
                        <label class="text-lg font-semibold text-gray-800">Reason for Application</label>
                        <span class="text-red-500">*</span>
                    </div>
                    <textarea id="reasonText" rows="6" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                              placeholder="Please provide a detailed explanation for your grade completion application. Include any relevant circumstances, challenges faced, or reasons why you believe you deserve a chance to complete this subject..."></textarea>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-xs text-gray-500">Minimum 20 characters required</p>
                        <p class="text-xs text-gray-500"><span id="charCount">0</span>/500 characters</p>
                    </div>
                </div>
                
                <!-- Supporting Documents Section -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center space-x-2 mb-3">
                        <i class="fas fa-paperclip text-green-600"></i>
                        <label class="text-lg font-semibold text-gray-800">Supporting Documents</label>
                        <span class="text-gray-500 text-sm">(Optional)</span>
                    </div>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200">
                        <input type="file" id="supportingDocs" class="hidden" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" onchange="updateFileDisplay()">
                        <label for="supportingDocs" class="cursor-pointer">
                            <div class="space-y-2">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                <p class="text-gray-600">Click to upload supporting documents</p>
                                <p class="text-xs text-gray-500">PDF, DOC, DOCX, JPG, PNG (Max 5MB)</p>
                            </div>
                        </label>
                        <div id="fileDisplay" class="mt-3 hidden">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file text-blue-600"></i>
                                    <span id="fileName" class="text-sm font-medium text-gray-800"></span>
                                    <button type="button" onclick="removeFile()" class="text-red-500 hover:text-red-700 text-xs">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-xl">
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeCompletionModal()" 
                            class="px-6 py-3 btn-secondary rounded-lg hover:bg-gray-600 transition-colors duration-200 font-semibold border border-gray-500">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                    <button type="button" onclick="submitCompletionApplication()" 
                            class="px-6 py-3 btn-primary rounded-lg hover:bg-blue-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl border border-blue-700">
                        <i class="fas fa-paper-plane mr-2"></i>Submit Application
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Reason Modal -->
<div id="rejectionReasonModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-xl shadow-2xl max-w-lg w-full">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white p-6 relative">
                <button onclick="closeRejectionModal()" class="absolute top-4 right-4 text-white hover:text-gray-200 transition-colors duration-200 p-2 rounded-full hover:bg-white hover:bg-opacity-20">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div class="pr-12">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-exclamation-triangle text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white drop-shadow-sm">Application Rejected</h3>
                            <p class="text-red-100 text-sm mt-1 drop-shadow-sm">Reason from Dean</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <h4 class="font-semibold text-red-800 mb-3 flex items-center">
                        <i class="fas fa-comment text-red-600 mr-2"></i>
                        Dean's Remarks
                    </h4>
                    <p id="rejectionReasonText" class="text-red-700 leading-relaxed"></p>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button onclick="closeRejectionModal()" 
                            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                        <i class="fas fa-times mr-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<style>
/* Hide scrollbar for modal body */
.modal-body-scroll {
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE and Edge */
}

.modal-body-scroll::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

/* Ensure text visibility */
.modal-header-text {
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    color: #ffffff !important;
}

/* Button text visibility */
.btn-primary {
    background-color: #f3f4f6 !important;
    color: #000000 !important;
    font-weight: 600 !important;
    border: 2px solid #000000 !important;
}

.btn-secondary {
    background-color: #f3f4f6 !important;
    color: #000000 !important;
    font-weight: 600 !important;
    border: 2px solid #000000 !important;
}
</style>

<script>
let currentSubjectId = null;

function openCompletionModal(subjectId, subjectCode, subjectDescription, currentGrade) {
    currentSubjectId = subjectId;
    
    document.getElementById('modalSubjectCode').textContent = subjectCode;
    document.getElementById('modalSubjectDescription').textContent = subjectDescription;
    document.getElementById('modalCurrentGrade').textContent = currentGrade;
    document.getElementById('completionModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden'); // Prevent background scroll
    
    // Reset form
    document.getElementById('reasonText').value = '';
    document.getElementById('supportingDocs').value = '';
    updateCharCount();
    removeFile();
}

function closeCompletionModal() {
    document.getElementById('completionModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    currentSubjectId = null;
}

function updateCharCount() {
    const reasonText = document.getElementById('reasonText');
    const charCount = document.getElementById('charCount');
    charCount.textContent = reasonText.value.length;
    
    // Update color based on character count
    if (reasonText.value.length < 20) {
        charCount.className = 'text-red-500';
    } else if (reasonText.value.length > 450) {
        charCount.className = 'text-yellow-500';
    } else {
        charCount.className = 'text-green-500';
    }
}

function updateFileDisplay() {
    const fileInput = document.getElementById('supportingDocs');
    const fileDisplay = document.getElementById('fileDisplay');
    const fileName = document.getElementById('fileName');
    
    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
        fileDisplay.classList.remove('hidden');
    } else {
        fileDisplay.classList.add('hidden');
    }
}

function removeFile() {
    document.getElementById('supportingDocs').value = '';
    document.getElementById('fileDisplay').classList.add('hidden');
}

// Add event listener for character count
document.addEventListener('DOMContentLoaded', function() {
    const reasonText = document.getElementById('reasonText');
    if (reasonText) {
        reasonText.addEventListener('input', updateCharCount);
    }
});

function submitCompletionApplication() {
    const reason = document.getElementById('reasonText').value.trim();
    
    if (!reason) {
        showAlert('Please provide a reason for your application', 'error');
        return;
    }
    
    if (reason.length < 20) {
        showAlert('Please provide a more detailed reason (at least 20 characters)', 'error');
        return;
    }
    
    // Show loading state
    const submitButton = document.querySelector('[onclick="submitCompletionApplication()"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
    submitButton.disabled = true;
    
    // Create FormData for file upload support
    const formData = new FormData();
    formData.append('subject_id', currentSubjectId);
    formData.append('reason', reason);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    const fileInput = document.getElementById('supportingDocs');
    if (fileInput.files.length > 0) {
        formData.append('supporting_document', fileInput.files[0]);
    }
    
    // Submit the application
    fetch('/student/grade-completion/apply', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Your grade completion application has been submitted successfully!', 'success');
            closeCompletionModal();
            // Reload the page to show updated status
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert('Error: ' + (data.message || 'Failed to submit application'), 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred while submitting your application. Please try again.', 'error');
    })
    .finally(() => {
        // Reset button state
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
    });
}

function showAlert(message, type) {
    // Create alert element
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
    
    // Remove alert after 5 seconds
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('completionModal');
    const modalContent = modal.querySelector('.bg-white');
    
    if (event.target === modal && !modalContent.contains(event.target)) {
        closeCompletionModal();
    }
});
</script>
@endsection
