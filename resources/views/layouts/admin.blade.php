<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Admin Dashboard') - Grade Completion Portal</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/UC_Official_Seal.png') }}">
    
    <script src="https://cdn.tailwindcss.com?v={{ time() }}"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uc-green': '#2d7738',
                        'uc-blue': '#1e40af',
                        'uc-orange': '#ea580c',
                        'uc-bg': '#f8fafc',
                        'uc-green-dark': '#1f5f29',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .font-inter { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        .bg-custom { background-color: #95bce2; }
    </style>
</head>
<body class="font-inter bg-custom min-h-screen">
    <!-- Top Navigation Bar -->
    <div class="bg-uc-green text-white px-8 py-5 flex justify-between items-center fixed top-0 left-0 right-0 z-50 min-h-16 shadow-lg">
        <div class="flex items-center gap-3">
            <!-- Mobile Menu Toggle -->
            <button id="mobileMenuToggle" class="lg:hidden text-white hover:text-red-200 transition-colors duration-200">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <div class="flex items-center gap-3">
                <i class="fas fa-shield-alt text-xl"></i>
                <span class="font-bold text-xl hidden sm:block">Admin Panel</span>
                <span class="text-sm text-red-200 hidden md:block">| University of Cordilleras</span>
            </div>
        </div>
        
        <div class="flex items-center gap-3 relative">
            <span class="text-sm hidden sm:block">{{ $admin->name ?? 'Administrator' }}</span>
            <button id="userMenuToggle" class="bg-green-600 hover:bg-green-700 rounded-full p-2 transition-colors duration-200">
                <i class="fas fa-user text-sm"></i>
            </button>
            
            <!-- User Dropdown -->
            <div id="userDropdown" class="absolute top-full right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 hidden z-50">
                <div class="py-1">
                    <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-3"></i>Profile
                    </a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-3"></i>Log Out
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <div style="background: #6393c1;" class="text-white w-64 h-screen fixed left-0 top-16 overflow-y-auto hidden lg:block z-30 shadow-xl">
        <!-- Navigation -->
        <nav class="mt-4">
            <div class="px-6 py-4">
                <h2 class="text-xs uppercase tracking-wider text-red-300 font-semibold">Administration</h2>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-bold">Dashboard</span>
            </a>

            <a href="{{ route('admin.user-management') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.user-management') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-users w-5 text-center"></i>
                <span class="font-bold">User Management</span>
            </a>

            <a href="{{ route('admin.application-tracking') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.application-tracking') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-file-signature w-5 text-center"></i>
                <span class="font-bold">Application Tracking</span>
            </a>

            <a href="{{ route('admin.system-logs') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.system-logs') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-clipboard-list w-5 text-center"></i>
                <span class="font-bold">System Logs</span>
            </a>

            <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.reports') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-chart-bar w-5 text-center"></i>
                <span class="font-bold">Reports</span>
            </a>

            <div class="px-6 py-4 mt-4">
                <h2 class="text-xs uppercase tracking-wider text-orange-300 font-semibold">Account</h2>
            </div>

            <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.profile') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-user w-5 text-center"></i>
                <span class="font-bold">Profile</span>
            </a>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span class="font-bold">Log Out</span>
            </a>
        </nav>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobileSidebar" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" onclick="closeMobileMenu()"></div>
        <div style="background: #6393c1;" class="fixed top-16 left-0 bottom-0 w-64 text-white overflow-y-auto">
            <!-- Mobile Navigation - Same as desktop but with onclick handlers -->
            <nav class="mt-4">
                <div class="px-6 py-4">
                    <h2 class="text-xs uppercase tracking-wider text-red-300 font-semibold">Administration</h2>
                </div>
                
                <a href="{{ route('admin.dashboard') }}" 
                   onclick="closeMobileMenu()"
                   class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span class="font-bold">Dashboard</span>
                </a>

                <a href="{{ route('admin.user-management') }}" 
                   onclick="closeMobileMenu()"
                   class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.user-management') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="font-bold">User Management</span>
                </a>

                <a href="{{ route('admin.application-tracking') }}" 
                   onclick="closeMobileMenu()"
                   class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.application-tracking') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                    <i class="fas fa-file-signature w-5 text-center"></i>
                    <span class="font-bold">Application Tracking</span>
                </a>

                <a href="{{ route('admin.system-logs') }}" 
                   onclick="closeMobileMenu()"
                   class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.system-logs') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                    <i class="fas fa-clipboard-list w-5 text-center"></i>
                    <span class="font-bold">System Logs</span>
                </a>

                <a href="{{ route('admin.reports') }}" 
                   onclick="closeMobileMenu()"
                   class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.reports') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                    <i class="fas fa-chart-bar w-5 text-center"></i>
                    <span class="font-bold">Reports</span>
                </a>

                <div class="px-6 py-4 mt-4">
                    <h2 class="text-xs uppercase tracking-wider text-orange-300 font-semibold">Account</h2>
                </div>

                <a href="{{ route('admin.profile') }}" 
                   onclick="closeMobileMenu()"
                   class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('admin.profile') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                    <i class="fas fa-user w-5 text-center"></i>
                    <span class="font-bold">Profile</span>
                </a>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); closeMobileMenu();" 
                   class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span class="font-bold">Log Out</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64 pt-20 min-h-screen bg-custom">
        <!-- Content Header -->
        <div class="bg-white px-4 sm:px-6 lg:px-8 py-4 lg:py-5 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl sm:text-2xl font-semibold text-uc-green">@yield('page-title', 'Admin Dashboard')</h1>
                    <p class="text-sm text-gray-600 mt-1">Administrative Control Panel</p>
                </div>
            </div>
        </div>
        
        <!-- Content Body -->
        <div class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </div>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuToggle').addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.remove('hidden');
        });

        function closeMobileMenu() {
            document.getElementById('mobileSidebar').classList.add('hidden');
        }

        // User dropdown toggle
        document.getElementById('userMenuToggle').addEventListener('click', function() {
            document.getElementById('userDropdown').classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const toggle = document.getElementById('userMenuToggle');
            
            if (!toggle.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    
    @stack('scripts')

    <!-- Toast Notifications Component -->
    <x-toast />
    
    <!-- Loading Component -->
    <x-loading />

    <!-- Override browser alerts for better UX -->
    <script>
        // Override the alert function to use toast notifications instead
        window.originalAlert = window.alert;
        window.alert = function(message) {
            console.log('Alert intercepted:', message);
            
            // Check if it's a success message
            if (message.includes('✅') || message.includes('successfully') || message.includes('success')) {
                if (typeof showSuccessToast === 'function') {
                    showSuccessToast(message);
                } else if (typeof window.toastManager !== 'undefined') {
                    window.toastManager.show(message.replace('✅ ', ''), 'success');
                } else {
                    // Fallback toast
                    createCustomToast(message, 'success');
                }
            }
            // Check if it's an error message  
            else if (message.includes('❌') || message.includes('error') || message.includes('failed') || message.includes('Error')) {
                if (typeof showErrorToast === 'function') {
                    showErrorToast(message);
                } else if (typeof window.toastManager !== 'undefined') {
                    window.toastManager.show(message.replace('❌ ', ''), 'error');
                } else {
                    // Fallback toast
                    createCustomToast(message, 'error');
                }
            }
            // Default to info toast
            else {
                if (typeof showInfoToast === 'function') {
                    showInfoToast(message);
                } else if (typeof window.toastManager !== 'undefined') {
                    window.toastManager.show(message, 'info');
                } else {
                    // Fallback toast
                    createCustomToast(message, 'info');
                }
            }
        };

        // Fallback toast creator
        window.createCustomToast = function(message, type) {
            // Create container if it doesn't exist
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'fixed top-4 right-4 z-50 max-w-sm space-y-2';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            let bgColor = 'bg-blue-500';
            let icon = 'ℹ️';
            
            if (type === 'success') { bgColor = 'bg-green-500'; icon = '✅'; }
            else if (type === 'error') { bgColor = 'bg-red-500'; icon = '❌'; }
            else if (type === 'warning') { bgColor = 'bg-yellow-500'; icon = '⚠️'; }

            toast.className = `${bgColor} text-white p-4 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 ease-in-out`;
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <span class="text-lg">${icon}</span>
                    <span class="flex-1 text-sm">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-gray-200 text-lg">×</button>
                </div>
            `;

            container.appendChild(toast);

            // Show animation
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 10);

            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 5000);
        };

        console.log('Alert override installed - browser alerts will now show as toast notifications');
    </script>
</body>
</html>
