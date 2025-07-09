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
            background: #B3EBF2;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Header with UC Branding -->
    <div class="absolute top-0 left-0 right-0 bg-uc-green text-white z-20">
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

    <!-- Main Login Form -->
    <div class="mt-16 flex-1 flex items-center justify-center">
        <div class="bg-white bg-opacity-95 rounded-lg shadow-2xl p-8 w-full max-w-md">
            <!-- Header -->
            <div class="bg-uc-orange text-white text-center py-3 -mx-8 -mt-8 mb-6 rounded-t-lg">
                <h1 class="text-lg font-bold">UC Portal Login</h1>
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
                
                <!-- Login Type Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Login As:</label>
                    <div class="flex gap-2">
                        <button type="button" onclick="setLoginType('student')" id="btn-student" class="login-type-btn active bg-blue-500 text-white px-3 py-1 rounded text-sm">Student</button>
                        <button type="button" onclick="setLoginType('faculty')" id="btn-faculty" class="login-type-btn bg-gray-300 text-gray-700 px-3 py-1 rounded text-sm">Faculty</button>
                        <button type="button" onclick="setLoginType('dean')" id="btn-dean" class="login-type-btn bg-gray-300 text-gray-700 px-3 py-1 rounded text-sm">Dean</button>
                    </div>
                </div>

                <!-- Login ID Field (changes based on type) -->
                <div class="flex items-center">
                    <label id="login-label" class="bg-teal-600 text-white py-2 px-4 rounded-l-lg text-sm font-medium w-32 text-center">
                        Student ID
                    </label>
                    <input 
                        type="text" 
                        name="login_id" 
                        id="login-input"
                        value="{{ old('login_id') }}"
                        placeholder="01-2345-678"
                        class="flex-1 py-2 px-3 border border-l-0 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-uc-blue focus:border-transparent @error('login_id') border-red-500 @enderror"
                        required
                    >
                </div>

                <!-- Hidden field to track login type -->
                <input type="hidden" name="login_type" id="login-type" value="student">

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
    <div class="fixed bottom-0 left-0 right-0 bg-uc-green text-white text-center py-2 z-20">
        <div class="flex justify-center items-center gap-4">
            <i class="fas fa-university text-lg"></i>
            <span class="font-semibold">UNIVERSITY OF THE CORDILLERAS</span>
            <i class="fas fa-university text-lg"></i>
        </div>
    </div>

    <script>
        function setLoginType(type) {
            // Update hidden field
            document.getElementById('login-type').value = type;
            
            // Update button styles
            document.querySelectorAll('.login-type-btn').forEach(btn => {
                btn.classList.remove('bg-blue-500', 'text-white');
                btn.classList.add('bg-gray-300', 'text-gray-700');
            });
            
            document.getElementById('btn-' + type).classList.remove('bg-gray-300', 'text-gray-700');
            document.getElementById('btn-' + type).classList.add('bg-blue-500', 'text-white');
            
            // Update label and placeholder
            const label = document.getElementById('login-label');
            const input = document.getElementById('login-input');
            
            switch(type) {
                case 'student':
                    label.textContent = 'Student ID';
                    input.placeholder = '01-2345-678';
                    input.type = 'text';
                    break;
                case 'faculty':
                    label.textContent = 'Email/ID';
                    input.placeholder = 'faculty@uc.edu.ph or FAC-2020-001';
                    input.type = 'text';
                    break;
                case 'dean':
                    label.textContent = 'Email/ID';
                    input.placeholder = 'dean@uc.edu.ph or DEAN-2025-001';
                    input.type = 'text';
                    break;
            }
        }
    </script>
</body>
</html>
