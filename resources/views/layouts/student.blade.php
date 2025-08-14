<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Dashboard - Grade Completion Portal</title>
    
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
    
    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
        <nav class="mt-4">
            <a href="{{ route('student.dashboard') }}" 
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-bold">Dashboard</span>
            </a>
            
            <a href="{{ route('student.announcement') }}" 
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.announcement') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="font-bold">Announcements</span>
            </a>
            
            <a href="{{ route('student.grade-completion') }}" 
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.grade-completion') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span class="font-bold">Grade Completion</span>
            </a>
            
            <a href="{{ route('rules-guidelines') }}" 
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('rules-guidelines') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-bold">Rules & Guidelines</span>
            </a>
            
            <a href="{{ route('student.profile') }}" 
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.profile') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
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
    <div id="mobile-sidebar" style="background: #6393c1;" class="sidebar-mobile text-white w-64 h-screen fixed left-0 top-[80px] sm:top-[100px] overflow-y-auto lg:hidden z-50 shadow-xl">
        <nav class="mt-4">
            <a href="{{ route('student.dashboard') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.dashboard') ? 'bg-white/15 text-white border-l-4 border-l-orange-300' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="font-bold">Dashboard</span>
            </a>
            
            <a href="{{ route('student.announcement') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.announcement') ? 'bg-white/15 text-white border-l-4 border-l-green-300' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="font-bold">Announcements</span>
            </a>
            
            <a href="{{ route('student.grade-completion') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.grade-completion') ? 'bg-white/15 text-white border-l-4 border-l-green-300' : '' }}">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span class="font-bold">Grade Completion</span>
            </a>
            
            <a href="{{ route('rules-guidelines') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('rules-guidelines') ? 'bg-white/15 text-white border-l-4 border-l-green-300' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-bold">Rules & Guidelines</span>
            </a>
            
            <a href="{{ route('student.profile') }}" 
               onclick="closeMobileMenu()"
               class="flex items-center gap-3 px-6 py-4 text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200 border-b border-white/10 {{ request()->routeIs('student.profile') ? 'bg-white/15 text-white border-l-4 border-l-green-300' : '' }}">
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
                    <h1 class="text-xl sm:text-2xl font-semibold text-uc-green">@yield('page-title', 'Student Dashboard')</h1>
                    @isset($student)
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $student->course }} - {{ $student->track }} | ID: {{ $student->student_id }}
                        </p>
                    @endisset
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
    </script>

    <!-- Toast Notifications Component -->
    <x-toast />
    
    <!-- Loading Component -->
    <x-loading />
</body>
</html>
