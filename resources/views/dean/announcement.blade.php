@extends('layouts.dean')

@section('page-title', 'Announcements')

@section('content')
<div class="space-y-6">
    
    <!-- Create Announcement -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-plus-circle text-blue-600 mr-2"></i>
            Create New Announcement
        </h2>
        
        <form class="space-y-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter announcement title">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select category</option>
                        <option value="general">General</option>
                        <option value="academic">Academic</option>
                        <option value="administrative">Administrative</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="audience" class="block text-sm font-medium text-gray-700 mb-2">Audience</label>
                    <select id="audience" name="audience" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select audience</option>
                        <option value="all">All Users</option>
                        <option value="students">Students Only</option>
                        <option value="faculty">Faculty Only</option>
                        <option value="staff">Staff Only</option>
                    </select>
                </div>
                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select id="priority" name="priority" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="content" name="content" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter announcement content..."></textarea>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Save Draft
                </button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Publish Announcement
                </button>
            </div>
        </form>
    </div>

    <!-- Active Announcements -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-list text-green-600 mr-2"></i>
                    Active Announcements
                </h2>
                <button class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-filter mr-1"></i>
                    Filter
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="text-center py-12">
                <i class="fas fa-newspaper text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">No Active Announcements</h3>
                <p class="text-gray-500">Create your first announcement to get started</p>
                <button class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Create Announcement
                </button>
            </div>
        </div>
    </div>

    <!-- Draft Announcements -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-edit text-orange-600 mr-2"></i>
                Draft Announcements
            </h2>
            <p class="text-gray-600 mt-1">Unpublished announcements saved as drafts</p>
        </div>
        <div class="p-6">
            <div class="text-center py-12">
                <i class="fas fa-file-alt text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">No Draft Announcements</h3>
                <p class="text-gray-500">Your draft announcements will appear here</p>
            </div>
        </div>
    </div>

    
</div>
@endsection
