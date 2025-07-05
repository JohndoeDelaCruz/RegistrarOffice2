@extends('layouts.dean')

@section('page-title', 'Approved Applications')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Approved Applications</h1>
                <p class="text-gray-600">View all applications you have approved with your digital signature</p>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-2">
                <span class="text-sm font-medium text-green-800">{{ $applications->count() }} approved application(s)</span>
            </div>
        </div>
    </div>

    @if($applications->count() > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
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
                                <i class="fas fa-calendar mr-2"></i>Approved Date
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-signature mr-2"></i>Signature
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-file mr-2"></i>Document
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-info-circle mr-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $index => $application)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-gradient-to-r from-green-400 to-emerald-500 rounded-full w-10 h-10 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($application->student->first_name, 0, 1)) }}{{ strtoupper(substr($application->student->last_name, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $application->student->first_name }} {{ $application->student->last_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: {{ $application->student->student_id }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $application->subject->code }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->subject->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        {{ $application->current_grade }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                                    <div class="flex flex-col items-center">
                                        <span class="font-medium">{{ $application->dean_reviewed_at->format('M j, Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $application->dean_reviewed_at->format('g:i A') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex flex-col items-center space-y-1">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            {{ ucfirst($application->dean_signature_type) }}
                                        </span>
                                        <button onclick="viewSignature({{ $application->id }})" 
                                                class="text-xs text-blue-600 hover:text-blue-800 underline">
                                            View Signature
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($application->supporting_document)
                                        <div class="flex flex-col items-center space-y-1">
                                            <a href="/dean/grade-completion-applications/{{ $application->id }}/document" 
                                               target="_blank" 
                                               class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-xs">
                                                <i class="fas fa-file mr-1"></i>
                                                View
                                            </a>
                                            <span class="text-xs text-gray-500">
                                                {{ pathinfo($application->supporting_document, PATHINFO_EXTENSION) }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">No document</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex flex-col items-center space-y-1">
                                        <button onclick="viewApprovedApplication({{ $application->id }})" 
                                                class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors duration-200 text-xs font-medium">
                                            <i class="fas fa-eye mr-1"></i>
                                            View Details
                                        </button>
                                        <button onclick="viewSignedDocument({{ $application->id }})" 
                                                class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition-colors duration-200 text-xs font-medium">
                                            <i class="fas fa-file-signature mr-1"></i>
                                            Signed Document
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
                <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-3xl text-green-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">No Approved Applications</h3>
                <p class="text-gray-600 mb-6">You haven't approved any grade completion applications yet.</p>
                <a href="/dean/grade-completion-applications" 
                   class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-clipboard-list mr-2"></i>
                    View Pending Applications
                </a>
            </div>
        </div>
    @endif
</div>

<!-- View Approved Application Modal -->
<div id="viewApprovedModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeViewApprovedModal()"></div>
        
        <div class="inline-block w-full max-w-4xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        Approved Application Details
                    </h3>
                    <button onclick="closeViewApprovedModal()" class="text-white hover:text-gray-200 transition-colors duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="px-6 py-6">
                <div id="approvedApplicationDetails" class="space-y-6">
                    <!-- Application details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Signature Modal -->
<div id="viewSignatureModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeViewSignatureModal()"></div>
        
        <div class="inline-block w-full max-w-md my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-signature mr-3"></i>
                        Digital Signature
                    </h3>
                    <button onclick="closeViewSignatureModal()" class="text-white hover:text-gray-200 transition-colors duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="px-6 py-6">
                <div id="signatureDetails" class="space-y-4">
                    <!-- Signature details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewApprovedApplication(applicationId) {
    // Show loading state
    document.getElementById('approvedApplicationDetails').innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-2xl text-green-600"></i><p class="text-gray-600 mt-2">Loading application details...</p></div>';
    document.getElementById('viewApprovedModal').classList.remove('hidden');
    
    // Fetch application details
    fetch(`/dean/grade-completion-applications/${applicationId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayApprovedApplicationDetails(data.application);
            } else {
                showAlert('Error loading application details', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while loading application details', 'error');
        });
}

function displayApprovedApplicationDetails(application) {
    const detailsHtml = `
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-2xl mr-3"></i>
                    <div>
                        <h4 class="font-semibold text-green-800">Application Approved</h4>
                        <p class="text-sm text-green-700">This application has been approved and forwarded to faculty</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-thumbs-up mr-1"></i>
                    Approved
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
            
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-book text-purple-600 mr-2"></i>Subject Information
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
                        <span class="text-xs text-gray-500">
                            ${application.supporting_document.split('/').pop()}
                        </span>
                    </div>
                </div>
                ` : '<div class="text-sm text-gray-500 flex items-center"><i class="fas fa-info-circle mr-2"></i>No supporting document submitted</div>'}
            </div>
        </div>
    `;
    
    document.getElementById('approvedApplicationDetails').innerHTML = detailsHtml;
}

function viewSignature(applicationId) {
    // Show loading state
    document.getElementById('signatureDetails').innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-2xl text-blue-600"></i><p class="text-gray-600 mt-2">Loading signature...</p></div>';
    document.getElementById('viewSignatureModal').classList.remove('hidden');
    
    // Fetch signature details
    fetch(`/dean/grade-completion-applications/${applicationId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displaySignatureDetails(data.application);
            } else {
                showAlert('Error loading signature details', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while loading signature details', 'error');
        });
}

function displaySignatureDetails(application) {
    let signatureContent = '';
    
    if (application.dean_signature_type === 'uploaded_file') {
        signatureContent = `
            <div class="signature-display min-h-[120px] bg-white border-2 border-blue-300 rounded-lg p-6 flex items-center justify-center">
                <div class="text-center">
                    <img src="/dean/grade-completion-applications/${application.id}/signature" 
                         alt="Dean's Digital Signature" 
                         class="max-h-24 max-w-full object-contain mx-auto border border-gray-300 rounded mb-2"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div style="display:none;" class="text-center text-gray-500">
                        <i class="fas fa-file-image text-3xl mb-2"></i>
                        <p class="text-sm">Signature Image</p>
                        <a href="/dean/grade-completion-applications/${application.id}/signature" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs underline">View Full Size</a>
                    </div>
                </div>
            </div>
        `;
    } else {
        signatureContent = `
            <div class="signature-display min-h-[120px] bg-white border-2 border-blue-300 rounded-lg p-6 flex items-center">
                <div class="font-mono text-sm text-gray-800 whitespace-pre-wrap leading-relaxed w-full">
                    ${application.dean_signature || 'Digital signature not available'}
                </div>
            </div>
        `;
    }
    
    const signatureHtml = `
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6">
            <div class="space-y-4">
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Dean's Digital Signature</h3>
                    <div class="flex justify-center space-x-6 text-sm">
                        <div class="flex items-center">
                            <span class="text-gray-600">Type:</span>
                            <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-signature mr-1"></i>
                                ${application.dean_signature_type ? application.dean_signature_type.replace('_', ' ').toUpperCase() : 'DIGITAL'}
                            </span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600">Signed:</span>
                            <span class="ml-2 text-gray-800 font-medium">${application.dean_signature_date || 'N/A'}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-center mb-3">
                        <span class="text-sm font-medium text-gray-700">OFFICIAL SIGNATURE</span>
                    </div>
                    ${signatureContent}
                    <div class="text-center mt-3 text-xs text-gray-500">
                        This digital signature authenticates the Dean's approval of this application
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('signatureDetails').innerHTML = signatureHtml;
}

function viewSignedDocument(applicationId) {
    window.open(`/dean/grade-completion-applications/${applicationId}/signed-document`, '_blank');
}

function closeViewApprovedModal() {
    document.getElementById('viewApprovedModal').classList.add('hidden');
}

function closeViewSignatureModal() {
    document.getElementById('viewSignatureModal').classList.add('hidden');
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
</script>
@endsection
