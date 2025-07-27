@extends('layouts.admin')

@section('page-title', 'Edit Application')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Edit Application</h1>
            <p class="text-gray-600">Grade Completion Application #{{ $application->id }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <a href="{{ route('admin.applications.view', $application->id) }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-eye mr-2"></i>View
                </a>
                <a href="{{ route('admin.application-tracking') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Student & Subject Info (Read-only) -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full mr-4">
                <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Student</label>
                <p class="text-lg font-semibold text-gray-900">{{ $application->student->name }}</p>
                <p class="text-sm text-gray-500">{{ $application->student->student_id }}</p>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Subject</label>
            <p class="text-lg font-semibold text-gray-900">{{ $application->subject->code }}</p>
            <p class="text-sm text-gray-500">{{ $application->subject->description }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Current Grade</label>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                {{ $application->current_grade }}
            </span>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Submitted</label>
            <p class="text-sm text-gray-900">{{ $application->created_at->format('F j, Y g:i A') }}</p>
        </div>
    </div>
</div>

<!-- Edit Form -->
<form action="{{ route('admin.applications.update', $application->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    
    <!-- Current Status -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Current Status</h3>
        <div class="mb-4">
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Previously Reviewed At</label>
                <p class="mt-1 text-sm text-gray-900">{{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Reviewed By</label>
                <p class="mt-1 text-sm text-gray-900">{{ $application->deanReviewedBy->name ?? 'Unknown' }}</p>
            </div>
        </div>
        @endif
        
        @if($application->dean_remarks)
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Previous Remarks</label>
            <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $application->dean_remarks }}</p>
        </div>
        @endif
    </div>

    <!-- Update Status -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Application Status</h3>
        
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3">New Status</label>
            <div class="space-y-3">
                <div class="flex items-center">
                    <input type="radio" id="approved" name="dean_status" value="approved" 
                           class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300"
                           {{ $application->dean_status === 'approved' ? 'checked' : '' }}>
                    <label for="approved" class="ml-3 flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>Approved
                        </span>
                        <span class="ml-2 text-sm text-gray-600">Approve the grade completion application</span>
                    </label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="rejected" name="dean_status" value="rejected" 
                           class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                           {{ $application->dean_status === 'rejected' ? 'checked' : '' }}>
                    <label for="rejected" class="ml-3 flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times mr-1"></i>Rejected
                        </span>
                        <span class="ml-2 text-sm text-gray-600">Reject the grade completion application</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <label for="dean_remarks" class="block text-sm font-medium text-gray-700 mb-2">
                Remarks (Optional)
            </label>
            <textarea id="dean_remarks" name="dean_remarks" rows="4" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                      placeholder="Add any remarks or comments about this decision...">{{ old('dean_remarks', $application->dean_remarks) }}</textarea>
            <p class="mt-1 text-sm text-gray-500">Provide additional context or reasons for your decision.</p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600"></i>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-medium text-blue-800">Note about updating applications</h4>
                    <p class="mt-1 text-sm text-blue-700">
                        Updating this application will overwrite the previous status and remarks. The review timestamp will be updated to the current time, and you will be recorded as the reviewer.
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
            <a href="{{ route('admin.application-tracking') }}" 
               class="w-full sm:w-auto bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200 text-center">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                    class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-save mr-2"></i>Update Application
            </button>
        </div>
    </div>
</form>

<!-- Supporting Documents (Read-only) -->
@if($application->supporting_document)
<div class="bg-white rounded-lg shadow-sm p-6">
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

@if ($errors->any())
<div class="bg-red-50 border border-red-200 rounded-lg p-4 mt-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-red-600"></i>
        </div>
        <div class="ml-3">
            <h4 class="text-sm font-medium text-red-800">Please correct the following errors:</h4>
            <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
@endsection
