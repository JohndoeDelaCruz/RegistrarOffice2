@extends('layouts.admin')

@section('page-title', 'View Document')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Supporting Document</h1>
            <p class="text-gray-600">Application #{{ $application->id }} - {{ $application->student->name }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <a href="{{ route('admin.applications.view', $application->id) }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-eye mr-2"></i>View Application
                </a>
                <a href="{{ route('admin.application-tracking') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Application Summary -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Summary</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Student</label>
            <p class="text-sm text-gray-900">{{ $application->student->name }}</p>
            <p class="text-xs text-gray-500">{{ $application->student->student_id }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Subject</label>
            <p class="text-sm text-gray-900">{{ $application->subject->code }}</p>
            <p class="text-xs text-gray-500">{{ $application->subject->description }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Current Grade</label>
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                {{ $application->current_grade }}
            </span>
        </div>
    </div>
</div>

<!-- Document Viewer -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Supporting Document</h3>
        <div class="flex space-x-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-download mr-2"></i>Download
            </button>
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i class="fas fa-print mr-2"></i>Print
            </button>
        </div>
    </div>

    <!-- Document Information -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">File Name</label>
                <p class="text-sm text-gray-900">supporting_document_{{ $application->id }}.pdf</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Date</label>
                <p class="text-sm text-gray-900">{{ $application->created_at->format('F j, Y g:i A') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">File Size</label>
                <p class="text-sm text-gray-900">2.4 MB</p>
            </div>
        </div>
    </div>

    <!-- Document Preview Area -->
    <div class="border-2 border-dashed border-gray-300 rounded-lg p-12 text-center">
        <div class="space-y-4">
            <div class="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-file-pdf text-red-600 text-3xl"></i>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-900">PDF Document Preview</h4>
                <p class="text-sm text-gray-500 mb-4">Supporting document for grade completion application</p>
                <div class="flex justify-center space-x-3">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-external-link-alt mr-2"></i>Open in New Tab
                    </button>
                    <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-expand mr-2"></i>Full Screen View
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Details -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600"></i>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-blue-800">Document Information</h4>
                <p class="mt-1 text-sm text-blue-700">
                    This is the supporting document submitted by the student as part of their grade completion application. 
                    The document was uploaded on {{ $application->created_at->format('F j, Y') }} and is available for 
                    review and download.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
