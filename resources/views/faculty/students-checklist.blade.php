@extends('layouts.faculty')

@section('page-title', 'Students\' Checklist')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Students Checklist</h1>
    
    <!-- Search Section -->
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    id="studentSearch"
                    placeholder="Search by name or ID..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
            <button 
                onclick="searchStudents()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200"
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
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">NAME</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">ID NUMBER</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">MAJOR</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">ACTIONS</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
                @forelse($students as $student)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200 student-row" 
                        data-name="{{ strtolower($student->name) }}" 
                        data-id="{{ strtolower($student->student_id) }}">
                        <td class="py-3 px-4">
                            <div class="font-medium text-gray-900">{{ $student->name }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="text-gray-700">{{ $student->student_id }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="text-gray-700">
                                @if($student->course === 'BSIT')
                                    BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY
                                @else
                                    {{ $student->course ?? 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY' }}
                                @endif
                                @if($student->track)
                                    <span class="text-blue-600">/{{ str_replace('Track', 'Track', $student->track) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <a 
                                href="{{ route('faculty.student-checklist-detail', $student->id) }}"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                            >
                                View Checklist
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 px-4 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-users text-4xl text-gray-300 mb-2"></i>
                                <p>No students found</p>
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
