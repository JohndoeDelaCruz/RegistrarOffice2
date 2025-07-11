@extends('layouts.dean')

@section('page-title', 'Announcements')

@section('content')
<div class="space-y-6">
    
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <p class="text-sm">{{ session('error') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    <!-- Create Announcement -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-plus-circle text-blue-600 mr-2"></i>
            Create New Announcement
        </h2>
        
        <form action="{{ route('dean.announcement.create') }}" method="POST" class="space-y-4">
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
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
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
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="content" name="content" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter announcement content..." required>{{ old('content') }}</textarea>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="submit" name="action" value="save_draft" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>Save Draft
                </button>
                <button type="submit" name="action" value="publish" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-paper-plane mr-2"></i>Publish Announcement
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
                <span class="text-sm text-gray-500">{{ $publishedAnnouncements->count() }} Published</span>
            </div>
        </div>
        <div class="p-6">
            @if($publishedAnnouncements->count() > 0)
                <div class="space-y-4">
                    @foreach($publishedAnnouncements as $announcement)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $announcement->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($announcement->content, 150) }}</p>
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ $announcement->formatted_published_at }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-users mr-1"></i>
                                            {{ ucfirst($announcement->audience) }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $announcement->priority_badge_class }}">
                                            {{ ucfirst($announcement->priority) }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $announcement->category_badge_class }}">
                                            {{ ucfirst($announcement->category) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('dean.announcement.delete', $announcement) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this announcement?')" class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-newspaper text-gray-400 text-5xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">No Active Announcements</h3>
                    <p class="text-gray-500">Your published announcements will appear here</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Draft Announcements -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-edit text-orange-600 mr-2"></i>
                    Draft Announcements
                </h2>
                <span class="text-sm text-gray-500">{{ $draftAnnouncements->count() }} Drafts</span>
            </div>
        </div>
        <div class="p-6">
            @if($draftAnnouncements->count() > 0)
                <div class="space-y-4">
                    @foreach($draftAnnouncements as $announcement)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $announcement->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($announcement->content, 150) }}</p>
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            Created {{ $announcement->created_at->format('F j, Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-users mr-1"></i>
                                            {{ ucfirst($announcement->audience) }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $announcement->priority_badge_class }}">
                                            {{ ucfirst($announcement->priority) }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $announcement->category_badge_class }}">
                                            {{ ucfirst($announcement->category) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('dean.announcement.publish', $announcement) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Publish">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('dean.announcement.delete', $announcement) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this draft?')" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
