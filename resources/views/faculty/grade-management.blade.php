@extends('layouts.faculty')

@section('page-title', 'Grade Management')

@section('content')
@isset($faculty)
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-xl font-semibold text-uc-green mb-2">Students with Incomplete Grades</h2>
        <p class="text-gray-600">Manage student grades for INC, NFE, and NG subjects</p>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex gap-4">
            <input type="text" 
                   id="searchInput" 
                   placeholder="Search by name or ID..." 
                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-uc-green focus:border-transparent">
            <button type="button" 
                    id="searchBtn"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Search
            </button>
        </div>
    </div>

    <!-- Students Table -->
    @if($studentsWithIncompleteGrades->count() > 0)
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-medium text-gray-700">NAME</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700">ID NUMBER</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700">MAJOR</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-700">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    @foreach($studentsWithIncompleteGrades as $student)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 student-row" 
                        data-name="{{ strtolower($student->name) }}" 
                        data-id="{{ strtolower($student->student_id) }}">
                        <td class="py-4 px-4">
                            <div class="font-medium text-gray-800">{{ $student->name }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="text-gray-600">{{ $student->student_id }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="text-gray-600">
                                {{ $student->course }}
                                @if($student->track)
                                    <span class="text-blue-600">/ {{ $student->track }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <button type="button" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition-colors duration-200 view-grades-btn"
                                    data-student-id="{{ $student->id }}">
                                <i class="fas fa-eye mr-1"></i> View
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-sm text-gray-600">
            Showing {{ $studentsWithIncompleteGrades->count() }} students
        </div>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="text-center py-8">
            <i class="fas fa-chart-line text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-800 mb-2">No Incomplete Grades Found</h3>
            <p class="text-gray-600">
                There are currently no students with INC, NFE, or NG grades that require attention.
            </p>
        </div>
    </div>
    @endif

    <!-- Grade Management Modal -->
    <div id="gradeModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800" id="modalStudentName">Student Grades</h3>
                            <p class="text-sm text-gray-600" id="modalStudentInfo">Student Information</p>
                        </div>
                        <button type="button" 
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200" 
                                onclick="closeGradeModal()">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Grades List -->
                    <div id="gradesList" class="space-y-4">
                        <!-- Grades will be loaded here via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@else
    <div class="bg-red-50 border border-red-200 rounded-lg p-6">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
            <div>
                <h3 class="text-lg font-medium text-red-800">Access Denied</h3>
                <p class="text-red-600">Please log in as a faculty member to access this page.</p>
            </div>
        </div>
    </div>
@endisset

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const studentRows = document.querySelectorAll('.student-row');

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        studentRows.forEach(row => {
            const name = row.dataset.name;
            const id = row.dataset.id;
            
            if (name.includes(searchTerm) || id.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Update count
        const visibleRows = Array.from(studentRows).filter(row => row.style.display !== 'none');
        const countElement = document.querySelector('.mt-4.text-sm.text-gray-600');
        if (countElement) {
            countElement.textContent = `Showing ${visibleRows.length} students`;
        }
    }

    searchBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    // View grades functionality
    document.querySelectorAll('.view-grades-btn').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.dataset.studentId;
            loadStudentGrades(studentId);
        });
    });
});

function loadStudentGrades(studentId) {
    fetch(`/faculty/grade-management/${studentId}/grades`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayGradeModal(data.student, data.grades);
            } else {
                showAlert('error', 'Failed to load student grades.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred while loading grades.');
        });
}

function displayGradeModal(student, grades) {
    document.getElementById('modalStudentName').textContent = student.name;
    document.getElementById('modalStudentInfo').textContent = `ID: ${student.student_id} | Course: ${student.course}${student.track ? ' / ' + student.track : ''}`;
    
    const gradesList = document.getElementById('gradesList');
    gradesList.innerHTML = '';
    
    grades.forEach(grade => {
        const gradeItem = document.createElement('div');
        gradeItem.className = 'bg-gray-50 rounded-lg p-4 flex items-center justify-between';
        gradeItem.innerHTML = `
            <div class="flex items-center gap-4">
                <div>
                    <h5 class="font-medium text-gray-800">${grade.subject.code}</h5>
                    <p class="text-sm text-gray-600">${grade.subject.description}</p>
                </div>
                <div class="text-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        ${grade.grade === 'INC' ? 'bg-yellow-100 text-yellow-800' : 
                          grade.grade === 'NFE' ? 'bg-red-100 text-red-800' : 
                          'bg-purple-100 text-purple-800'}">
                        ${grade.grade}
                    </span>
                </div>
                <div class="text-sm text-gray-500">
                    Units: ${grade.subject.units}
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700">New Grade:</label>
                    <input type="number" 
                           class="numeric-grade-input border border-gray-300 rounded-md px-3 py-1 text-sm w-20 focus:outline-none focus:ring-2 focus:ring-uc-green focus:border-transparent"
                           data-student-id="${student.id}" 
                           data-subject-id="${grade.subject.id}"
                           placeholder="1-100"
                           min="1" 
                           max="100">
                </div>
                <button type="button" 
                        class="update-grade-btn bg-uc-green text-white px-4 py-1 rounded-md text-sm hover:bg-green-700 transition-colors duration-200"
                        data-student-id="${student.id}" 
                        data-subject-id="${grade.subject.id}">
                    Update
                </button>
            </div>
        `;
        gradesList.appendChild(gradeItem);
    });
    
    // Add event listeners to new update buttons
    gradesList.querySelectorAll('.update-grade-btn').forEach(button => {
        button.addEventListener('click', handleGradeUpdate);
    });
    
    document.getElementById('gradeModal').classList.remove('hidden');
}

function closeGradeModal() {
    document.getElementById('gradeModal').classList.add('hidden');
}

function handleGradeUpdate() {
    const studentId = this.dataset.studentId;
    const subjectId = this.dataset.subjectId;
    const numericInput = document.querySelector(`input[data-student-id="${studentId}"][data-subject-id="${subjectId}"]`);
    
    const gradeValue = numericInput.value.trim();
    
    if (!gradeValue) {
        alert('Please enter a grade (1-100).');
        return;
    }
    
    const numericValue = parseInt(gradeValue);
    if (numericValue < 1 || numericValue > 100) {
        alert('Grade must be between 1 and 100.');
        return;
    }
    
    // Disable button while processing
    this.disabled = true;
    this.textContent = 'Updating...';
    
    // Prepare CSRF token
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch('{{ route("faculty.grade-management.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            student_id: studentId,
            subject_id: subjectId,
            new_grade: gradeValue
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            // Refresh the modal and main page
            setTimeout(() => {
                closeGradeModal();
                window.location.reload();
            }, 1500);
        } else {
            showAlert('error', data.message);
            this.disabled = false;
            this.textContent = 'Update';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred while updating the grade.');
        this.disabled = false;
        this.textContent = 'Update';
    });
}

function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
        type === 'success' ? 'bg-green-100 border border-green-200 text-green-800' : 'bg-red-100 border border-red-200 text-red-800'
    }`;
    alertDiv.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
</script>
@endsection
