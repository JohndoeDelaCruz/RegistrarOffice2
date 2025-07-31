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
                    }
                }
            }
        }
    </script>
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
                            class="bg-btn-gradient hover:bg-btn-hover-gradient text-slate-800 font-bold 
                                   px-8 sm:px-12 py-3 sm:py-4 rounded-full text-base sm:text-lg 
                                   shadow-lg hover:shadow-xl transform hover:-translate-y-1 
                                   transition-all duration-300 mt-4">
                        Login Now
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

    <script>
        // Auto-focus on the login input for better user experience
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('login-input').focus();
        });
    </script>
</body>
</html>
