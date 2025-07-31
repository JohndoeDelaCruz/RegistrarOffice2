<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title', 'Dean Dashboard') - Grade Completion Portal</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/UC_Official_Seal.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uc-green': '#2d7738',
                        'uc-green-dark': '#1e5226',
                        'uc-blue': '#1e40af',
                        'uc-orange': '#ea580c',
                        'uc-green-light': '#4ade80',
                        'uc-bg': '#b8e6c1',
                    }
                }
            }
        }
    </script>
    
    <style>
        .sidebar-mobile {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-mobile.open {
            transform: translateX(0);
        }
        .mobile-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }
        .mobile-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        .bg-custom { background-color: #95bce2; }
    </style>
</head>
<body class="font-inter bg-custom min-h-screen">
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="mobile-overlay fixed inset-0 bg-black/50 z-40 lg:hidden" onclick="toggleMobileMenu()"></div>

    <!-- Top Header -->
    <div class="bg-uc-green text-white px-8 py-5 flex justify-between items-center fixed top-0 left-0 right-0 z-50 min-h-16">
        <div class="flex items-center gap-3">
            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden p-1 rounded hover:bg-white/10 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <img src="{{ asset('images/UC_Official_Seal.png') }}" alt="University Logo" class="h-8 w-auto">
            <span class="font-semibold text-xl">Grade Completion Portal</span>
        </div>
        <div class="flex items-center gap-2 relative">
            <span class="text-sm font-medium hidden sm:block">
                {{ auth()->user()->name ?? 'Dean User' }}
            </span>
            <span class="text-sm font-medium sm:hidden">
                {{ explode(' ', auth()->user()->name ?? 'Dean User')[0] }}
            </span>
            <button onclick="toggleUserDropdown()" class="p-1 rounded hover:bg-white/10 transition-colors">
                <i class="fas fa-chevron-down"></i>
            </button>
            
            <!-- User Dropdown Menu -->
            <div id="userDropdown" class="absolute top-full right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 hidden z-50">
                <div class="py-1">
                    <a href="{{ route('dean.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-3 w-4 h-4"></i>
                        Profile
                    </a>
                    <div class="border-t border-gray-100"></div>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                            <i class="fas fa-sign-out-alt mr-3 w-4 h-4"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <div style="background: #6393c1;" class="text-white w-64 h-screen fixed left-0 top-16 overflow-y-auto hidden lg:block z-30 shadow-xl">
        <!-- Header -->
        <div class="p-6 border-b border-green-600">
            <div class="flex items-center space-x-3">
                <div class="bg-white p-2 rounded-lg">
                    <img src="{{ asset('images/UC_Official_Seal.png') }}" alt="University Logo" class="h-6 w-auto">
                </div>
                <div>
                    <h1 class="text-xl font-bold">Grade Completion Portal</h1>
                    <p class="text-green-200 text-sm">Dean Portal</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-0">
            <div class="px-6 py-4">
                <h2 class="text-xs uppercase tracking-wider text-green-300 font-semibold">Main Menu</h2>
            </div>
            
            <a href="{{ route('dean.dashboard') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-bold">Dashboard</span>
            </a>

            <a href="{{ route('dean.grade-completion-applications') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.grade-completion-applications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-file-alt w-5 text-center"></i>
                <span class="font-bold">Grade Completion Applications</span>
            </a>

            <a href="{{ route('dean.approved-applications') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.approved-applications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-check-circle w-5 text-center"></i>
                <span class="font-bold">Reviewed Applications</span>
            </a>

            <a href="{{ route('dean.announcement') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.announcement') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="font-bold">Announcements</span>
            </a>

            <a href="{{ route('dean.notifications') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.notifications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bell w-5 text-center"></i>
                <span class="font-bold">Notifications</span>
                @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                    <span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center ml-auto">
                        {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('rules-guidelines') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('rules-guidelines') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-bold">Rules & Guidelines</span>
            </a>

            <a href="{{ route('dean.profile') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.profile') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-user w-5 text-center"></i>
                <span class="font-bold">Profile</span>
            </a>
            
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span class="font-bold">Log Out</span>
            </a>
        </nav>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobile-sidebar" style="background: #6393c1;" class="sidebar-mobile text-white w-64 h-screen fixed left-0 top-16 overflow-y-auto lg:hidden z-50 shadow-xl">
        <!-- Header -->
        <div class="p-6 border-b border-green-600">
            <div class="flex items-center space-x-3">
                <div class="bg-white p-2 rounded-lg">
                    <img src="{{ asset('images/UC_Official_Seal.png') }}" alt="University Logo" class="h-6 w-auto">
                </div>
                <div>
                    <h1 class="text-xl font-bold">Grade Completion Portal</h1>
                    <p class="text-green-200 text-sm">Dean Portal</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-0">
            <div class="px-6 py-4">
                <h2 class="text-xs uppercase tracking-wider text-green-300 font-semibold">Main Menu</h2>
            </div>
            
            <a href="{{ route('dean.dashboard') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-bold">Dashboard</span>
            </a>

            <a href="{{ route('dean.grade-completion-applications') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.grade-completion-applications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-file-alt w-5 text-center"></i>
                <span class="font-bold">Grade Completion Applications</span>
            </a>

            <a href="{{ route('dean.approved-applications') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.approved-applications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-check-circle w-5 text-center"></i>
                <span class="font-bold">Approved Applications</span>
            </a>

            <a href="{{ route('dean.announcement') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.announcement') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="font-bold">Announcements</span>
            </a>

            <a href="{{ route('dean.notifications') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.notifications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bell w-5 text-center"></i>
                <span class="font-bold">Notifications</span>
                @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                    <span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center ml-auto">
                        {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('rules-guidelines') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('rules-guidelines') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-bold">Rules & Guidelines</span>
            </a>

            <a href="{{ route('dean.profile') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('dean.profile') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-user w-5 text-center"></i>
                <span class="font-bold">Profile</span>
            </a>
            
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit(); closeMobileMenu();" 
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span class="font-bold">Log Out</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64 pt-20 min-h-screen bg-custom">
        <!-- Content Header -->
        <div class="bg-white px-4 sm:px-6 lg:px-8 py-4 lg:py-5 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl sm:text-2xl font-semibold text-uc-green">@yield('page-title', 'Dean Dashboard')</h1>
                    <p class="text-sm text-gray-600 mt-1">Dean Administrative System</p>
                </div>
            </div>
        </div>
        
        <!-- Content Body -->
        <div class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </div>
    </div>

    <!-- Forms -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- JavaScript for Mobile Menu -->
    <script>
        function toggleMobileMenu() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('mobile-overlay');
            
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }

        function closeMobileMenu() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('mobile-overlay');
            
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('mobile-overlay');
            const menuButton = event.target.closest('[onclick="toggleMobileMenu()"]');
            
            if (!sidebar.contains(event.target) && !menuButton && sidebar.classList.contains('open')) {
                closeMobileMenu();
            }
        });

        // Close mobile menu on window resize if large screen
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                closeMobileMenu();
            }
        });

        // User dropdown functionality
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close user dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userButton = event.target.closest('[onclick="toggleUserDropdown()"]');
            
            if (!dropdown.contains(event.target) && !userButton && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- Toast Notifications Component -->
    <x-toast />
    
    <!-- Loading Component -->
    <x-loading />
</body>
</html>
