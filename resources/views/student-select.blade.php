<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UC Registrar - Student Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uc-green': '#2d7738',
                        'uc-blue': '#1e40af',
                        'uc-orange': '#ea580c',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Header with UC Branding -->
    <div class="absolute top-0 left-0 right-0 bg-uc-green text-white">
        <div class="flex justify-between items-center px-6 py-3">
            <div class="flex items-center gap-3">
                <i class="fas fa-university text-xl"></i>
                <span class="font-bold text-lg">UNIVERSITY OF THE CORDILLERAS</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm">SchoolAutomate®</span>
                <span class="text-xs">Integrating technology to advance education</span>
            </div>
        </div>
    </div>

    <!-- Side Navigation -->
    <div class="fixed left-0 top-16 bottom-0 w-48 bg-teal-700">
        <div class="p-4">
            <button class="w-full bg-uc-orange text-white py-2 px-4 rounded mb-2 text-sm font-medium">
                Home
            </button>
            <button class="w-full bg-uc-blue text-white py-2 px-4 rounded mb-2 text-sm font-medium">
                Login
            </button>
            <button class="w-full bg-teal-600 text-white py-2 px-4 rounded text-sm font-medium">
                Admission
            </button>
        </div>
    </div>

    <!-- Main Login Form -->
    <div class="ml-48 mt-16 flex-1 flex items-center justify-center">
        <div class="bg-white bg-opacity-95 rounded-lg shadow-2xl p-8 w-full max-w-md">
            <!-- Header -->
            <div class="bg-uc-orange text-white text-center py-3 -mx-8 -mt-8 mb-6 rounded-t-lg">
                <h1 class="text-lg font-bold">Student/Parent/New Student Login</h1>
            </div>

            <!-- Login Form -->
            <form action="/student-login" method="POST" class="space-y-6">
                @csrf
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Success Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                @endif
                
                <!-- Student ID Field -->
                <div class="flex items-center">
                    <label class="bg-teal-600 text-white py-2 px-4 rounded-l-lg text-sm font-medium w-32 text-center">
                        Student ID Number
                    </label>
                    <input 
                        type="text" 
                        name="student_id" 
                        value="{{ old('student_id') }}"
                        placeholder="22-2014-166"
                        class="flex-1 py-2 px-3 border border-l-0 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-uc-blue focus:border-transparent @error('student_id') border-red-500 @enderror"
                        required
                    >
                </div>

                <!-- Password Field -->
                <div class="flex items-center">
                    <label class="bg-teal-600 text-white py-2 px-4 rounded-l-lg text-sm font-medium w-32 text-center">
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="••••••••"
                        class="flex-1 py-2 px-3 border border-l-0 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-uc-blue focus:border-transparent @error('password') border-red-500 @enderror"
                        required
                    >
                </div>

                <!-- Login Button -->
                <div class="text-center pt-4">
                    <button 
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-8 rounded-lg font-medium transition-colors duration-200 shadow-lg"
                    >
                        Login Now
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Branding -->
    <div class="fixed bottom-0 left-48 right-0 bg-uc-green text-white text-center py-2">
        <div class="flex justify-center items-center gap-4">
            <i class="fas fa-university text-lg"></i>
            <span class="font-semibold">UNIVERSITY OF THE CORDILLERAS</span>
            <i class="fas fa-university text-lg"></i>
        </div>
    </div>
</body>
</html>
