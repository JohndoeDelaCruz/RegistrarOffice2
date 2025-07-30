@extends('layouts.admin')

@section('page-title', 'System Logs')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">System Logs</h1>
            <p class="text-gray-600">Monitor system activities and user interactions</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <button onclick="clearOldLogs()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>Clear Old Logs
                </button>
                <button onclick="exportLogs()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>Export Logs
                </button>
                <button onclick="refreshLogs()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-sync mr-2"></i>Refresh
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Activity Overview -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">System Errors</h3>
                <p class="text-3xl font-bold text-red-600">{{ $systemErrors }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-red-600 font-medium">3 new</span>
            <span class="text-sm text-gray-500 ml-1">in last hour</span>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">File Operations</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $fileOperations }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-file-alt text-purple-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Documents processed today</span>
        </div>
    </div>
</div>

<!-- Log Filters -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Logs</label>
            <div class="relative">
                <input type="text" placeholder="Search activities..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">User Role</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Roles</option>
                <option value="admin">Admin</option>
                <option value="dean">Dean</option>
                <option value="faculty">Faculty</option>
                <option value="student">Student</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Activity Type</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Activities</option>
                <option value="login">Login</option>
                <option value="logout">Logout</option>
                <option value="approval">Document Approval</option>
                <option value="file_upload">File Upload</option>
                <option value="grade_entry">Grade Entry</option>
                <option value="user_creation">User Creation</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Time Period</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Time</option>
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
                <option value="custom">Custom Range</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Actions</label>
            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-undo mr-2"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- System Logs Table -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Timestamp
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        User
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Activity
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Details
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($logs as $index => $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($log['timestamp'])
                            <div>{{ $log['timestamp']->format('M j, Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $log['timestamp']->format('g:i:s A') }}</div>
                        @else
                            <div>N/A</div>
                            <div class="text-xs text-gray-400">No timestamp</div>
                        @endif
                        <div class="text-xs text-blue-500 mt-1">
                            Page {{ $pagination['current_page'] }} - Item {{ $pagination['from'] + $index }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-{{ $log['role_color'] }}-100 p-2 rounded-full mr-3">
                                <i class="fas fa-{{ $log['role_icon'] }} text-{{ $log['role_color'] }}-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $log['user_name'] }}</div>
                                <div class="text-sm text-gray-500">{{ ucfirst($log['user_role']) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $log['activity_color'] }}-100 text-{{ $log['activity_color'] }}-800">
                            <i class="fas fa-{{ $log['activity_icon'] }} mr-1"></i>
                            {{ $log['activity_type'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $log['description'] }}</div>
                        @if($log['additional_info'])
                        <div class="text-sm text-gray-500">{{ $log['additional_info'] }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($log['status'] === 'success')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Success
                            </span>
                        @elseif($log['status'] === 'failed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>Failed
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-list-alt text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No logs found</p>
                        <p>System activities will appear here as they occur</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if(isset($pagination['has_pages']) && $pagination['has_pages'])
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-sm text-gray-700">
                    @if($pagination['total'] > 0)
                        Showing {{ $pagination['from'] }} to {{ $pagination['to'] }} of {{ $pagination['total'] }} logs
                    @else
                        No logs found
                    @endif
                </span>
            </div>
            <div class="flex items-center space-x-2">
                @if($pagination['current_page'] > 1)
                    <a href="{{ request()->url() }}?page={{ $pagination['current_page'] - 1 }}" 
                       class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Previous
                    </a>
                @else
                    <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        Previous
                    </span>
                @endif
                
                @php
                    $start = max(1, $pagination['current_page'] - 2);
                    $end = min($pagination['last_page'], $pagination['current_page'] + 2);
                @endphp
                
                @if($start > 1)
                    <a href="{{ request()->url() }}?page=1" 
                       class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        1
                    </a>
                    @if($start > 2)
                        <span class="px-3 py-1 text-sm text-gray-500">...</span>
                    @endif
                @endif
                
                @for($i = $start; $i <= $end; $i++)
                    @if($i == $pagination['current_page'])
                        <span class="px-3 py-1 text-sm text-white bg-blue-600 border border-blue-600 rounded-md">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ request()->url() }}?page={{ $i }}" 
                           class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
                
                @if($end < $pagination['last_page'])
                    @if($end < $pagination['last_page'] - 1)
                        <span class="px-3 py-1 text-sm text-gray-500">...</span>
                    @endif
                    <a href="{{ request()->url() }}?page={{ $pagination['last_page'] }}" 
                       class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        {{ $pagination['last_page'] }}
                    </a>
                @endif
                
                @if($pagination['current_page'] < $pagination['last_page'])
                    <a href="{{ request()->url() }}?page={{ $pagination['current_page'] + 1 }}" 
                       class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        Next
                    </span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Log Statistics -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Activity Breakdown (Last 24 Hours)</h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                    <span class="text-sm text-gray-600">User Logins</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-800 mr-2">45</span>
                    <div class="w-16 bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                    <span class="text-sm text-gray-600">Document Approvals</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-800 mr-2">23</span>
                    <div class="w-16 bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 35%"></div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                    <span class="text-sm text-gray-600">Grade Entries</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-800 mr-2">12</span>
                    <div class="w-16 bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: 18%"></div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                    <span class="text-sm text-gray-600">File Uploads</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-800 mr-2">8</span>
                    <div class="w-16 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 12%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Security Alerts</h3>
        <div class="space-y-3">
            <div class="flex items-start p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                <div class="bg-yellow-100 p-2 rounded-full mr-3">
                    <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-yellow-800">Multiple Login Attempts</p>
                    <p class="text-sm text-yellow-700">User 'student123' had 5 failed login attempts</p>
                    <p class="text-xs text-yellow-600 mt-1">2 minutes ago</p>
                </div>
            </div>
            <div class="flex items-start p-3 bg-red-50 border-l-4 border-red-400 rounded">
                <div class="bg-red-100 p-2 rounded-full mr-3">
                    <i class="fas fa-shield-alt text-red-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-red-800">Suspicious IP Address</p>
                    <p class="text-sm text-red-700">Login from unknown location: 192.168.1.100</p>
                    <p class="text-xs text-red-600 mt-1">15 minutes ago</p>
                </div>
            </div>
            <div class="flex items-start p-3 bg-blue-50 border-l-4 border-blue-400 rounded">
                <div class="bg-blue-100 p-2 rounded-full mr-3">
                    <i class="fas fa-info-circle text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-blue-800">System Update</p>
                    <p class="text-sm text-blue-700">Database backup completed successfully</p>
                    <p class="text-xs text-blue-600 mt-1">1 hour ago</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // CSRF Token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    // Clear Old Logs functionality
    function clearOldLogs() {
        if (confirm('Are you sure you want to clear old logs? This action cannot be undone.')) {
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            
            // Show loading state
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Clearing...';
            button.disabled = true;
            
            fetch('{{ route("admin.system-logs.clear") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    days_old: 30 // Clear logs older than 30 days
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Old logs cleared successfully!', 'success');
                    // Refresh the page to show updated logs
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showNotification(data.message || 'Error clearing logs', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error clearing logs', 'error');
            })
            .finally(() => {
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }
    }

    // Export Logs functionality
    function exportLogs() {
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        
        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
        button.disabled = true;
        
        fetch('{{ route("admin.system-logs.export") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                format: 'csv', // Can be 'csv', 'excel', 'pdf'
                date_range: 'all'
            })
        })
        .then(response => {
            if (response.ok) {
                return response.blob();
            }
            throw new Error('Export failed');
        })
        .then(blob => {
            // Create download link
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            // Use Philippines timezone for filename
            const now = new Date();
            const philippinesDate = new Intl.DateTimeFormat('en-CA', {
                timeZone: 'Asia/Manila',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            }).format(now);
            a.download = `system-logs-${philippinesDate}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
            
            showNotification('Logs exported successfully!', 'success');
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error exporting logs', 'error');
        })
        .finally(() => {
            // Restore button state
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }

    // Refresh Logs functionality
    function refreshLogs() {
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        
        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Refreshing...';
        button.disabled = true;
        
        showNotification('Refreshing logs...', 'info');
        
        // Reload the page to get fresh data
        setTimeout(() => {
            window.location.reload();
        }, 500);
    }

    // Notification helper function
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transition-all duration-300 ${getNotificationClasses(type)}`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${getNotificationIcon(type)} mr-2"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }

    function getNotificationClasses(type) {
        switch (type) {
            case 'success':
                return 'bg-green-600 text-white';
            case 'error':
                return 'bg-red-600 text-white';
            case 'warning':
                return 'bg-yellow-600 text-white';
            case 'info':
            default:
                return 'bg-blue-600 text-white';
        }
    }

    function getNotificationIcon(type) {
        switch (type) {
            case 'success':
                return 'check-circle';
            case 'error':
                return 'exclamation-circle';
            case 'warning':
                return 'exclamation-triangle';
            case 'info':
            default:
                return 'info-circle';
        }
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('System Logs page loaded');
    });
</script>
@endpush
