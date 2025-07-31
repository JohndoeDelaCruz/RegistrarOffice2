{{-- Toast Notification Component --}}
{{-- Usage: <x-toast /> --}}

<!-- Toast Notification Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 max-w-sm space-y-2"></div>

<script>
// Global Toast Manager for Laravel Components
window.ToastManager = class {
    constructor() {
        this.container = document.getElementById('toast-container');
        if (!this.container) {
            this.createContainer();
        }
    }

    createContainer() {
        this.container = document.createElement('div');
        this.container.id = 'toast-container';
        this.container.className = 'fixed top-4 right-4 z-50 max-w-sm space-y-2';
        document.body.appendChild(this.container);
    }

    show(message, type = 'info', duration = 5000) {
        const toast = this.createToast(message, type);
        this.container.appendChild(toast);
        
        // Trigger show animation
        setTimeout(() => toast.classList.add('translate-x-0', 'opacity-100'), 10);
        
        // Auto remove
        setTimeout(() => this.remove(toast), duration);
        
        return toast;
    }

    createToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `transform translate-x-full opacity-0 transition-all duration-300 ease-in-out p-4 rounded-lg shadow-lg text-white font-medium flex items-center justify-between ${this.getTypeClass(type)}`;
        
        toast.innerHTML = `
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    ${this.getIcon(type)}
                </div>
                <span class="text-sm">${message}</span>
            </div>
            <button onclick="window.toastManager.remove(this.parentElement)" class="ml-4 text-white hover:text-gray-200 flex-shrink-0">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        `;
        
        return toast;
    }

    getTypeClass(type) {
        switch(type) {
            case 'success': return 'bg-green-500';
            case 'error': return 'bg-red-500';
            case 'warning': return 'bg-yellow-500';
            case 'info': 
            default: return 'bg-blue-500';
        }
    }

    getIcon(type) {
        switch(type) {
            case 'success':
                return '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>';
            case 'error':
                return '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>';
            case 'warning':
                return '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>';
            case 'info':
            default:
                return '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>';
        }
    }

    remove(toast) {
        toast.classList.remove('translate-x-0', 'opacity-100');
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }
};

// Initialize Global Toast Manager
if (typeof window.toastManager === 'undefined') {
    window.toastManager = new window.ToastManager();
}

// Global helper functions
window.showSuccessToast = function(message) {
    window.toastManager.show(message, 'success');
};

window.showErrorToast = function(message) {
    window.toastManager.show(message, 'error');
};

window.showWarningToast = function(message) {
    window.toastManager.show(message, 'warning');
};

window.showInfoToast = function(message) {
    window.toastManager.show(message, 'info');
};

// Auto-show Laravel session messages
document.addEventListener('DOMContentLoaded', function() {
    @if (session('success'))
        showSuccessToast('{{ addslashes(session('success')) }}');
    @endif

    @if (session('error'))
        showErrorToast('{{ addslashes(session('error')) }}');
    @endif

    @if (session('warning'))
        showWarningToast('{{ addslashes(session('warning')) }}');
    @endif

    @if (session('info'))
        showInfoToast('{{ addslashes(session('info')) }}');
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            showErrorToast('{{ addslashes($error) }}');
        @endforeach
    @endif
});
</script>
