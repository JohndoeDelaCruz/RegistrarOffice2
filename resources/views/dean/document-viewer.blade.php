@extends('layouts.dean')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Document Viewer</h1>
                    <p class="text-gray-600">{{ $fileName }}</p>
                    <p class="text-sm text-gray-500">{{ strtoupper($fileExtension) }} Document</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ $downloadUrl }}" class="inline-flex items-center px-4 py-2 bg-uc-green text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-download mr-2"></i>
                        Download
                    </a>
                    <button onclick="window.close()" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Close
                    </button>
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
                        
                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                            <button onclick="loadImageViewer()" class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 text-sm active-viewer">
                                <i class="fas fa-image mr-2"></i>
                                Image Viewer
                            </button>
                        @endif
                    </div>
                    
                    <div class="text-sm text-gray-600">
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
                    <object data="{{ $rawUrl }}" type="application/pdf" class="w-full h-full">
                        <iframe src="{{ $rawUrl }}" class="w-full h-full border-0"></iframe>
                    </object>
                </div>
                @endif

                <!-- Image Viewer -->
                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                <div id="imageViewer" class="document-viewer active flex items-center justify-center p-4">
                    <img src="{{ $rawUrl }}" alt="{{ $fileName }}" class="max-w-full max-h-full object-contain rounded shadow-lg">
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
                        <i class="fas fa-spinner fa-spin text-3xl text-uc-green mb-4"></i>
                        <p class="text-gray-600">Loading document...</p>
                    </div>
                </div>

                <!-- Error Message -->
                <div id="errorMessage" class="absolute inset-0 bg-white bg-opacity-90 items-center justify-center hidden">
                    <div class="text-center max-w-md mx-auto p-6">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Unable to Display Document</h3>
                        <p class="text-gray-600 mb-4">This document cannot be displayed in the current viewer. Try a different viewer or download the file.</p>
                        <a href="{{ $downloadUrl }}" class="inline-flex items-center px-4 py-2 bg-uc-green text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
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
    background-color: #1f2937 !important;
}

/* Disable right-click and text selection */
.document-viewer {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-touch-callout: none;
    -webkit-context-menu: none;
}

/* Disable drag and drop */
.document-viewer img, .document-viewer iframe, .document-viewer object {
    -webkit-user-drag: none;
    -khtml-user-drag: none;
    -moz-user-drag: none;
    -o-user-drag: none;
    user-drag: none;
    pointer-events: auto;
}
</style>

<script>
const publicUrl = '{{ $publicUrl }}';
const rawUrl = '{{ $rawUrl }}';
const fileName = '{{ $fileName }}';
const fileExtension = '{{ $fileExtension }}';

function showLoading() {
    document.getElementById('loadingOverlay').classList.remove('hidden');
    document.getElementById('loadingOverlay').classList.add('flex');
    document.getElementById('errorMessage').classList.add('hidden');
}

function hideLoading() {
    document.getElementById('loadingOverlay').classList.add('hidden');
    document.getElementById('loadingOverlay').classList.remove('flex');
}

function showError() {
    document.getElementById('loadingOverlay').classList.add('hidden');
    document.getElementById('errorMessage').classList.remove('hidden');
    document.getElementById('errorMessage').classList.add('flex');
}

function switchViewer(viewerId) {
    // Hide all viewers
    document.querySelectorAll('.document-viewer').forEach(viewer => {
        viewer.classList.remove('active');
    });
    
    // Show selected viewer
    document.getElementById(viewerId).classList.add('active');
    
    // Update button states
    document.querySelectorAll('button[onclick*="load"]').forEach(btn => {
        btn.classList.remove('active-viewer');
    });
}

function loadDirectViewer() {
    switchViewer('directViewer');
    event.target.classList.add('active-viewer');
}

function loadImageViewer() {
    switchViewer('imageViewer');
    event.target.classList.add('active-viewer');
}

function loadGoogleViewer() {
    showLoading();
    switchViewer('googleViewer');
    event.target.classList.add('active-viewer');
    
    const googleViewerUrl = `https://docs.google.com/gview?url=${encodeURIComponent(publicUrl)}&embedded=true`;
    const iframe = document.getElementById('googleFrame');
    
    iframe.onload = function() {
        hideLoading();
    };
    
    iframe.onerror = function() {
        showError();
    };
    
    // Set a timeout for loading
    setTimeout(() => {
        hideLoading();
    }, 10000);
    
    iframe.src = googleViewerUrl;
}

function loadOfficeOnline() {
    showLoading();
    switchViewer('officeViewer');
    event.target.classList.add('active-viewer');
    
    const officeViewerUrl = `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(publicUrl)}`;
    const iframe = document.getElementById('officeFrame');
    
    iframe.onload = function() {
        hideLoading();
    };
    
    iframe.onerror = function() {
        showError();
    };
    
    // Set a timeout for loading
    setTimeout(() => {
        hideLoading();
    }, 10000);
    
    iframe.src = officeViewerUrl;
}

// Auto-load appropriate viewer on page load
document.addEventListener('DOMContentLoaded', function() {
    // For Office documents, auto-load Google Viewer
    if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'].includes(fileExtension)) {
        setTimeout(() => {
            loadGoogleViewer();
        }, 500);
    }
    
    // Disable right-click context menu
    document.addEventListener('contextmenu', function(e) {
        if (e.target.closest('.document-viewer')) {
            e.preventDefault();
            return false;
        }
    });
    
    // Disable keyboard shortcuts for saving/printing
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'p' || e.key === 'a')) {
            if (e.target.closest('.document-viewer')) {
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>
@endsection
