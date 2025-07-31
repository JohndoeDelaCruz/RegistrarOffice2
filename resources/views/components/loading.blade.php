{{-- Loading Spinner Component --}}
{{-- Usage: <x-loading /> --}}

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center" style="display: none;">
    <div class="bg-white rounded-lg p-6 shadow-xl flex items-center gap-3">
        <div class="spinner border-4 border-gray-200 border-t-blue-500 rounded-full w-6 h-6 animate-spin"></div>
        <span id="loading-text" class="text-gray-700 font-medium">Loading...</span>
    </div>
</div>

<script>
// Global Loading Manager for Laravel Components
window.LoadingManager = class {
    constructor() {
        this.overlay = document.getElementById('loading-overlay');
        this.loadingText = document.getElementById('loading-text');
    }

    show(message = 'Loading...') {
        if (this.overlay) {
            this.overlay.style.display = 'flex';
            if (this.loadingText) {
                this.loadingText.textContent = message;
            }
        }
    }

    hide() {
        if (this.overlay) {
            this.overlay.style.display = 'none';
        }
    }

    showButtonLoading(button, originalText = null) {
        if (!button) return;
        
        const spinner = '<div class="inline-block w-4 h-4 border-2 border-gray-300 border-t-white rounded-full animate-spin mr-2"></div>';
        
        if (originalText === null) {
            originalText = button.innerHTML;
        }
        
        button.disabled = true;
        button.dataset.originalText = originalText;
        button.innerHTML = spinner + 'Loading...';
        button.classList.add('opacity-75', 'cursor-not-allowed');
    }

    hideButtonLoading(button) {
        if (!button) return;
        
        const originalText = button.dataset.originalText || button.innerHTML;
        
        button.disabled = false;
        button.innerHTML = originalText;
        button.classList.remove('opacity-75', 'cursor-not-allowed');
        delete button.dataset.originalText;
    }
};

// Initialize Global Loading Manager
if (typeof window.loadingManager === 'undefined') {
    window.loadingManager = new window.LoadingManager();
}

// Global helper functions
window.showLoading = function(message = 'Loading...') {
    window.loadingManager.show(message);
};

window.hideLoading = function() {
    window.loadingManager.hide();
};

window.showButtonLoading = function(button, originalText = null) {
    window.loadingManager.showButtonLoading(button, originalText);
};

window.hideButtonLoading = function(button) {
    window.loadingManager.hideButtonLoading(button);
};
</script>
