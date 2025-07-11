@extends('layouts.student')

@section('page-title', 'Announcements')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Announcements</h1>
                <p class="text-gray-600 mt-1">Latest announcements from the Dean's Office</p>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-bullhorn text-uc-green text-2xl"></i>
            </div>
        </div>
    </div>

    @if($announcements->count() > 0)
        <!-- Announcements List -->
        <div class="space-y-4">
            @foreach($announcements as $announcement)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ $announcement->title }}
                                </h3>
                                <div class="flex items-center space-x-3 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $announcement->formatted_published_at }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-user mr-1"></i>
                                        {{ $announcement->creator->name }}
                                        @if($announcement->creator->role === 'dean')
                                            <span class="ml-1 px-1 py-0.5 bg-blue-100 text-blue-800 text-xs rounded">Dean</span>
                                        @elseif($announcement->creator->role === 'faculty')
                                            <span class="ml-1 px-1 py-0.5 bg-green-100 text-green-800 text-xs rounded">Faculty</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <!-- Priority Badge -->
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $announcement->priority_badge_class }}">
                                    @if($announcement->priority === 'urgent')
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Urgent
                                    @elseif($announcement->priority === 'high')
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        High Priority
                                    @else
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Normal
                                    @endif
                                </span>
                                
                                <!-- Category Badge -->
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $announcement->category_badge_class }}">
                                    @if($announcement->category === 'academic')
                                        <i class="fas fa-graduation-cap mr-1"></i>
                                        Academic
                                    @elseif($announcement->category === 'administrative')
                                        <i class="fas fa-cogs mr-1"></i>
                                        Administrative
                                    @elseif($announcement->category === 'urgent')
                                        <i class="fas fa-bell mr-1"></i>
                                        Urgent
                                    @else
                                        <i class="fas fa-info mr-1"></i>
                                        General
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="prose prose-sm max-w-none">
                            <div class="text-gray-700 leading-relaxed">
                                {{ $announcement->content }}
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <i class="fas fa-eye"></i>
                                    <span>Audience: {{ ucfirst($announcement->audience) }}</span>
                                </div>
                                @if($announcement->priority === 'urgent')
                                    <div class="flex items-center space-x-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <span class="font-medium">Requires Immediate Attention</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- No Announcements -->
        <div class="bg-white rounded-lg shadow-sm p-12">
            <div class="text-center">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-bullhorn text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Announcements Yet</h3>
                <p class="text-gray-600 mb-4">
                    There are currently no announcements from the Dean's Office.
                </p>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 inline-block">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-info-circle text-blue-600"></i>
                        <span class="text-sm text-blue-800">
                            New announcements will appear here when they are published.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        margin-top: 1em;
        margin-bottom: 0.5em;
    }
    
    .prose p {
        margin-bottom: 1em;
    }
    
    .prose ul, .prose ol {
        margin-bottom: 1em;
        padding-left: 1.5em;
    }
    
    .prose li {
        margin-bottom: 0.25em;
    }
    
    .prose strong {
        font-weight: 600;
    }
    
    .prose em {
        font-style: italic;
    }
</style>
@endsection
