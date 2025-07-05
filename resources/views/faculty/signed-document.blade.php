<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Completion Application - {{ $application->student->student_id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            .print-break { page-break-after: always; }
            body { font-size: 12px; }
        }
        
        .signature-area {
            min-height: 120px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            background: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .signature-image {
            max-height: 80px;
            max-width: 300px;
            object-fit: contain;
        }
        
        .signature-text {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            line-height: 1.5;
            white-space: pre-wrap;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Print Controls -->
    <div class="no-print bg-gray-100 p-4 text-center">
        <button onclick="window.print()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-4">
            <i class="fas fa-print mr-2"></i>Print Document
        </button>
        <button onclick="window.close()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            <i class="fas fa-times mr-2"></i>Close
        </button>
    </div>

    <!-- Document Content -->
    <div class="max-w-4xl mx-auto p-8 bg-white">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">GRADE COMPLETION APPLICATION</h1>
            <div class="text-lg text-gray-600">
                <p>University Registrar's Office</p>
                <p>Academic Year: {{ $application->created_at->format('Y') }} - {{ $application->created_at->addYear()->format('Y') }}</p>
            </div>
        </div>

        <!-- Application Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Student Information -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Student Information</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Name:</span>
                        <span class="text-gray-800">{{ $application->student->first_name }} {{ $application->student->last_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Student ID:</span>
                        <span class="text-gray-800">{{ $application->student->student_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Program:</span>
                        <span class="text-gray-800">{{ $application->student->program ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Year Level:</span>
                        <span class="text-gray-800">{{ $application->student->year_level ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Subject Information -->
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-purple-800 mb-4">Subject Information</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Subject Code:</span>
                        <span class="text-gray-800">{{ $application->subject->code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Subject Name:</span>
                        <span class="text-gray-800">{{ $application->subject->description }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Current Grade:</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            {{ $application->current_grade }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Units:</span>
                        <span class="text-gray-800">{{ $application->subject->units ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Details -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-yellow-800 mb-4">Application Details</h2>
            <div class="space-y-4">
                <div>
                    <span class="font-medium text-gray-700">Date Submitted:</span>
                    <span class="text-gray-800 ml-2">{{ $application->created_at->format('F j, Y \a\t g:i A') }}</span>
                </div>
                <div>
                    <span class="font-medium text-gray-700">Reason for Application:</span>
                    <div class="mt-2 p-4 bg-white border border-gray-200 rounded-lg">
                        <p class="text-gray-800">{{ $application->reason }}</p>
                    </div>
                </div>
                @if($application->supporting_document)
                <div>
                    <span class="font-medium text-gray-700">Supporting Document:</span>
                    <span class="text-gray-600 ml-2">Document attached ({{ pathinfo($application->supporting_document, PATHINFO_EXTENSION) }})</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Dean's Review -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-green-800 mb-4">Dean's Review</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-700">Status:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        APPROVED
                    </span>
                </div>
                <div>
                    <span class="font-medium text-gray-700">Date Reviewed:</span>
                    <span class="text-gray-800 ml-2">{{ $application->dean_reviewed_at->format('F j, Y \a\t g:i A') }}</span>
                </div>
                @if($application->dean_remarks)
                <div>
                    <span class="font-medium text-gray-700">Dean's Remarks:</span>
                    <div class="mt-2 p-4 bg-white border border-gray-200 rounded-lg">
                        <p class="text-gray-800">{{ $application->dean_remarks }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Dean's Digital Signature -->
        <div class="bg-gray-50 border-2 border-gray-300 rounded-lg p-6 mb-8">
            <div class="text-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">DEAN'S DIGITAL SIGNATURE</h2>
                <p class="text-sm text-gray-600">This signature authenticates the approval of this grade completion application</p>
            </div>
            
            <div class="signature-area">
                @if($application->dean_signature_type === 'uploaded_file')
                    <div class="text-center">
                        <img src="{{ route('dean.grade-completion-applications.signature', $application->id) }}" 
                             alt="Dean's Digital Signature" 
                             class="signature-image">
                    </div>
                @else
                    <div class="signature-text text-center">
                        {{ $application->dean_signature }}
                    </div>
                @endif
            </div>
            
            <div class="mt-4 text-center text-sm text-gray-600">
                <div class="flex justify-center space-x-8">
                    <div>
                        <strong>Signature Type:</strong> 
                        {{ $application->dean_signature_type ? ucfirst(str_replace('_', ' ', $application->dean_signature_type)) : 'Digital' }}
                    </div>
                    <div>
                        <strong>Date Signed:</strong> 
                        {{ $application->dean_signature_date ? \Carbon\Carbon::parse($application->dean_signature_date)->format('F j, Y \a\t g:i A') : 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Faculty Processing (if completed) -->
        @if($application->faculty_status)
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-800 mb-4">Faculty Processing</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-700">Status:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $application->faculty_status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <i class="fas {{ $application->faculty_status === 'completed' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ strtoupper($application->faculty_status) }}
                    </span>
                </div>
                @if($application->faculty_status === 'completed' && $application->final_grade)
                <div>
                    <span class="font-medium text-gray-700">Final Grade:</span>
                    <span class="text-gray-800 ml-2 font-semibold">{{ $application->final_grade }}</span>
                </div>
                @endif
                <div>
                    <span class="font-medium text-gray-700">Date Processed:</span>
                    <span class="text-gray-800 ml-2">{{ $application->faculty_processed_at ? $application->faculty_processed_at->format('F j, Y \a\t g:i A') : 'N/A' }}</span>
                </div>
                @if($application->faculty_remarks)
                <div>
                    <span class="font-medium text-gray-700">Faculty Remarks:</span>
                    <div class="mt-2 p-4 bg-white border border-gray-200 rounded-lg">
                        <p class="text-gray-800">{{ $application->faculty_remarks }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="text-center text-sm text-gray-500 mt-8 pt-6 border-t border-gray-200">
            <p>This is an official document generated by the University Registrar's Office.</p>
            <p>Generated on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>
