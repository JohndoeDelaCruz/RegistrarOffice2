@extends('layouts.admin')

@section('page-title', 'View Application')

@section('content')
<style>
.min-h-screen-75 {
    min-height: 75vh;
}
.h-screen-80 {
    height: 80vh;
    min-height: 600px;
}
</style>

<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Application Details</h1>
            <p class="text-gray-600">Grade Completion Application #{{ $application->id }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <a href="{{ route('admin.application-tracking') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Application Status Card -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Application Status</h3>
        @if($application->dean_status === null)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                <i class="fas fa-clock mr-2"></i>Pending Review
            </span>
        @elseif($application->dean_status === 'approved')
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                <i class="fas fa-check mr-2"></i>Approved
            </span>
        @else
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                <i class="fas fa-times mr-2"></i>Rejected
            </span>
        @endif
    </div>
    
    @if($application->dean_reviewed_at)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Reviewed At</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Reviewed By</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->deanReviewedBy->name ?? 'Unknown' }}</p>
        </div>
    </div>
    @endif
    
    @if($application->dean_remarks)
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Dean's Remarks</label>
        <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $application->dean_remarks }}</p>
    </div>
    @endif
</div>

<!-- Student Information -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Student Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full mr-4">
                <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Student Name</label>
                <p class="text-lg font-semibold text-gray-900">{{ $application->student->name }}</p>
                <p class="text-sm text-gray-500">{{ $application->student->student_id }}</p>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email Address</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->student->email }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Year Level</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->student->year_level ?? 'Not specified' }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Track</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->student->track ?? 'Not specified' }}</p>
        </div>
    </div>
</div>

<!-- Subject Information -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Subject Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Subject Code</label>
            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $application->subject->code }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Subject Name</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->subject->description }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Current Grade</label>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                {{ $application->current_grade }}
            </span>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Units</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->subject->units ?? 'Not specified' }}</p>
        </div>
    </div>
</div>

<!-- Application Details -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Details</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Submitted Date</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->created_at->format('F j, Y g:i A') }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Academic Year</label>
            <p class="mt-1 text-sm text-gray-900">{{ $application->academicYear->year ?? 'Not specified' }}</p>
        </div>
    </div>
    
    @if($application->reason)
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Reason for Application</label>
        <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $application->reason }}</p>
    </div>
    @endif
</div>

