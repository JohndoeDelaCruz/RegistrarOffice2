@extends('layouts.dean')

@section('page-title', 'Application Approved')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Success Header -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center">
            <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-green-600 text-4xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Application Approved Successfully!</h1>
            <p class="text-lg text-gray-600 mb-2">The grade completion application has been approved and forwarded to the faculty.</p>
            <p class="text-sm text-gray-500">Reference: GCA-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <!-- Application Details -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-file-alt text-blue-600 mr-3"></i>
            Application Details
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Student Information -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-user text-blue-600 mr-2"></i>Student Information
                </h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Name:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $application->student->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Student ID:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $application->student->student_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Course:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $application->student->course }} - {{ $application->student->track }}</span>
                    </div>
                </div>
            </div>

            <!-- Subject Information -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-book text-green-600 mr-2"></i>Subject Information
                </h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Subject:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $application->subject->code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Description:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $application->subject->description }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Current Grade:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $application->current_grade }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approval Details -->
        <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <i class="fas fa-stamp text-green-600 mr-2"></i>Approval Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Approved By:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $dean->name ?? 'Dean' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Approval Date:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $application->dean_reviewed_at->format('F j, Y g:i A') }}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Completion Deadline:</span>
                        <span class="text-sm font-medium text-orange-600">{{ $application->completion_deadline->format('F j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>Approved
                        </span>
                    </div>
                </div>
            </div>
            
            @if($application->dean_remarks)
            <div class="mt-4 pt-4 border-t border-green-200">
                <span class="text-sm text-gray-600">Dean Remarks:</span>
                <p class="text-sm text-gray-800 mt-1 bg-white p-3 rounded border">{{ $application->dean_remarks }}</p>
            </div>
            @endif
        </div>

        <!-- Digital Signature -->
        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                <i class="fas fa-signature text-gray-600 mr-2"></i>Digital Signature
            </h3>
            <div class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-4">
                <pre class="text-sm text-gray-700 whitespace-pre-wrap font-mono">{{ $application->dean_signature }}</pre>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('dean.grade-completion-applications') }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                <i class="fas fa-list mr-2"></i>
                Back to Applications
            </a>
            <a href="{{ route('dean.approved-applications') }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium">
                <i class="fas fa-check-circle mr-2"></i>
                View All Approved
            </a>
            <button onclick="window.print()" 
                    class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 font-medium">
                <i class="fas fa-print mr-2"></i>
                Print Approval
            </button>
        </div>
    </div>
</div>

<style media="print">
    @media print {
        .no-print {
            display: none !important;
        }
        
        body {
            background: white !important;
        }
        
        .shadow-lg {
            box-shadow: none !important;
            border: 1px solid #e5e7eb !important;
        }
    }
</style>
@endsection
