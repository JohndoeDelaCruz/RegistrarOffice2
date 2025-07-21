@extends('layouts.admin')

@section('page-title', 'Admin Profile')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Admin Profile</h1>
            <p class="text-gray-600">Manage your admin account settings and preferences</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
                <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-undo mr-2"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Overview -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="text-center">
                <div class="relative inline-block">
                    <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-shield text-red-600 text-3xl"></i>
                    </div>
                    <button class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-camera text-xs"></i>
                    </button>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">{{ $admin->name }}</h3>
                <p class="text-gray-600">System Administrator</p>
                <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Admin Access
                </div>
            </div>
            
            <div class="mt-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Email:</span>
                    <span class="text-sm font-medium text-gray-800">{{ $admin->email }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Last Login:</span>
                    <span class="text-sm font-medium text-gray-800">{{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Account Created:</span>
                    <span class="text-sm font-medium text-gray-800">{{ $admin->created_at->format('M j, Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Status:</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-circle mr-1" style="font-size: 6px;"></i>
                        Active
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h4>
            <div class="space-y-3">
                <button class="w-full flex items-center px-4 py-3 text-left bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <i class="fas fa-key text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Change Password</p>
                        <p class="text-xs text-gray-600">Update your login credentials</p>
                    </div>
                </button>
                
                <button class="w-full flex items-center px-4 py-3 text-left bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                    <div class="bg-green-100 p-2 rounded-full mr-3">
                        <i class="fas fa-shield-alt text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Enable 2FA</p>
                        <p class="text-xs text-gray-600">Add extra security layer</p>
                    </div>
                </button>
                
                <button class="w-full flex items-center px-4 py-3 text-left bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                    <div class="bg-purple-100 p-2 rounded-full mr-3">
                        <i class="fas fa-download text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Download Data</p>
                        <p class="text-xs text-gray-600">Export your admin data</p>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Profile Settings -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button class="border-b-2 border-red-500 py-2 px-1 text-sm font-medium text-red-600">
                        Personal Information
                    </button>
                    <button class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Security Settings
                    </button>
                    <button class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Preferences
                    </button>
                </nav>
            </div>
            
            <!-- Personal Information Tab -->
            <div id="personal-info-tab">
                <form class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" value="{{ $admin->name }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" value="{{ $admin->email }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" value="{{ $admin->phone ?? '' }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <input type="text" value="{{ $admin->department ?? 'Administration' }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea rows="4" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Tell us about yourself...">{{ $admin->bio ?? '' }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Your address...">{{ $admin->address ?? '' }}</textarea>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Activity Log -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h4>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-full mr-4 mt-1">
                        <i class="fas fa-sign-in-alt text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Logged into admin dashboard</p>
                        <p class="text-xs text-gray-500">2 hours ago from IP: 192.168.1.100</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-full mr-4 mt-1">
                        <i class="fas fa-user-plus text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Created new faculty user account</p>
                        <p class="text-xs text-gray-500">Yesterday at 3:45 PM</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-purple-100 p-2 rounded-full mr-4 mt-1">
                        <i class="fas fa-chart-bar text-purple-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Generated user activity report</p>
                        <p class="text-xs text-gray-500">Yesterday at 10:30 AM</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-yellow-100 p-2 rounded-full mr-4 mt-1">
                        <i class="fas fa-cog text-yellow-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Updated system configuration</p>
                        <p class="text-xs text-gray-500">2 days ago at 9:15 AM</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-red-100 p-2 rounded-full mr-4 mt-1">
                        <i class="fas fa-trash text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Deleted inactive user accounts</p>
                        <p class="text-xs text-gray-500">3 days ago at 4:20 PM</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-gray-200">
                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    View Full Activity Log →
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Security & Preferences Sections (Hidden by default) -->
<div id="security-tab" class="hidden">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-6">Security Settings</h4>
        <!-- Security form content would go here -->
    </div>
</div>

<div id="preferences-tab" class="hidden">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-6">Preferences</h4>
        <!-- Preferences form content would go here -->
    </div>
</div>

<script>
// Simple tab switching functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('[id$="-tab"]');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active classes from all tabs
            tabs.forEach(t => {
                t.classList.remove('border-red-500', 'text-red-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Add active classes to clicked tab
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-red-500', 'text-red-600');
            
            // Hide all tab panels
            tabPanels.forEach(panel => panel.classList.add('hidden'));
            
            // Show corresponding tab panel
            const targetTab = this.textContent.trim().toLowerCase().replace(/\s+/g, '-');
            const targetPanel = document.getElementById(targetTab + '-tab');
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
            }
        });
    });
});
</script>
@endsection