<!-- Supporting Documents -->
@if($application->supporting_document)
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Supporting Documents</h3>
    <div class="border border-gray-200 rounded-lg">
        <!-- Document Header -->
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-t-lg">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ $application->original_filename ?? 'Supporting Document' }}</p>
                    <p class="text-sm text-gray-500">Uploaded on {{ $application->created_at->format('F j, Y') }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <button onclick="toggleDocumentView()" 
                        class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-eye mr-1"></i><span id="viewToggleText">View</span>
                </button>
                <a href="{{ route('admin.applications.document', $application->id) }}?download=1" 
                   class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-download mr-1"></i>Download
                </a>
            </div>
        </div>
        
        <!-- Document Viewer -->
        <div id="documentViewer" class="hidden border-t border-gray-200">
            <div class="p-6 bg-gray-50 min-h-screen-75">
                <div id="documentContent" class="w-full h-full bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center justify-center h-40">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin text-3xl text-gray-500 mb-4"></i>
                            <p class="text-gray-600 text-lg">Loading document...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Action History -->
<div class="bg-white rounded-lg shadow-sm p-6 mt-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Action History</h3>
    <div class="space-y-4">
        <div class="flex items-start">
            <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                <i class="fas fa-plus text-blue-600"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                <p class="text-sm text-gray-500">{{ $application->created_at->format('F j, Y g:i A') }}</p>
                <p class="text-sm text-gray-600">Student submitted grade completion application</p>
            </div>
        </div>
        
        @if($application->dean_reviewed_at)
        <div class="flex items-start">
            <div class="bg-{{ $application->dean_status === 'approved' ? 'green' : 'red' }}-100 p-2 rounded-full mr-3 mt-1">
                <i class="fas fa-{{ $application->dean_status === 'approved' ? 'check' : 'times' }} text-{{ $application->dean_status === 'approved' ? 'green' : 'red' }}-600"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Application {{ ucfirst($application->dean_status) }}</p>
                <p class="text-sm text-gray-500">{{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</p>
                <p class="text-sm text-gray-600">Reviewed by {{ $application->deanReviewedBy->name ?? 'Unknown' }}</p>
                @if($application->dean_remarks)
                <p class="text-sm text-gray-600 mt-1 italic">"{{ $application->dean_remarks }}"</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Application Details Modal -->
<div id="applicationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg flex items-center justify-between">
            <h2 class="text-xl font-semibold flex items-center">
                <i class="fas fa-file-alt mr-2"></i>
                Application Details  
            </h2>
            <button onclick="closeApplicationModal()" class="text-white hover:text-gray-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <!-- Status Card -->
            @if($application->dean_status === 'approved')
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span class="font-semibold text-green-800">Approved by Dean</span>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                        Dean Approved
                    </span>
                </div>
                <p class="text-green-700 text-sm mt-1">This application has been approved and digitally signed by the Dean</p>
            </div>
            @elseif($application->dean_status === 'rejected')
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-times-circle text-red-600 mr-2"></i>
                        <span class="font-semibold text-red-800">Rejected by Dean</span>
                    </div>
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                        Dean Rejected
                    </span>
                </div>
                <p class="text-red-700 text-sm mt-1">This application has been reviewed and rejected by the Dean</p>
            </div>
            @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-yellow-600 mr-2"></i>
                        <span class="font-semibold text-yellow-800">Pending Review</span>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                        Pending
                    </span>
                </div>
                <p class="text-yellow-700 text-sm mt-1">This application is waiting for Dean's review</p>
            </div>
            @endif

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Student Information -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                        <i class="fas fa-user-graduate mr-2"></i>
                        Student Information
                    </h3>
                    <div class="space-y-2">
                        <div>
                            <span class="text-sm font-medium text-gray-600">Name:</span>
                            <p id="modalStudentName" class="font-semibold">{{ $application->student->name }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Student ID:</span>
                            <p id="modalStudentId">{{ $application->student->student_id }}</p>
                        </div>
                    </div>
                </div>

                <!-- Subject Information -->
                <div class="bg-purple-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-purple-800 mb-3 flex items-center">
                        <i class="fas fa-book mr-2"></i>
                        Subject Information
                    </h3>
                    <div class="space-y-2">
                        <div>
                            <span class="text-sm font-medium text-gray-600">Subject Code:</span>
                            <p id="modalSubjectCode" class="font-semibold">{{ $application->subject->code }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Subject Name:</span>
                            <p id="modalSubjectName">{{ $application->subject->name }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Current Grade:</span>
                            <span id="modalCurrentGrade" class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 text-sm font-medium rounded">
                                <i class="fas fa-exclamation-triangle mr-1"></i>NG
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Details -->
            <div class="bg-yellow-50 rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-yellow-800 mb-3 flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Application Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600">Submitted:</span>
                        <p>{{ $application->created_at->format('M j, Y g:i A') }}</p>
                    </div>
                    @if($application->dean_reviewed_at)
                    <div>
                        <span class="text-sm font-medium text-gray-600">Dean Approved:</span>
                        <p>{{ $application->dean_reviewed_at->format('M j, Y g:i A') }}</p>
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-600">Reason for Application:</span>
                    <div class="mt-2 p-3 bg-white rounded border">
                        <p class="text-sm">{{ $application->reason }}</p>
                    </div>
                </div>

                <!-- Supporting Document -->
                @if($application->supporting_document)
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-600">Supporting Document:</span>
                    <div class="mt-2">
                        <div class="border border-gray-200 rounded">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-t">
                                <div class="flex items-center">
                                    <i class="fas fa-file text-blue-600 mr-2"></i>
                                    <span class="text-sm font-medium">{{ $application->original_filename ?? basename($application->supporting_document) }}</span>
                                </div>
                                <button onclick="toggleModalDocumentView()" 
                                        class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-eye mr-1"></i><span id="modalViewToggleText">View</span>
                                </button>
                            </div>
                            <div id="modalDocumentViewer" class="hidden border-t border-gray-200">
                                <div class="p-4 bg-gray-50 min-h-96">
                                    <div id="modalDocumentContent" class="w-full h-full bg-white rounded shadow-sm border border-gray-200">
                                        <div class="flex items-center justify-center h-40">
                                            <div class="text-center">
                                                <i class="fas fa-spinner fa-spin text-2xl text-gray-500 mb-3"></i>
                                                <p class="text-gray-600">Loading document...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-600">Supporting Document:</span>
                    <div class="mt-2 text-sm text-gray-500 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>No supporting document submitted
                    </div>
                </div>
                @endif

                <!-- Dean's Remarks -->
                @if($application->dean_remarks)
                <div>
                    <span class="text-sm font-medium text-gray-600">Dean's Remarks:</span>
                    <div class="mt-2 p-3 bg-white rounded border">
                        <p class="text-sm">{{ $application->dean_remarks }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<script>
// Application Modal Functions
function openApplicationModal(applicationId) {
    const modal = document.getElementById('applicationModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeApplicationModal() {
    const modal = document.getElementById('applicationModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Event Listeners for closing application modal
document.getElementById('applicationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeApplicationModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!document.getElementById('applicationModal').classList.contains('hidden')) {
            closeApplicationModal();
        }
    }
});
</script>

<!-- Document Panel Overlay -->
<div id="documentOverlay" class="fixed inset-0 bg-black bg-opacity-30 hidden z-40"></div>

<script>
let currentDocumentUrl = '';

// Application Modal Functions
function openApplicationModal(applicationId) {
    const modal = document.getElementById('applicationModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeApplicationModal() {
    const modal = document.getElementById('applicationModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Supporting Document Modal Functions
function openSupportingDocumentModal(url, filename) {
    const modal = document.getElementById('supportingDocumentModal');
    const title = document.getElementById('supportingDocTitle');
    const downloadBtn = document.getElementById('supportingDownloadBtn');
    const errorDownloadBtn = document.getElementById('supportingErrorDownloadBtn');
    
    // Set title and download links
    title.textContent = filename || 'Supporting Document';
    downloadBtn.onclick = () => window.open(url + '?download=1', '_blank');
    errorDownloadBtn.onclick = () => window.open(url + '?download=1', '_blank');
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Load document
    loadSupportingDocument(url, filename);
}

function closeSupportingDocumentModal() {
    const modal = document.getElementById('supportingDocumentModal');
    const pdfViewer = document.getElementById('supportingPdfViewer');
    const imageViewer = document.getElementById('supportingImageViewer');
    
    // Hide modal
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Clear viewers
    pdfViewer.src = 'about:blank';
    imageViewer.src = '';
    pdfViewer.classList.add('hidden');
    imageViewer.classList.add('hidden');
}

function loadSupportingDocument(url, filename) {
    const pdfViewer = document.getElementById('supportingPdfViewer');
    const imageViewer = document.getElementById('supportingImageViewer');
    const loadingSpinner = document.getElementById('supportingLoadingSpinner');
    const errorMessage = document.getElementById('supportingErrorMessage');
    
    // Hide all viewers and show loading
    pdfViewer.classList.add('hidden');
    imageViewer.classList.add('hidden');
    errorMessage.classList.add('hidden');
    loadingSpinner.classList.remove('hidden');
    
    // Get file extension
    const extension = filename ? filename.split('.').pop().toLowerCase() : 'pdf';
    
    if (extension === 'pdf') {
        // Load PDF
        pdfViewer.src = url;
        pdfViewer.onload = () => {
            loadingSpinner.classList.add('hidden');
            pdfViewer.classList.remove('hidden');
        };
        pdfViewer.onerror = () => {
            loadingSpinner.classList.add('hidden');
            errorMessage.classList.remove('hidden');
        };
    } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
        // Load Image
        imageViewer.src = url;
        imageViewer.onload = () => {
            loadingSpinner.classList.add('hidden');
            imageViewer.classList.remove('hidden');
        };
        imageViewer.onerror = () => {
            loadingSpinner.classList.add('hidden');
            errorMessage.classList.remove('hidden');
        };
    } else {
        // Try PDF viewer as fallback
        pdfViewer.src = url;
        setTimeout(() => {
            loadingSpinner.classList.add('hidden');
            pdfViewer.classList.remove('hidden');
        }, 1000);
    }
}

// Inline Document Viewer Functions
function toggleDocumentView() {
    const viewer = document.getElementById('documentViewer');
    const toggleText = document.getElementById('viewToggleText');
    const content = document.getElementById('documentContent');
    
    if (viewer.classList.contains('hidden')) {
        viewer.classList.remove('hidden');
        toggleText.textContent = 'Hide';
        loadInlineDocument(content, '{{ route("admin.applications.document", $application->id) }}', '{{ $application->original_filename ?? basename($application->supporting_document ?? "") }}');
    } else {
        viewer.classList.add('hidden');
        toggleText.textContent = 'View';
        content.innerHTML = '<div class="flex items-center justify-center h-40"><div class="text-center"><i class="fas fa-spinner fa-spin text-3xl text-gray-500 mb-4"></i><p class="text-gray-600 text-lg">Loading document...</p></div></div>';
    }
}

function toggleModalDocumentView() {
    const viewer = document.getElementById('modalDocumentViewer');
    const toggleText = document.getElementById('modalViewToggleText');
    const content = document.getElementById('modalDocumentContent');
    
    if (viewer.classList.contains('hidden')) {
        viewer.classList.remove('hidden');
        toggleText.textContent = 'Hide';
        loadInlineDocument(content, '{{ route("admin.applications.document", $application->id) }}', '{{ $application->original_filename ?? basename($application->supporting_document ?? "") }}');
    } else {
        viewer.classList.add('hidden');
        toggleText.textContent = 'View';
        content.innerHTML = '<div class="flex items-center justify-center h-40"><div class="text-center"><i class="fas fa-spinner fa-spin text-2xl text-gray-500 mb-3"></i><p class="text-gray-600">Loading document...</p></div></div>';
    }
}

function loadInlineDocument(container, documentUrl, filename) {
    const fileExtension = filename.split('.').pop().toLowerCase();
    
    if (fileExtension === 'pdf') {
        // Load PDF in iframe with larger dimensions
        container.innerHTML = `
            <iframe src="${documentUrl}" class="w-full h-screen-80 border-0 rounded-lg" frameborder="0" style="min-height: 600px;">
                <div class="text-center py-12">
                    <i class="fas fa-exclamation-triangle text-3xl text-yellow-500 mb-4"></i>
                    <p class="text-gray-600 text-lg">Unable to display PDF. <a href="${documentUrl}?download=1" class="text-blue-600 hover:underline font-medium">Download instead</a></p>
                </div>
            </iframe>
        `;
    } else if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExtension)) {
        // Load image with larger container
        container.innerHTML = `
            <div class="text-center p-6" style="min-height: 600px;">
                <img src="${documentUrl}" alt="Supporting Document" class="max-w-full max-h-full h-auto rounded-lg shadow-md mx-auto border border-gray-200" 
                     style="max-height: 550px;"
                     onerror="this.parentElement.innerHTML='<div class=\\'text-center py-12\\'><i class=\\'fas fa-exclamation-triangle text-3xl text-yellow-500 mb-4\\'></i><p class=\\'text-gray-600 text-lg\\'>Unable to display image. <a href=\\'${documentUrl}?download=1\\' class=\\'text-blue-600 hover:underline font-medium\\'>Download instead</a></p></div>'">
            </div>
        `;
    } else {
        // Unsupported file type with larger container
        container.innerHTML = `
            <div class="text-center py-16" style="min-height: 400px;">
                <i class="fas fa-file text-6xl text-gray-400 mb-6"></i>
                <h4 class="font-semibold text-gray-700 mb-3 text-xl">Preview not available</h4>
                <p class="text-gray-600 mb-6 text-lg">This file type (${fileExtension.toUpperCase()}) cannot be previewed inline.</p>
                <a href="${documentUrl}?download=1" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-lg">
                    <i class="fas fa-download mr-3"></i>Download Document
                </a>
            </div>
        `;
    }
}

// Event Listeners for closing modals
document.getElementById('applicationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeApplicationModal();
    }
});

document.getElementById('supportingDocumentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSupportingDocumentModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!document.getElementById('applicationModal').classList.contains('hidden')) {
            closeApplicationModal();
        }
        if (!document.getElementById('supportingDocumentModal').classList.contains('hidden')) {
            closeSupportingDocumentModal();
        }
    }
});
</script>


<script>
// Application page functionality - no reminder features
</script>

@endsection
