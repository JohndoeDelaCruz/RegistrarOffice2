@extends('layouts.faculty')

@section('page-title', 'Students\' Checklist')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Students Checklist</h1>
        <p class="text-gray-600 mb-4">{{ $faculty->college ?? 'Faculty Management' }} - {{ count($students) }} students</p>
    </div>
    
    <!-- Search Section -->
    <div class="mb-4 sm:mb-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    id="studentSearch"
                    placeholder="Search by name or ID..." 
                    class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                >
            </div>
            <button 
                onclick="searchStudents()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 sm:px-6 py-2 rounded-lg font-medium transition-colors duration-200 text-sm sm:text-base"
            >
                Search
            </button>
        </div>
    </div>
    
    <!-- Students Table -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left py-3 px-2 sm:px-4 font-semibold text-gray-700 text-sm sm:text-base">NAME</th>
                    <th class="text-left py-3 px-2 sm:px-4 font-semibold text-gray-700 text-sm sm:text-base">ID NUMBER</th>
                    <th class="text-left py-3 px-2 sm:px-4 font-semibold text-gray-700 text-sm sm:text-base hidden md:table-cell">MAJOR</th>
                    <th class="text-left py-3 px-2 sm:px-4 font-semibold text-gray-700 text-sm sm:text-base">ACTIONS</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
                @forelse($students as $student)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200 student-row" 
                        data-name="{{ strtolower($student->name) }}" 
                        data-id="{{ strtolower($student->student_id) }}">
                        <td class="py-3 px-2 sm:px-4">
                            <div class="font-medium text-gray-900 text-sm sm:text-base">{{ $student->name }}</div>
                            <!-- Show major on mobile -->
                            <div class="text-xs text-gray-500 md:hidden mt-1">
                                @if($student->course === 'BSIT')
                                    BSIT
                                @else
                                    {{ $student->course ?? 'BSIT' }}
                                @endif
                                @if($student->track)
                                    <span class="text-blue-600">/{{ str_replace('Track', 'Track', $student->track) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-2 sm:px-4">
                            <div class="text-gray-700 text-sm sm:text-base">{{ $student->student_id }}</div>
                        </td>
                        <td class="py-3 px-2 sm:px-4 hidden md:table-cell">
                            <div class="text-gray-700 text-sm sm:text-base">
                                {{ $student->course ?? 'BSIT' }}
                                @if($student->track)
                                    <span class="text-blue-600">/{{ str_replace('Track', 'Track', $student->track) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-2 sm:px-4">
                            <a 
                                href="{{ route('faculty.student-checklist-detail', $student->id) }}"
                                class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-md text-sm font-medium transition-colors duration-200 whitespace-nowrap"
                            >
                                <i class="fas fa-eye mr-1.5"></i>
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 px-2 sm:px-4 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-users text-4xl text-gray-300 mb-2"></i>
                                <p class="text-sm sm:text-base">No students found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Students Count -->
    <div class="mt-4 text-sm text-gray-600">
        Showing {{ $students->count() }} student{{ $students->count() !== 1 ? 's' : '' }}
    </div>
</div>

<script>
function searchStudents() {
    const searchTerm = document.getElementById('studentSearch').value.toLowerCase();
    const rows = document.querySelectorAll('.student-row');
    
    rows.forEach(row => {
        const name = row.dataset.name;
        const id = row.dataset.id;
        
        if (name.includes(searchTerm) || id.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Search on Enter key
document.getElementById('studentSearch').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchStudents();
    }
});

// Real-time search
document.getElementById('studentSearch').addEventListener('input', searchStudents);
</script>
@endsection
