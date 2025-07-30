@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">
                        @if($documentType === 'signed')
                        <i class="fas fa-file-signature text-purple-600 mr-2"></i>
                        Signed Document Viewer
                        @else
                        <i class="fas fa-file text-blue-600 mr-2"></i>
                        Supporting Document Viewer
                        @endif
                    </h1>
                    <p class="text-gray-600">{{ $fileName }}</p>
                    <p class="text-sm text-gray-500">{{ strtoupper($fileExtension) }} Document</p>
                    <div class="mt-2">
                        <span class="text-sm text-gray-600">Application ID: </span>
                        <span class="font-medium">#{{ $application->id }}</span>
                        <span class="text-sm text-gray-600 ml-4">Student: </span>
                        <span class="font-medium">{{ $application->student->name }}</span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ $documentUrl }}?download=1" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-download mr-2"></i>
                        Download
                    </a>
                    <a href="{{ route('admin.applications.view', $application->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Application
                    </a>
                </div>
            </div>
        </div>

        <!-- Document Viewer -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Viewer Controls -->
            <div class="border-b border-gray-200 p-4 bg-gray-50">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex flex-wrap gap-3">
                        @if(in_array($fileExtension, ['pdf']))
                            <button onclick="loadDirectViewer()" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm active-viewer">
                                <i class="fas fa-file-pdf mr-2"></i>
                                Direct PDF Viewer
                            </button>
                        @endif
                        
                        @if(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                            <button onclick="loadGoogleViewer()" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 text-sm active-viewer">
                                <i class="fab fa-google mr-2"></i>
                                Google Docs Viewer
                            </button>
                            <button onclick="loadOfficeOnline()" class="inline-flex items-center px-3 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-200 text-sm">
                                <i class="fab fa-microsoft mr-2"></i>
                                Office Online
                            </button>
                        @endif
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600 bg-white px-3 py-2 rounded-lg border">
                        <i class="fas fa-info-circle mr-1"></i>
                        View-only mode - Right-click disabled
                    </div>
                </div>
            </div>

            <!-- Document Container -->
            <div class="relative bg-gray-100" style="height: 80vh;">
                <!-- PDF Direct Viewer -->
                @if(in_array($fileExtension, ['pdf']))
                <div id="directViewer" class="document-viewer active">
                    <object data="{{ $documentUrl }}" type="application/pdf" class="w-full h-full">
                        <iframe src="{{ $documentUrl }}" class="w-full h-full border-0"></iframe>
                    </object>
                </div>
                @endif

                <!-- Image Viewer -->
                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                <div id="imageViewer" class="document-viewer active flex items-center justify-center p-4">
                    <img src="{{ $documentUrl }}" alt="{{ $fileName }}" class="max-w-full max-h-full object-contain rounded shadow-lg">
                </div>
                @endif

                <!-- Google Docs Viewer -->
                <div id="googleViewer" class="document-viewer {{ in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']) ? 'active' : '' }}">
                    <iframe id="googleFrame" src="about:blank" class="w-full h-full border-0"></iframe>
                </div>

                <!-- Office Online Viewer -->
                <div id="officeViewer" class="document-viewer">
                    <iframe id="officeFrame" src="about:blank" class="w-full h-full border-0"></iframe>
                </div>

                <!-- Loading Overlay -->
                <div id="loadingOverlay" class="absolute inset-0 bg-white bg-opacity-90 items-center justify-center {{ in_array($fileExtension, ['pdf', 'jpg', 'jpeg', 'png', 'gif']) ? 'hidden' : 'flex' }}">
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin text-3xl text-blue-600 mb-4"></i>
                        <p class="text-gray-600">Loading document...</p>
                    </div>
                </div>

                <!-- Error Message -->
                <div id="errorMessage" class="absolute inset-0 bg-white bg-opacity-90 items-center justify-center hidden">
                    <div class="text-center max-w-md mx-auto p-6">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Unable to Display Document</h3>
                        <p class="text-gray-600 mb-4">This document cannot be displayed in the current viewer. Try a different viewer or download the file.</p>
                        <a href="{{ $documentUrl }}?download=1" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-download mr-2"></i>
                            Download Document
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Right-click protection -->
<style>
    .document-viewer {
        display: none;
    }
    .document-viewer.active {
        display: block;
    }
    .active-viewer {
        background-color: #3b82f6 !important;
    }
    
    /* Disable right-click */
    .no-select {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>

<script>
    // Document URLs
    const rawUrl = '{{ $documentUrl }}';
    const downloadUrl = '{{ $documentUrl }}?download=1';
    const fileName = '{{ $fileName }}';
    const fileExtension = '{{ $fileExtension }}';

    // Viewer functions
    function loadDirectViewer() {
        hideAllViewers();
        document.getElementById('directViewer').classList.add('active');
        updateActiveButton('Direct PDF Viewer');
    }

    function loadGoogleViewer() {
        hideAllViewers();
        showLoading();
        
        const googleViewerUrl = `https://docs.google.com/viewer?url=${encodeURIComponent(rawUrl)}&embedded=true`;
        const iframe = document.getElementById('googleFrame');
        
        iframe.onload = function() {
            hideLoading();
            document.getElementById('googleViewer').classList.add('active');
        };
        
        iframe.onerror = function() {
            hideLoading();
            showError();
        };
        
        iframe.src = googleViewerUrl;
        updateActiveButton('Google Docs Viewer');
    }

    function loadOfficeOnline() {
        hideAllViewers();
        showLoading();
        
        const officeViewerUrl = `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(rawUrl)}`;
        const iframe = document.getElementById('officeFrame');
        
        iframe.onload = function() {
            hideLoading();
            document.getElementById('officeViewer').classList.add('active');
        };
        
        iframe.onerror = function() {
            hideLoading();
            showError();
        };
        
        iframe.src = officeViewerUrl;
        updateActiveButton('Office Online');
    }

    function hideAllViewers() {
        document.querySelectorAll('.document-viewer').forEach(viewer => {
            viewer.classList.remove('active');
        });
        hideLoading();
        hideError();
    }

    function showLoading() {
        document.getElementById('loadingOverlay').classList.remove('hidden');
        document.getElementById('loadingOverlay').classList.add('flex');
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.add('hidden');
        document.getElementById('loadingOverlay').classList.remove('flex');
    }

    function showError() {
        document.getElementById('errorMessage').classList.remove('hidden');
        document.getElementById('errorMessage').classList.add('flex');
    }

    function hideError() {
        document.getElementById('errorMessage').classList.add('hidden');
        document.getElementById('errorMessage').classList.remove('flex');
    }

    function updateActiveButton(buttonText) {
        document.querySelectorAll('button').forEach(btn => {
            btn.classList.remove('active-viewer');
            if (btn.textContent.trim().includes(buttonText)) {
                btn.classList.add('active-viewer');
            }
        });
    }

    // Disable right-click
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        return false;
    });

    // Initialize viewer based on file type
    document.addEventListener('DOMContentLoaded', function() {
        if (['pdf'].includes(fileExtension)) {
            loadDirectViewer();
        } else if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'].includes(fileExtension)) {
            loadGoogleViewer();
        }
    });
</script>
@endsection
