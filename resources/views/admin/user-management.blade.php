@extends('layouts.admin')

@section('page-title', 'User Management')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">User Management</h1>
        <p class="text-gray-600">Manage all system users and their access levels</p>
    </div>
</div>

<!-- Search and Filters -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <form method="GET" action="{{ route('admin.user-management') }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search Users</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search by name, email, or ID..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Role</label>
                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Roles</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Students</option>
                    <option value="faculty" {{ request('role') == 'faculty' ? 'selected' : '' }}>Faculty</option>
                    <option value="dean" {{ request('role') == 'dean' ? 'selected' : '' }}>Dean</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrators</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Actions</label>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                    <a href="{{ route('admin.user-management') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200 inline-flex items-center">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        User
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Contact
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Last Activity
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-{{ $user->role === 'admin' ? 'red' : ($user->role === 'dean' ? 'purple' : ($user->role === 'faculty' ? 'green' : 'blue')) }}-100 p-2 rounded-full mr-3">
                                <i class="fas fa-{{ $user->role === 'admin' ? 'shield-alt' : ($user->role === 'dean' ? 'user-tie' : ($user->role === 'faculty' ? 'chalkboard-teacher' : 'user-graduate')) }} text-{{ $user->role === 'admin' ? 'red' : ($user->role === 'dean' ? 'purple' : ($user->role === 'faculty' ? 'green' : 'blue')) }}-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $user->student_id ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $user->role === 'admin' ? 'red' : ($user->role === 'dean' ? 'purple' : ($user->role === 'faculty' ? 'green' : 'blue')) }}-100 text-{{ $user->role === 'admin' ? 'red' : ($user->role === 'dean' ? 'purple' : ($user->role === 'faculty' ? 'green' : 'blue')) }}-800">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                        <div class="text-sm text-gray-500">{{ $user->phone ?? 'No phone' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->updated_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No users found</p>
                        <p>Try adjusting your search criteria</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($users->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $users->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- User Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
        <div class="bg-blue-100 p-3 rounded-full inline-block mb-4">
            <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Students</h3>
        <p class="text-3xl font-bold text-blue-600">{{ $studentsCount }}</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
        <div class="bg-green-100 p-3 rounded-full inline-block mb-4">
            <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Faculty</h3>
        <p class="text-3xl font-bold text-green-600">{{ $facultyCount }}</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
        <div class="bg-purple-100 p-3 rounded-full inline-block mb-4">
            <i class="fas fa-user-tie text-purple-600 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Dean</h3>
        <p class="text-3xl font-bold text-purple-600">{{ $deanCount }}</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
        <div class="bg-red-100 p-3 rounded-full inline-block mb-4">
            <i class="fas fa-shield-alt text-red-600 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Admins</h3>
        <p class="text-3xl font-bold text-red-600">{{ $adminCount }}</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const roleSelect = document.querySelector('select[name="role"]');
    const form = searchInput.closest('form');
    
    // Auto-submit form when role filter changes
    roleSelect.addEventListener('change', function() {
        form.submit();
    });
    
    // Optional: Submit form when user stops typing (debounced)
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            // Only auto-submit if there's text or if clearing the search
            if (searchInput.value.length >= 3 || searchInput.value.length === 0) {
                form.submit();
            }
        }, 500); // Wait 500ms after user stops typing
    });
});
</script>
@endsection
