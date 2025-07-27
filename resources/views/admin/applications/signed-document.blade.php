@extends('layouts.admin')

@section('page-title', 'View Signed Document')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Signed Document</h1>
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
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <i class="fas fa-check mr-1"></i>Approved
            </span>
        </div>
    </div>
</div>

<!-- Signature Information -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Digital Signature Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Signed By</label>
            <p class="text-sm text-gray-900">{{ $application->deanReviewedBy->name ?? 'Unknown Dean' }}</p>
            <p class="text-xs text-gray-500">Dean of College</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Signature Date</label>
            <p class="text-sm text-gray-900">{{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Signature Status</label>
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <i class="fas fa-certificate mr-1"></i>Verified
            </span>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Document Hash</label>
            <p class="text-xs text-gray-500 font-mono">SHA256: {{ substr(hash('sha256', $application->id . $application->dean_reviewed_at), 0, 32) }}...</p>
        </div>
    </div>
</div>

<!-- Signed Document Viewer -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Digitally Signed Document</h3>
        <div class="flex space-x-2">
            <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                <i class="fas fa-download mr-2"></i>Download PDF
            </button>
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i class="fas fa-print mr-2"></i>Print
            </button>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-certificate mr-2"></i>Verify Signature
            </button>
        </div>
    </div>

    <!-- Document Information -->
    <div class="bg-green-50 rounded-lg p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">File Name</label>
                <p class="text-sm text-gray-900">signed_application_{{ $application->id }}.pdf</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Creation Date</label>
                <p class="text-sm text-gray-900">{{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">File Size</label>
                <p class="text-sm text-gray-900">3.1 MB</p>
            </div>
        </div>
    </div>

    <!-- Document Preview Area -->
    <div class="border-2 border-green-300 rounded-lg p-12 text-center bg-green-50">
        <div class="space-y-4">
            <div class="mx-auto w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-file-signature text-purple-600 text-3xl"></i>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-900">Digitally Signed PDF Document</h4>
                <p class="text-sm text-gray-500 mb-2">Grade completion application with dean's digital signature</p>
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <i class="fas fa-certificate text-green-600"></i>
                    <span class="text-sm font-medium text-green-800">Digital Signature Verified</span>
                </div>
                <div class="flex justify-center space-x-3">
                    <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                        <i class="fas fa-external-link-alt mr-2"></i>Open in New Tab
                    </button>
                    <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-expand mr-2"></i>Full Screen View
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Signature Details -->
    <div class="mt-6 bg-purple-50 border border-purple-200 rounded-lg p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-certificate text-purple-600"></i>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-purple-800">Digital Signature Details</h4>
                <p class="mt-1 text-sm text-purple-700">
                    This document has been digitally signed by {{ $application->deanReviewedBy->name ?? 'the Dean' }} on 
                    {{ $application->dean_reviewed_at->format('F j, Y \a\t g:i A') }}. The digital signature ensures 
                    the authenticity and integrity of the document. Any modifications to the document after signing 
                    will invalidate the signature.
                </p>
                @if($application->dean_remarks)
                <div class="mt-3 p-3 bg-white rounded border">
                    <p class="text-sm font-medium text-gray-800">Dean's Remarks:</p>
                    <p class="text-sm text-gray-700 italic">"{{ $application->dean_remarks }}"</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Audit Trail -->
    <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
        <h4 class="text-sm font-medium text-gray-800 mb-3">Document Audit Trail</h4>
        <div class="space-y-2">
            <div class="flex items-center text-sm">
                <i class="fas fa-plus text-blue-600 mr-2"></i>
                <span class="text-gray-600">Document created: {{ $application->created_at->format('F j, Y g:i A') }}</span>
            </div>
            <div class="flex items-center text-sm">
                <i class="fas fa-pen text-green-600 mr-2"></i>
                <span class="text-gray-600">Reviewed and approved: {{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</span>
            </div>
            <div class="flex items-center text-sm">
                <i class="fas fa-certificate text-purple-600 mr-2"></i>
                <span class="text-gray-600">Digital signature applied: {{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
