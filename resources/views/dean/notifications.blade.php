@extends('layouts.dean')

@section('page-title', 'Notifications')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Notifications</h1>
            <p class="text-gray-600">Admin reminders and other important notifications</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                @if($unreadCount > 0)
                    <button onclick="showMarkAllReadModal()" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-check-double mr-2"></i>Mark All Read ({{ $unreadCount }})
                    </button>
                @endif
                <button onclick="refreshNotifications()" 
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-sync mr-2"></i>Refresh
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notifications List -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    @if($notifications->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($notifications as $notification)
            <div class="p-6 {{ !$notification->is_read ? 'bg-blue-50 border-l-4 border-l-blue-500' : 'hover:bg-gray-50' }} transition-colors duration-200" 
                 id="notification-{{ $notification->id }}">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4 flex-1">
                        <!-- Notification Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $notification->getBadgeClass() }}">
                                <i class="{{ $notification->getIconClass() }}"></i>
                            </div>
                        </div>
                        
                        <!-- Notification Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                <!-- Type Badge -->
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $notification->getBadgeClass() }}">
                                    @if($notification->getUrgencyLevel() === 'high')
                                        <i class="fas fa-exclamation-triangle mr-1"></i>URGENT
                                    @elseif($notification->getUrgencyLevel() === 'medium')
                                        <i class="fas fa-clock mr-1"></i>IMPORTANT
                                    @else
                                        <i class="fas fa-info-circle mr-1"></i>INFO
                                    @endif
                                </span>
                                
                                <!-- Type Label -->
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $notification->getTypeLabel() }}
                                </span>
                                
                                <!-- Read Status -->
                                @if(!$notification->is_read)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>New
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Message -->
                            <p class="text-gray-800 mb-3 leading-relaxed">{{ $notification->message }}</p>
                            
                            <!-- Application Details -->
                            @if($notification->application)
                                <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <span class="text-sm font-medium text-gray-600">Student:</span>
                                            <p class="text-sm text-gray-900 font-medium">{{ $notification->application->student->name ?? 'Unknown' }}</p>
                                            <p class="text-xs text-gray-500">{{ $notification->application->student->student_id ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-600">Subject:</span>
                                            <p class="text-sm text-gray-900 font-medium">{{ $notification->application->subject->code ?? 'Unknown' }}</p>
                                            <p class="text-xs text-gray-500">{{ $notification->application->subject->name ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-600">Sent by:</span>
                                            <p class="text-sm text-gray-900 font-medium">{{ $notification->sentBy->name ?? 'System' }}</p>
                                            <p class="text-xs text-gray-500">{{ $notification->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Metadata Information -->
                            @if($notification->metadata)
                                <div class="text-sm text-gray-500 mb-3">
                                    @if(isset($notification->metadata['reminder_type']))
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-tag mr-1"></i>
                                            Type: {{ ucfirst(str_replace('_', ' ', $notification->metadata['reminder_type'])) }}
                                        </span>
                                    @endif
                                    @if(isset($notification->metadata['application_created']))
                                        <span class="inline-flex items-center ml-4">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            Applied: {{ \Carbon\Carbon::parse($notification->metadata['application_created'])->format('M d, Y') }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col space-y-2 ml-4">
                        @if(!$notification->is_read)
                            <button onclick="markAsRead({{ $notification->id }})" 
                                    class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center">
                                <i class="fas fa-check mr-1"></i>Mark Read
                            </button>
                        @endif
                        
                        @if($notification->application)
                            <a href="{{ route('dean.grade-completion-applications.details', $notification->application->id) }}" 
                               class="text-green-600 hover:text-green-700 text-sm font-medium flex items-center">
                                <i class="fas fa-eye mr-1"></i>View Application
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t">
            {{ $notifications->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No notifications</h3>
            <p class="text-gray-500 mb-6">You don't have any notifications at the moment.</p>
            <a href="{{ route('dean.dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
            </a>
        </div>
    @endif
</div>

<!-- Simple Mark All Read Confirmation Modal -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50" id="markAllReadModal">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check-double text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Mark all notifications as read?</h3>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-4">
                <p class="text-sm text-gray-600 mb-4">
                    You are about to mark <span class="font-medium text-gray-900" id="unreadCountText">{{ $unreadCount }}</span> 
                    notification{{ $unreadCount != 1 ? 's' : '' }} as read. This action cannot be undone.
                </p>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        <span class="text-sm text-blue-800">All unread notifications will be marked as read and removed from your notification count.</span>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
                <button type="button" onclick="hideMarkAllReadModal()" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </button>
                <button type="button" onclick="confirmMarkAllRead()" 
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200"
                        id="confirmButton">
                    <span id="confirmText">Mark All as Read</span>
                    <i class="fas fa-spinner fa-spin ml-2 hidden" id="loadingSpinner"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function markAsRead(notificationId) {
    const notification = document.getElementById('notification-' + notificationId);
    
    fetch(`/dean/notifications/${notificationId}/mark-read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove blue background and border
            notification.classList.remove('bg-blue-50', 'border-l-4', 'border-l-blue-500');
            notification.classList.add('hover:bg-gray-50');
            
            // Remove "New" badge and read button
            const newBadge = notification.querySelector('.bg-blue-100.text-blue-800');
            if (newBadge && newBadge.textContent.includes('New')) {
                newBadge.remove();
            }
            
            const readButton = notification.querySelector('[onclick^="markAsRead"]');
            if (readButton) {
                readButton.remove();
            }
        } else {
            alert('Failed to mark notification as read: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to mark notification as read');
    });
}

function showMarkAllReadModal() {
    document.getElementById('markAllReadModal').classList.remove('hidden');
}

function hideMarkAllReadModal() {
    document.getElementById('markAllReadModal').classList.add('hidden');
    
    // Reset button state
    const confirmButton = document.getElementById('confirmButton');
    const confirmText = document.getElementById('confirmText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    confirmButton.disabled = false;
    confirmText.textContent = 'Mark All as Read';
    loadingSpinner.classList.add('hidden');
}

function confirmMarkAllRead() {
    const confirmButton = document.getElementById('confirmButton');
    const confirmText = document.getElementById('confirmText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    // Show loading state
    confirmButton.disabled = true;
    confirmText.textContent = 'Processing...';
    loadingSpinner.classList.remove('hidden');
    
    fetch('/dean/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success state briefly
            confirmText.textContent = 'Success!';
            loadingSpinner.classList.add('hidden');
            
            // Reload page after short delay
            setTimeout(() => {
                location.reload();
            }, 800);
        } else {
            alert('Failed to mark all notifications as read: ' + data.message);
            hideMarkAllReadModal();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to mark all notifications as read');
        hideMarkAllReadModal();
    });
}

function refreshNotifications() {
    location.reload();
}

// Close modal when clicking outside
document.getElementById('markAllReadModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideMarkAllReadModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideMarkAllReadModal();
    }
});
</script>
@endpush
@endsection
