@extends('layouts.dean')

@section('page-title', 'Announcements')

@section('content')
<div class="space-y-6">
    
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Create Announcement -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-plus-circle text-blue-600 mr-2"></i>
            Create New Announcement
        </h2>
        
        <form action="{{ route('dean.announcement.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter announcement title" required>
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">Select category</option>
                        <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General</option>
                        <option value="academic" {{ old('category') == 'academic' ? 'selected' : '' }}>Academic</option>
                        <option value="administrative" {{ old('category') == 'administrative' ? 'selected' : '' }}>Administrative</option>
                        <option value="urgent" {{ old('category') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div>
                    <label for="audience" class="block text-sm font-medium text-gray-700 mb-2">Audience</label>
                    <select id="audience" name="audience" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">Select audience</option>
                        <option value="all" {{ old('audience') == 'all' ? 'selected' : '' }}>All Users</option>
                        <option value="students" {{ old('audience') == 'students' ? 'selected' : '' }}>Students Only</option>
                        <option value="faculty" {{ old('audience') == 'faculty' ? 'selected' : '' }}>Faculty Only</option>
                        <option value="staff" {{ old('audience') == 'staff' ? 'selected' : '' }}>Staff Only</option>
                    </select>
                </div>
                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select id="priority" name="priority" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
                <div>
                    <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-2">Expires At (Optional)</label>
                    <input type="datetime-local" id="expires_at" name="expires_at" value="{{ old('expires_at') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="content" name="content" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter announcement content..." required>{{ old('content') }}</textarea>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="submit" name="action" value="draft" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Save Draft
                </button>
                <button type="submit" name="action" value="publish" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
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
                    Published Announcements
                </h2>
                <button class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-filter mr-1"></i>
                    Filter
                </button>
            </div>
        </div>
        <div class="p-6">
            @if($announcements->where('status', 'published')->count() > 0)
                <div class="space-y-4">
                    @foreach($announcements->where('status', 'published') as $announcement)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $announcement->title }}</h3>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            @if($announcement->priority == 'urgent') bg-red-100 text-red-800
                                            @elseif($announcement->priority == 'high') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($announcement->priority) }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ ucfirst($announcement->category) }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ ucfirst($announcement->audience) }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 mb-3">{{ Str::limit($announcement->content, 200) }}</p>
                                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                                        <span><i class="fas fa-calendar mr-1"></i>{{ $announcement->published_at->format('M d, Y g:i A') }}</span>
                                        @if($announcement->expires_at)
                                            <span><i class="fas fa-clock mr-1"></i>Expires: {{ $announcement->expires_at->format('M d, Y g:i A') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-archive mr-1"></i>Archive
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-newspaper text-gray-400 text-5xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">No Published Announcements</h3>
                    <p class="text-gray-500">Create your first announcement to get started</p>
                </div>
            @endif
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
            @if($drafts->count() > 0)
                <div class="space-y-4">
                    @foreach($drafts as $draft)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $draft->title }}</h3>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Draft
                                        </span>
                                    </div>
                                    <p class="text-gray-600 mb-3">{{ Str::limit($draft->content, 200) }}</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span><i class="fas fa-calendar mr-1"></i>Created: {{ $draft->created_at->format('M d, Y g:i A') }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button class="text-green-600 hover:text-green-800 text-sm">
                                        <i class="fas fa-paper-plane mr-1"></i>Publish
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-trash mr-1"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-file-alt text-gray-400 text-5xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">No Draft Announcements</h3>
                    <p class="text-gray-500">Your draft announcements will appear here</p>
                </div>
            @endif
        </div>
    </div>
    
</div>
@endsection
