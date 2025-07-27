@extends('layouts.faculty')

@section('page-title', 'Grade Management')

@section('content')
@isset($faculty)
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-xl font-semibold text-uc-green mb-2">Grade Management - Dean Approved Applications</h2>
        <p class="text-gray-600">Edit grades for subjects approved by the dean for grade completion</p>
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
                        <th class="text-center py-3 px-4 font-medium text-gray-700">APPROVED SUBJECTS</th>
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
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ $student->gradeCompletionApplications->where('dean_status', 'approved')->count() }} subjects
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <button type="button" 
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 edit-grades-btn"
                                    data-student-id="{{ $student->id }}">
                                <i class="fas fa-edit mr-1"></i> Edit
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
            <h3 class="text-lg font-medium text-gray-800 mb-2">No Dean-Approved Applications Found</h3>
            <p class="text-gray-600">
                There are currently no students with dean-approved grade completion applications that require grade editing.
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
                            <h3 class="text-lg font-semibold text-gray-800" id="modalStudentName">Edit Student Grades</h3>
                            <p class="text-sm text-gray-600" id="modalStudentInfo">Student Information</p>
                        </div>
                        <button type="button" 
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200" 
                                onclick="closeGradeModal()">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Applications List -->
                    <div id="gradesList" class="space-y-4">
                        <!-- Grade completion applications will be loaded here via JavaScript -->
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

    // Edit grades functionality
    document.querySelectorAll('.edit-grades-btn').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.dataset.studentId;
            loadStudentApplications(studentId);
        });
    });
});

function loadStudentApplications(studentId) {
    fetch(`/faculty/grade-management/${studentId}/grades`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayGradeModal(data.student, data.applications);
            } else {
                showAlert('error', 'Failed to load student applications.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred while loading applications.');
        });
}

function displayGradeModal(student, applications) {
    document.getElementById('modalStudentName').textContent = `${student.name} - Grade Editing`;
    document.getElementById('modalStudentInfo').textContent = `ID: ${student.student_id} | Course: ${student.course}${student.track ? ' / ' + student.track : ''}`;
    
    const gradesList = document.getElementById('gradesList');
    gradesList.innerHTML = '';
    
    if (applications.length === 0) {
        gradesList.innerHTML = `
            <div class="text-center py-8">
                <i class="fas fa-info-circle text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-800 mb-2">No Approved Applications</h3>
                <p class="text-gray-600">This student has no dean-approved grade completion applications.</p>
            </div>
        `;
        document.getElementById('gradeModal').classList.remove('hidden');
        return;
    }
    
    applications.forEach(application => {
        const gradeItem = document.createElement('div');
        gradeItem.className = 'bg-gray-50 rounded-lg p-4 border border-gray-200';
        
        const isCompleted = application.faculty_status === 'completed';
        const deadlineStatus = application.completion_deadline ? getDeadlineStatus(application.completion_deadline) : null;
        
        gradeItem.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <div>
                        <h5 class="font-medium text-gray-800">${application.subject.code}</h5>
                        <p class="text-sm text-gray-600">${application.subject.description}</p>
                        <p class="text-xs text-gray-500">Units: ${application.subject.units}</p>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-600 mb-1">Current Grade</div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            ${application.current_grade === 'INC' ? 'bg-yellow-100 text-yellow-800' : 
                              application.current_grade === 'NFE' ? 'bg-red-100 text-red-800' : 
                              'bg-purple-100 text-purple-800'}">
                            ${application.current_grade}
                        </span>
                    </div>
                    ${application.completion_deadline ? `
                        <div class="text-center">
                            <div class="text-sm text-gray-600 mb-1">Deadline</div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${deadlineStatus.class}">
                                ${application.completion_deadline}
                            </span>
                        </div>
                    ` : ''}
                </div>
                
                ${isCompleted ? `
                    <div class="text-center">
                        <div class="text-sm text-gray-600 mb-1">Final Grade</div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            ${application.final_grade}
                        </span>
                        <div class="text-xs text-gray-500 mt-1">Completed</div>
                    </div>
                ` : `
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <label class="text-sm font-medium text-gray-700">Final Grade:</label>
                            <input type="number" 
                                   class="final-grade-input border border-gray-300 rounded-md px-3 py-2 text-sm w-24 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   data-application-id="${application.id}"
                                   placeholder="1-100"
                                   min="1" 
                                   max="100">
                        </div>
                        <button type="button" 
                                class="update-grade-btn bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition-colors duration-200"
                                data-application-id="${application.id}">
                            <i class="fas fa-save mr-1"></i> Save Grade
                        </button>
                    </div>
                `}
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

function getDeadlineStatus(deadlineString) {
    const deadline = new Date(deadlineString);
    const now = new Date();
    const diffDays = Math.ceil((deadline - now) / (1000 * 60 * 60 * 24));
    
    if (diffDays < 0) {
        return { class: 'bg-red-100 text-red-800' };
    } else if (diffDays <= 7) {
        return { class: 'bg-orange-100 text-orange-800' };
    } else {
        return { class: 'bg-green-100 text-green-800' };
    }
}

function closeGradeModal() {
    document.getElementById('gradeModal').classList.add('hidden');
}

function handleGradeUpdate() {
    const applicationId = this.dataset.applicationId;
    const gradeInput = document.querySelector(`input[data-application-id="${applicationId}"]`);
    
    const gradeValue = gradeInput.value.trim();
    
    if (!gradeValue) {
        alert('Please enter a final grade (1-100).');
        return;
    }
    
    const numericValue = parseInt(gradeValue);
    if (numericValue < 1 || numericValue > 100) {
        alert('Grade must be between 1 and 100.');
        return;
    }
    
    // Disable button while processing
    this.disabled = true;
    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Saving...';
    
    // Prepare CSRF token
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch('{{ route("faculty.grade-management.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            application_id: applicationId,
            final_grade: gradeValue
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
            this.innerHTML = '<i class="fas fa-save mr-1"></i> Save Grade';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred while updating the grade.');
        this.disabled = false;
        this.innerHTML = '<i class="fas fa-save mr-1"></i> Save Grade';
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
