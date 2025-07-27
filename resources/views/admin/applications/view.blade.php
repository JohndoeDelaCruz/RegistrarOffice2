@extends('layouts.admin')

@section('page-title', 'View Application')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Application Details</h1>
            <p class="text-gray-600">Grade Completion Application #{{ $application->id }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <a href="{{ route('admin.applications.edit', $application->id) }}" 
                   class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
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
    <div class="flex items-center p-4 border border-gray-200 rounded-lg">
        <div class="bg-green-100 p-3 rounded-full mr-4">
            <i class="fas fa-file-alt text-green-600 text-xl"></i>
        </div>
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-900">Supporting Document</p>
            <p class="text-sm text-gray-500">Uploaded on {{ $application->created_at->format('F j, Y') }}</p>
        </div>
        <div class="flex space-x-2">
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-eye mr-1"></i>View
            </button>
            <button class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors duration-200">
                <i class="fas fa-download mr-1"></i>Download
            </button>
        </div>
    </div>
</div>
@endif

<!-- Dean's Signature -->
@if($application->dean_status === 'approved' && $application->dean_signature)
<div class="bg-white rounded-lg shadow-sm p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Dean's Approval</h3>
    <div class="flex items-center p-4 border border-gray-200 rounded-lg bg-green-50">
        <div class="bg-green-100 p-3 rounded-full mr-4">
            <i class="fas fa-file-signature text-green-600 text-xl"></i>
        </div>
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-900">Digitally Signed Document</p>
            <p class="text-sm text-gray-500">Signed on {{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</p>
        </div>
        <div class="flex space-x-2">
            <button class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700 transition-colors duration-200">
                <i class="fas fa-eye mr-1"></i>View
            </button>
            <button class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors duration-200">
                <i class="fas fa-download mr-1"></i>Download
            </button>
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
@endsection
