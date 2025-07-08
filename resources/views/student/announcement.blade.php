@extends('layouts.student')

@section('page-title', 'Announcements')

@section('content')
<div class="space-y-6">
    @if($announcements->count() > 0)
        <!-- Announcements List -->
        @foreach($announcements as $announcement)
            <div class="bg-white rounded-lg shadow-sm border-l-4 
                @if($announcement->priority == 'urgent') border-red-500
                @elseif($announcement->priority == 'high') border-yellow-500
                @else border-blue-500 @endif">
                
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <h2 class="text-xl font-semibold text-gray-800">{{ $announcement->title }}</h2>
                                
                                <!-- Priority Badge -->
                                @if($announcement->priority == 'urgent')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        Urgent
                                    </span>
                                @elseif($announcement->priority == 'high')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        High Priority
                                    </span>
                                @endif

                                <!-- Category Badge -->
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    @if($announcement->category == 'academic') bg-blue-100 text-blue-800
                                    @elseif($announcement->category == 'administrative') bg-purple-100 text-purple-800
                                    @elseif($announcement->category == 'urgent') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ ucfirst($announcement->category) }}
                                </span>

                                <!-- Source Badge -->
                                @if($announcement->creator->role == 'dean')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-university mr-1"></i>
                                        Dean's Office
                                    </span>
                                @elseif($announcement->creator->role == 'faculty')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                                        Faculty
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Announcement Content -->
                            <div class="prose prose-gray max-w-none mb-4">
                                <p class="text-gray-700 leading-relaxed">{{ nl2br(e($announcement->content)) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer Information -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    {{ $announcement->creator->name ?? 'Dean' }}
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i>
                                    {{ $announcement->published_at->format('F j, Y') }}
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    {{ $announcement->published_at->format('g:i A') }}
                                </span>
                            </div>
                            
                            @if($announcement->expires_at)
                                <div class="flex items-center text-orange-600">
                                    <i class="fas fa-hourglass-half mr-2"></i>
                                    <span>Expires: {{ $announcement->expires_at->format('M j, Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <!-- No Announcements -->
        <div class="bg-white rounded-lg shadow-sm p-12">
            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullhorn text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">No Announcements Yet</h3>
                <p class="text-gray-600 mb-6">Check back later for announcements from the dean and faculty.</p>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 max-w-md mx-auto">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fas fa-info-circle text-blue-600"></i>
                        <span class="text-sm font-medium text-blue-800">
                            You'll be notified when new announcements are posted.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
