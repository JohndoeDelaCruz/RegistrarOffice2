<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title', 'Faculty Dashboard') - Grade Completion Portal</title>
    
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
                        'uc-green': '#15803d',
                        'uc-green-dark': '#166534',
                        'uc-blue': '#1e40af',
                        'uc-orange': '#ea580c',
                        'uc-bg': '#b8e6c1',
                    },
                    backgroundImage: {
                        'header-gradient': 'linear-gradient(45deg, #15803d 0%, #166534 100%)',
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
    <div class="bg-header-gradient text-white px-6 sm:px-8 py-5 flex flex-col sm:flex-row justify-between items-center fixed top-0 left-0 right-0 z-50 min-h-[80px] sm:min-h-[100px]">
        <div class="flex items-center gap-3 mb-2 sm:mb-0">
            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden p-1 rounded hover:bg-white/10 transition-colors mr-2">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <img src="{{ asset('images/UC_Official_Logo.png') }}" alt="University Logo" 
                 class="h-12 sm:h-16 lg:h-[75px] w-auto max-w-[200px] sm:max-w-[250px]">
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/SCHOOLAUTOMATE.png') }}" alt="SchoolAutomate Logo" 
                 class="h-12 sm:h-16 lg:h-[75px] w-auto max-w-[250px] sm:max-w-[350px]">
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <div style="background: #6393c1;" class="text-white w-64 h-screen fixed left-0 top-[80px] sm:top-[100px] overflow-y-auto hidden lg:block z-30 shadow-xl">
        <!-- Header -->
        <div class="p-6 border-b border-green-600">
            <div class="flex items-center space-x-3">
                <div class="bg-white p-2 rounded-lg">
                    <img src="{{ asset('images/UC_Official_Seal.png') }}" alt="University Logo" class="h-6 w-auto">
                </div>
                <div>
                    <h1 class="text-xl font-bold">Grade Completion Portal</h1>
                    <p class="text-green-200 text-sm">Faculty Portal</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-0">
            <a href="{{ route('faculty.dashboard') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-bold">Dashboard</span>
            </a>

            <a href="{{ route('faculty.students-checklist') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.students-checklist') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-list-check w-5 text-center"></i>
                <span class="font-bold">Students' Checklist</span>
            </a>

            <a href="{{ route('faculty.grade-management') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.grade-management') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span class="font-bold">Grade Management</span>
            </a>

            <a href="{{ route('faculty.grade-completion-applications') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.grade-completion-applications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-file-signature w-5 text-center"></i>
                <span class="font-bold">Grade Completion</span>
            </a>

            <a href="{{ route('faculty.announcement') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.announcement') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="font-bold">Announcements</span>
            </a>

            <a href="{{ route('faculty.notifications') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.notifications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bell w-5 text-center"></i>
                <span class="font-bold">Notifications</span>
                <span id="notification-badge" class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full hidden"></span>
            </a>

            <a href="{{ route('rules-guidelines') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('rules-guidelines') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-bold">Rules & Guidelines</span>
            </a>

            <a href="{{ route('faculty.profile') }}" class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.profile') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
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
    <div id="mobile-sidebar" style="background: #6393c1;" class="sidebar-mobile text-white w-64 h-screen fixed left-0 top-[80px] sm:top-[100px] overflow-y-auto lg:hidden z-50 shadow-xl">
        <!-- Header -->
        <div class="p-6 border-b border-green-600">
            <div class="flex items-center space-x-3">
                <div class="bg-white p-2 rounded-lg">
                    <img src="{{ asset('images/UC_Official_Seal.png') }}" alt="University Logo" class="h-6 w-auto">
                </div>
                <div>
                    <h1 class="text-xl font-bold">Grade Completion Portal</h1>
                    <p class="text-green-200 text-sm">Faculty Portal</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-0">
            <a href="{{ route('faculty.dashboard') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-bold">Dashboard</span>
            </a>

            <a href="{{ route('faculty.students-checklist') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.students-checklist') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-list-check w-5 text-center"></i>
                <span class="font-bold">Students' Checklist</span>
            </a>

            <a href="{{ route('faculty.grade-management') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.grade-management') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span class="font-bold">Grade Management</span>
            </a>

            <a href="{{ route('faculty.grade-completion-applications') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.grade-completion-applications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-file-signature w-5 text-center"></i>
                <span class="font-bold">Grade Completion</span>
            </a>

            <a href="{{ route('faculty.announcement') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.announcement') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="font-bold">Announcements</span>
            </a>

            <a href="{{ route('faculty.notifications') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.notifications') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-bell w-5 text-center"></i>
                <span class="font-bold">Notifications</span>
                <span id="mobile-notification-badge" class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full hidden"></span>
            </a>

            <a href="{{ route('rules-guidelines') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('rules-guidelines') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-bold">Rules & Guidelines</span>
            </a>

            <a href="{{ route('faculty.profile') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('faculty.profile') ? 'bg-white/15 text-white border-l-4 border-l-teal-300' : '' }}">
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
    <div class="lg:ml-64 pt-[80px] sm:pt-[100px] min-h-screen bg-custom">
        <!-- Content Header -->
        <div class="bg-white px-4 sm:px-6 lg:px-8 py-4 lg:py-5 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl sm:text-2xl font-semibold text-uc-green">@yield('page-title', 'Faculty Dashboard')</h1>
                    <p class="text-sm text-gray-600 mt-1">Faculty Management System</p>
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
