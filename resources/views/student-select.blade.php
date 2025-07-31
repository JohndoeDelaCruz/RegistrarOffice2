<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Completion Portal - Student Login</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/UC_Official_Seal.png') }}">
    
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uc-green': '#15803d',
                        'uc-green-dark': '#166534',
                    },
                    backgroundImage: {
                        'custom-gradient': 'radial-gradient(ellipse at center, #e0f2fe 0%, #bfdbfe 20%, #60a5fa 40%, #3b82f6 60%, #2563eb 80%, #1d4ed8 100%)',
                        'header-gradient': 'linear-gradient(45deg, #15803d 0%, #166534 100%)',
                        'btn-gradient': 'radial-gradient(ellipse at center, #ffffff 0%, #dbeafe 30%, #93c5fd 60%, #3b82f6 100%)',
                        'btn-hover-gradient': 'radial-gradient(ellipse at center, #f8fafc 0%, #bfdbfe 30%, #60a5fa 60%, #2563eb 100%)',
                    },
                    animation: {
                        'spin-slow': 'spin 1s linear infinite',
                        'fade-in': 'fadeIn 0.3s ease-in',
                        'fade-out': 'fadeOut 0.3s ease-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                        'slide-out': 'slideOut 0.3s ease-in',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        fadeOut: {
                            '0%': { opacity: '1' },
                            '100%': { opacity: '0' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateY(-100%)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideOut: {
                            '0%': { transform: 'translateY(0)', opacity: '1' },
                            '100%': { transform: 'translateY(-100%)', opacity: '0' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles for Loading and Toast -->
    <style>
        .spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }
        
        .toast {
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: all 0.3s ease;
        }
        
        .toast.show {
            transform: translateX(0);
        }
        
        .toast.hide {
            transform: translateX(100%);
        }
        
        .btn-loading {
            position: relative;
            pointer-events: none;
        }
        
        .btn-loading .btn-text {
            opacity: 0;
        }
        
        .btn-loading .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body class="min-h-screen bg-custom-gradient font-sans">
    <!-- Header -->
    <div class="bg-header-gradient text-white px-6 sm:px-8 py-5 flex flex-col sm:flex-row justify-between items-center min-h-[80px] sm:min-h-[100px]">
        <div class="flex items-center gap-2 mb-3 sm:mb-0">
            <img src="{{ asset('images/UC_Official_Logo.png') }}" alt="University Logo" 
                 class="h-12 sm:h-16 lg:h-[75px] w-auto max-w-[200px] sm:max-w-[250px]">
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/SCHOOLAUTOMATE.png') }}" alt="SchoolAutomate Logo" 
                 class="h-12 sm:h-16 lg:h-[75px] w-auto max-w-[250px] sm:max-w-[350px]">
        </div>
    </div>

    <!-- Login Container -->
    <div class="flex justify-center items-start min-h-[calc(100vh-100px)] px-4 sm:px-6 py-8 sm:py-10">
        <div class="bg-white/15 backdrop-blur-md border border-white/20 rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl">
            <!-- Login Header -->
            <div class="bg-orange-500 text-white p-5 sm:p-6 text-center">
                <h1 class="text-lg sm:text-xl lg:text-2xl font-bold">Grade Completion Portal - Login</h1>
            </div>
            
            <!-- Login Form -->
            <form action="/login" method="POST" class="p-6 sm:p-8 lg:p-12 bg-sky-200/40">
                @csrf

                <div class="flex flex-col items-center gap-6 sm:gap-8 mt-4">
                    <!-- Email/ID Row -->
                    <div class="flex flex-col sm:flex-row items-center w-full max-w-lg">
                        <label class="bg-cyan-600 text-white px-4 py-3 font-bold text-center text-sm sm:text-base 
                                      rounded-l-full sm:rounded-l-3xl rounded-r-full sm:rounded-r-none 
                                      w-full sm:w-48 mb-0 sm:mb-0 whitespace-nowrap">
                            Email or ID Number:
                        </label>
                        <input 
                            type="text" 
                            name="login_id" 
                            id="login-input"
                            value="{{ old('login_id') }}"
                            placeholder="student@uc.edu.ph or 00-0000-000"
                            class="w-full sm:w-72 px-4 py-3 border-none bg-sky-50 text-slate-600 
                                   rounded-r-full sm:rounded-r-3xl rounded-l-full sm:rounded-l-none 
                                   focus:bg-white focus:outline-none text-sm sm:text-base mt-0 sm:mt-0"
                            required
                        >
                    </div>
                    
                    <!-- Password Row -->
                    <div class="flex flex-col sm:flex-row items-center w-full max-w-lg">
                        <label class="bg-cyan-600 text-white px-4 py-3 font-bold text-center text-sm sm:text-base 
                                      rounded-l-full sm:rounded-l-3xl rounded-r-full sm:rounded-r-none 
                                      w-full sm:w-48 mb-0 sm:mb-0">
                            Password:
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Enter your password"
                            class="w-full sm:w-72 px-4 py-3 border-none bg-sky-50 text-slate-600 
                                   rounded-r-full sm:rounded-r-3xl rounded-l-full sm:rounded-l-none 
                                   focus:bg-white focus:outline-none text-sm sm:text-base mt-0 sm:mt-0"
                            required
                        >
                    </div>
                    
                    <!-- Login Button -->
                    <button type="submit" 
                            id="login-btn"
                            class="bg-btn-gradient hover:bg-btn-hover-gradient text-slate-800 font-bold 
                                   px-8 sm:px-12 py-3 sm:py-4 rounded-full text-base sm:text-lg 
                                   shadow-lg hover:shadow-xl transform hover:-translate-y-1 
                                   transition-all duration-300 mt-4 relative overflow-hidden">
                        <span class="btn-text">Login Now</span>
                        <div class="spinner absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 transition-opacity duration-300"></div>
                    </button>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mt-6 text-center">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mt-6 text-center">
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="toast-container"></div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center" style="display: none;">
        <div class="bg-white rounded-lg p-6 shadow-xl flex items-center gap-3">
            <div class="spinner"></div>
            <span class="text-gray-700 font-medium">Logging you in...</span>
        </div>
    </div>

    <script>
        // Toast Notification System
        class ToastManager {
            constructor() {
                this.container = document.getElementById('toast-container');
            }

            show(message, type = 'info', duration = 5000) {
                const toast = this.createToast(message, type);
                this.container.appendChild(toast);
                
                // Trigger show animation
                setTimeout(() => toast.classList.add('show'), 10);
                
                // Auto remove
                setTimeout(() => this.remove(toast), duration);
                
                return toast;
            }

            createToast(message, type) {
                const toast = document.createElement('div');
                toast.className = `toast p-4 text-white font-medium flex items-center justify-between ${this.getTypeClass(type)}`;
                
                toast.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            ${this.getIcon(type)}
                        </div>
                        <span>${message}</span>
                    </div>
                    <button onclick="toastManager.remove(this.parentElement)" class="ml-4 text-white hover:text-gray-200">
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
                toast.classList.add('hide');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }
        }

        // Initialize Toast Manager
        const toastManager = new ToastManager();

        // Loading State Management
        class LoadingManager {
            constructor() {
                this.overlay = document.getElementById('loading-overlay');
                this.loginBtn = document.getElementById('login-btn');
                this.btnText = this.loginBtn.querySelector('.btn-text');
                this.btnSpinner = this.loginBtn.querySelector('.spinner');
            }

            showFullScreen(message = 'Loading...') {
                this.overlay.style.display = 'flex';
                this.overlay.querySelector('span').textContent = message;
            }

            hideFullScreen() {
                this.overlay.style.display = 'none';
            }

            showButtonLoading() {
                this.loginBtn.disabled = true;
                this.loginBtn.style.pointerEvents = 'none';
                this.btnText.style.opacity = '0';
                this.btnSpinner.style.opacity = '1';
            }

            hideButtonLoading() {
                this.loginBtn.disabled = false;
                this.loginBtn.style.pointerEvents = 'auto';
                this.btnText.style.opacity = '1';
                this.btnSpinner.style.opacity = '0';
            }
        }

        // Initialize Loading Manager
        const loadingManager = new LoadingManager();

        // Form Submission Handler
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus on the login input for better user experience
            document.getElementById('login-input').focus();

            // Handle form submission
            const loginForm = document.querySelector('form');
            loginForm.addEventListener('submit', function(e) {
                // Show loading state
                loadingManager.showButtonLoading();
                toastManager.show('Authenticating...', 'info', 3000);
                
                // Show full screen loading after 1 second if form is still processing
                setTimeout(() => {
                    if (loadingManager.loginBtn.disabled) {
                        loadingManager.showFullScreen('Logging you in...');
                    }
                }, 1000);
            });

            // Show toast notifications based on session messages
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastManager.show('{{ addslashes($error) }}', 'error');
                @endforeach
            @endif

            @if (session('success'))
                toastManager.show('{{ addslashes(session('success')) }}', 'success');
            @endif

            @if (session('error'))
                toastManager.show('{{ addslashes(session('error')) }}', 'error');
            @endif

            @if (session('warning'))
                toastManager.show('{{ addslashes(session('warning')) }}', 'warning');
            @endif

            @if (session('info'))
                toastManager.show('{{ addslashes(session('info')) }}', 'info');
            @endif
        });

        // Example usage functions (you can call these from anywhere)
        function showSuccessToast(message) {
            toastManager.show(message, 'success');
        }

        function showErrorToast(message) {
            toastManager.show(message, 'error');
        }

        function showWarningToast(message) {
            toastManager.show(message, 'warning');
        }

        function showInfoToast(message) {
            toastManager.show(message, 'info');
        }

        function showLoading(message = 'Loading...') {
            loadingManager.showFullScreen(message);
        }

        function hideLoading() {
            loadingManager.hideFullScreen();
        }
    </script>
</body>
</html>
