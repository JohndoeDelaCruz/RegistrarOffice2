@extends('layouts.faculty')

@section('page-title', 'Student Checklist - ' . $student->name)

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Header Section -->
    <div class="border-b border-gray-200 pb-4 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('faculty.students-checklist') }}" 
                       class="text-blue-500 hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Students List
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Student Grade Status</h1>
                <p class="text-gray-600">{{ $student->course }} - {{ $student->track }}</p>
                <p class="text-sm text-gray-500">Student ID: {{ $student->student_id }} | {{ $student->name }}</p>
                <p class="text-sm text-gray-500">Email: {{ $student->email }}</p>
            </div>
            <div class="text-right">
                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    Faculty View
                </div>
                <p class="text-xs text-gray-500 mt-1">Academic Year {{ $currentAcademicYear->year ?? '2024-2025' }}</p>
            </div>
        </div>
    </div>

    <!-- Grade Status Legend -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Grade Status Legend</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="flex items-center gap-2">
                <span class="w-4 h-4 bg-red-500 rounded-full"></span>
                <span class="text-sm">NFE - No Final Exam</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-4 h-4 bg-yellow-500 rounded-full"></span>
                <span class="text-sm">INC - Incomplete</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-4 h-4 bg-gray-500 rounded-full"></span>
                <span class="text-sm">NG - No Grade</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-4 h-4 bg-red-600 rounded-full"></span>
                <span class="text-sm">Failed</span>
            </div>
        </div>
    </div>

    <!-- Subjects List -->
    <div class="space-y-6">
        @if(isset($subjectsByYear) && count($subjectsByYear) > 0)
            @foreach($subjectsByYear as $year => $trimesters)
                @php
                    $yearConfig = [
                        1 => ['name' => 'FIRST YEAR', 'color' => 'text-green-500', 'bg' => 'bg-green-50', 'border' => 'border-green-200'],
                        2 => ['name' => 'SECOND YEAR', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50', 'border' => 'border-blue-200'],
                        3 => ['name' => 'THIRD YEAR', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50', 'border' => 'border-purple-200'],
                    ];
                    $config = $yearConfig[$year] ?? ['name' => 'YEAR ' . $year, 'color' => 'text-gray-500', 'bg' => 'bg-gray-50', 'border' => 'border-gray-200'];
                @endphp

                <div class="border {{ $config['border'] }} rounded-lg {{ $config['bg'] }}">
                    <div class="p-4 border-b {{ $config['border'] }}">
                        <h2 class="text-xl font-bold {{ $config['color'] }}">{{ $config['name'] }}</h2>
                    </div>
                    <div class="p-4">
                        @foreach($trimesters as $trimester => $subjects)
                            <div class="mb-6 last:mb-0">
                                <h3 class="text-lg font-semibold text-gray-700 mb-3">
                                    {{ ucfirst($trimester) }} Trimester
                                </h3>
                                <div class="space-y-3">
                                    @foreach($subjects as $subject)
                                        @php
                                            $grade = $student->grades()->where('subject_id', $subject->id)->first();
                                            $currentStatus = $grade ? $grade->grade : null;
                                        @endphp
                                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                                <div class="flex-1">
                                                    <h4 class="font-medium text-gray-900">{{ $subject->description }}</h4>
                                                    <p class="text-sm text-gray-600">{{ $subject->code }} • {{ $subject->units }} units</p>
                                                    @if($subject->track)
                                                        <p class="text-xs text-gray-500 mt-1">Track: {{ $subject->track }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <!-- Current Status Display -->
                                                    <div class="text-sm">
                                                        @if($currentStatus)
                                                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                                                @if($currentStatus === 'NFE') bg-red-100 text-red-800
                                                                @elseif($currentStatus === 'INC') bg-yellow-100 text-yellow-800
                                                                @elseif($currentStatus === 'NG') bg-gray-100 text-gray-800
                                                                @elseif($currentStatus === 'Failed') bg-red-100 text-red-800
                                                                @else bg-blue-100 text-blue-800
                                                                @endif
                                                            ">
                                                                {{ $currentStatus }}
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                                                Not Set
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <!-- Status Update Dropdown -->
                                                    <select 
                                                        class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                        onchange="updateGradeStatus({{ $student->id }}, {{ $subject->id }}, this.value)"
                                                    >
                                                        <option value="">Select Status</option>
                                                        <option value="NFE" {{ $currentStatus === 'NFE' ? 'selected' : '' }}>NFE</option>
                                                        <option value="INC" {{ $currentStatus === 'INC' ? 'selected' : '' }}>INC</option>
                                                        <option value="NG" {{ $currentStatus === 'NG' ? 'selected' : '' }}>NG</option>
                                                        <option value="Failed" {{ $currentStatus === 'Failed' ? 'selected' : '' }}>Failed</option>
                                                        <option value="Clear" {{ !$currentStatus ? 'selected' : '' }}>Clear Status</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-8">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-clipboard-list text-4xl"></i>
                </div>
                <p class="text-gray-600">No subjects found for this student.</p>
            </div>
        @endif
    </div>
</div>

<!-- Success/Error Messages -->
<div id="messageContainer" class="fixed top-4 right-4 z-50"></div>

<script>
function updateGradeStatus(studentId, subjectId, status) {
    if (!status) {
        return;
    }
    
    // Show loading state
    showMessage('Updating status...', 'info');
    
    // Prepare the request
    const url = status === 'Clear' 
        ? `/faculty/student/${studentId}/subject/${subjectId}/grade`
        : `/faculty/student/${studentId}/subject/${subjectId}/grade`;
    
    const method = status === 'Clear' ? 'DELETE' : 'POST';
    const data = status === 'Clear' ? {} : { grade: status };
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage(data.message, 'success');
            // Reload the page to update the display
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            showMessage(data.message || 'Error updating status', 'error');
        }
    })
    .catch(error => {
        showMessage('Error updating status', 'error');
        console.error('Error:', error);
    });
}

function showMessage(message, type) {
    const container = document.getElementById('messageContainer');
    const messageDiv = document.createElement('div');
    
    const bgColor = type === 'success' ? 'bg-green-500' : 
                   type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    
    messageDiv.className = `${bgColor} text-white px-4 py-3 rounded-lg shadow-lg mb-2 transition-all duration-300`;
    messageDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    container.appendChild(messageDiv);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.remove();
        }
    }, 5000);
}
</script>
@endsection
