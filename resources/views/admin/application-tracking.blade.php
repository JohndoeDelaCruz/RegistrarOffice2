@extends('layouts.admin')

@section('page-title', 'Application Tracking')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Application Tracking</h1>
            <p class="text-gray-600">Monitor and track all grade completion applications</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-sync mr-2"></i>Refresh
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Status Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Pending Review</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ $pendingApplications }}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Awaiting dean approval</span>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Approved</h3>
                <p class="text-3xl font-bold text-green-600">{{ $approvedApplications }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Dean approved applications</span>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Rejected</h3>
                <p class="text-3xl font-bold text-red-600">{{ $rejectedApplications }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Rejected by dean</span>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <form method="GET" action="{{ route('admin.application-tracking') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Applications</label>
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name or ID..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status Filter</label>
            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
            <select name="date_range" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Time</option>
                <option value="today" {{ request('date_range') === 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date_range') === 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date_range') === 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ request('date_range') === 'year' ? 'selected' : '' }}>This Year</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Actions</label>
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <a href="{{ route('admin.application-tracking') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200 inline-flex items-center">
                    <i class="fas fa-undo mr-2"></i>Reset
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Applications Table -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Student
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Subject
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Current Grade
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Submitted
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Dean Review
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($applications as $application)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                <i class="fas fa-user-graduate text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->student->name }}</div>
                                <div class="text-sm text-gray-500">{{ $application->student->student_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $application->subject->code }}</div>
                        <div class="text-sm text-gray-500">{{ $application->subject->description }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $application->current_grade }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        <div>{{ $application->created_at->format('M j, Y') }}</div>
                        <div class="text-xs">{{ $application->created_at->format('g:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($application->dean_status === null || $application->dean_status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @elseif($application->dean_status === 'approved')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Approved
                            </span>
                        @elseif($application->dean_status === 'rejected')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>Rejected
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        @if($application->dean_reviewed_at)
                            <div>{{ $application->dean_reviewed_at->format('M j, Y') }}</div>
                            <div class="text-xs">{{ $application->dean_reviewed_at->format('g:i A') }}</div>
                        @else
                            <span class="text-gray-400">Not reviewed</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.applications.view', $application->id) }}" 
                               class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                               title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($application->dean_status === null || $application->dean_status === 'pending')
                                <button onclick="openReminderModal({{ $application->id }}, '{{ $application->student->name }}', '{{ $application->subject->code }}')" 
                                        class="text-orange-600 hover:text-orange-900 transition-colors duration-200" 
                                        title="Send Reminder">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button onclick="openReminderHistoryModal({{ $application->id }})" 
                                        class="text-gray-600 hover:text-gray-900 transition-colors duration-200" 
                                        title="View Reminder History">
                                    <i class="fas fa-history"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-file-signature text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No applications found</p>
                        <p>Applications will appear here when students submit grade completion requests</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($applications->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $applications->links() }}
    </div>
    @endif
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Processing Time</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Average Review Time:</span>
                <span class="text-sm font-medium text-gray-800">2.3 days</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Fastest Review:</span>
                <span class="text-sm font-medium text-gray-800">4 hours</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Longest Review:</span>
                <span class="text-sm font-medium text-gray-800">7 days</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Grade Distribution</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">INC (Incomplete):</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('current_grade', 'INC')->count() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">NFE (No Final Exam):</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('current_grade', 'NFE')->count() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">NG (No Grade):</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('current_grade', 'NG')->count() }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Today:</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('created_at', '>=', today())->count() }} new</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">This Week:</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('created_at', '>=', now()->startOfWeek())->count() }} new</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">This Month:</span>
                <span class="text-sm font-medium text-gray-800">{{ $applications->where('created_at', '>=', now()->startOfMonth())->count() }} new</span>
            </div>
        </div>
    </div>
</div>

<!-- Send Reminder Modal -->
<div id="reminderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
            <!-- Modal Header -->
            <div class="bg-orange-600 text-white px-6 py-4 rounded-t-lg flex items-center justify-between">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-bell mr-2"></i>
                    Send Reminder
                </h2>
                <button onclick="closeReminderModal()" class="text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-gray-700 mb-2">Send a reminder about this application:</p>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-user-graduate text-blue-600 mr-2"></i>
                            <span class="font-medium" id="reminderStudentName"></span>
                        </div>
                        <div class="flex items-center mt-1">
                            <i class="fas fa-book text-purple-600 mr-2"></i>
                            <span id="reminderSubjectCode"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reminder Type</label>
                    <select id="reminderType" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="pending_review">Pending Review</option>
                        <option value="overdue">Overdue</option>
                        <option value="follow_up">Follow Up</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message (Optional)</label>
                    <textarea id="reminderMessage" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                              placeholder="Please review the pending grade completion application..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button onclick="closeReminderModal()" 
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Cancel
                    </button>
                    <button onclick="sendReminder()" 
                            class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors duration-200">
                        <i class="fas fa-paper-plane mr-2"></i>Send Reminder
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reminder History Modal -->
<div id="reminderHistoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[80vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="bg-gray-600 text-white px-6 py-4 rounded-t-lg flex items-center justify-between">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-history mr-2"></i>
                    Reminder History
                </h2>
                <button onclick="closeReminderHistoryModal()" class="text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <div id="reminderHistoryContent">
                    <div class="flex items-center justify-center py-8">
                        <i class="fas fa-spinner fa-spin text-2xl text-gray-500 mr-3"></i>
                        <span class="text-gray-600">Loading reminder history...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentApplicationId = null;

function openReminderModal(applicationId, studentName, subjectCode) {
    currentApplicationId = applicationId;
    document.getElementById('reminderStudentName').textContent = studentName;
    document.getElementById('reminderSubjectCode').textContent = subjectCode;
    document.getElementById('reminderType').value = 'pending_review';
    document.getElementById('reminderMessage').value = '';
    document.getElementById('reminderModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeReminderModal() {
    document.getElementById('reminderModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    currentApplicationId = null;
}

function sendReminder() {
    if (!currentApplicationId) return;

    const type = document.getElementById('reminderType').value;
    const message = document.getElementById('reminderMessage').value || 'Please review the pending grade completion application.';

    // Show loading state
    const sendButton = event.target;
    const originalText = sendButton.innerHTML;
    sendButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
    sendButton.disabled = true;

    fetch(`/admin/applications/${currentApplicationId}/send-reminder`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            type: type,
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        sendButton.innerHTML = originalText;
        sendButton.disabled = false;

        if (data.success) {
            alert('✅ ' + data.message);
            closeReminderModal();
        } else {
            alert('❌ ' + data.message);
        }
    })
    .catch(error => {
        sendButton.innerHTML = originalText;
        sendButton.disabled = false;
        console.error('Error:', error);
        alert('❌ Failed to send reminder. Please try again.');
    });
}

function openReminderHistoryModal(applicationId) {
    document.getElementById('reminderHistoryModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Load reminder history
    loadReminderHistory(applicationId);
}

function closeReminderHistoryModal() {
    document.getElementById('reminderHistoryModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function loadReminderHistory(applicationId) {
    const content = document.getElementById('reminderHistoryContent');
    content.innerHTML = `
        <div class="flex items-center justify-center py-8">
            <i class="fas fa-spinner fa-spin text-2xl text-gray-500 mr-3"></i>
            <span class="text-gray-600">Loading reminder history...</span>
        </div>
    `;

    fetch(`/admin/applications/${applicationId}/reminder-history`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayReminderHistory(data.reminders);
        } else {
            content.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-3xl mb-4"></i>
                    <p class="text-gray-600">Failed to load reminder history.</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        content.innerHTML = `
            <div class="text-center py-8">
                <i class="fas fa-exclamation-triangle text-red-500 text-3xl mb-4"></i>
                <p class="text-gray-600">Error loading reminder history.</p>
            </div>
        `;
    });
}

function displayReminderHistory(reminders) {
    const content = document.getElementById('reminderHistoryContent');
    
    if (reminders.length === 0) {
        content.innerHTML = `
            <div class="text-center py-8">
                <i class="fas fa-bell-slash text-gray-400 text-3xl mb-4"></i>
                <p class="text-gray-600">No reminders sent for this application yet.</p>
            </div>
        `;
        return;
    }

    const historyHtml = reminders.map(reminder => `
        <div class="border border-gray-200 rounded-lg p-4 mb-4">
            <div class="flex items-start justify-between mb-2">
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                        ${reminder.type === 'pending_review' ? 'bg-yellow-100 text-yellow-800' : 
                          reminder.type === 'overdue' ? 'bg-red-100 text-red-800' : 
                          'bg-blue-100 text-blue-800'}">
                        ${reminder.type.replace('_', ' ').toUpperCase()}
                    </span>
                    ${reminder.is_read ? '<i class="fas fa-eye text-green-500 ml-2" title="Read"></i>' : '<i class="fas fa-eye-slash text-gray-400 ml-2" title="Unread"></i>'}
                </div>
                <span class="text-sm text-gray-500">${reminder.created_at}</span>
            </div>
            <p class="text-gray-700 mb-2">${reminder.message}</p>
            <div class="text-sm text-gray-500">
                <span>From: <strong>${reminder.sent_by}</strong> → To: <strong>${reminder.sent_to}</strong></span>
                ${reminder.read_at ? `<br>Read: ${reminder.read_at}` : ''}
            </div>
        </div>
    `).join('');

    content.innerHTML = historyHtml;
}

// Close modals when clicking outside
document.getElementById('reminderModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeReminderModal();
    }
});

document.getElementById('reminderHistoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeReminderHistoryModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!document.getElementById('reminderModal').classList.contains('hidden')) {
            closeReminderModal();
        }
        if (!document.getElementById('reminderHistoryModal').classList.contains('hidden')) {
            closeReminderHistoryModal();
        }
    }
});
</script>

@endsection
