<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Dean Dashboard') - UC Registrar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uc-green': '#2d7738',
                        'uc-blue': '#1e40af',
                        'uc-orange': '#ea580c',
                        'dean-purple': '#7c3aed',
                        'dean-indigo': '#4f46e5',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-dean-purple to-purple-800 text-white w-64 flex-shrink-0 shadow-xl">
            <!-- Header -->
            <div class="p-6 border-b border-purple-600">
                <div class="flex items-center space-x-3">
                    <div class="bg-white p-2 rounded-lg">
                        <i class="fas fa-university text-dean-purple text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">UC Registrar</h1>
                        <p class="text-purple-200 text-sm">Dean Portal</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <div class="px-6 mb-4">
                    <h2 class="text-xs uppercase tracking-wider text-purple-300 font-semibold">Main Menu</h2>
                </div>
                
                <a href="{{ route('dean.dashboard') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-600 transition-colors duration-200 {{ request()->routeIs('dean.dashboard') ? 'bg-purple-600 border-r-4 border-purple-300' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('dean.digital-signature') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-600 transition-colors duration-200 {{ request()->routeIs('dean.digital-signature') ? 'bg-purple-600 border-r-4 border-purple-300' : '' }}">
                    <i class="fas fa-signature w-5 h-5 mr-3"></i>
                    <span>Digital Signature</span>
                </a>

                <a href="{{ route('dean.announcement') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-600 transition-colors duration-200 {{ request()->routeIs('dean.announcement') ? 'bg-purple-600 border-r-4 border-purple-300' : '' }}">
                    <i class="fas fa-bullhorn w-5 h-5 mr-3"></i>
                    <span>Announcements</span>
                </a>

                <a href="{{ route('dean.profile') }}" class="flex items-center px-6 py-3 text-white hover:bg-purple-600 transition-colors duration-200 {{ request()->routeIs('dean.profile') ? 'bg-purple-600 border-r-4 border-purple-300' : '' }}">
                    <i class="fas fa-user w-5 h-5 mr-3"></i>
                    <span>Profile</span>
                </a>
            </nav>

            <!-- Footer -->
            <div class="absolute bottom-0 w-64 p-6 border-t border-purple-600">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-white hover:bg-purple-600 rounded-lg transition-colors duration-200">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-gray-600 text-sm">Dean Administrative System</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                <div class="w-8 h-8 bg-gradient-to-br from-dean-purple to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-white">D</span>
                                </div>
                                <span class="font-medium">Dean User</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle (for future mobile responsiveness) -->
    <script>
        // Add mobile menu toggle functionality here if needed
    </script>
</body>
</html>
