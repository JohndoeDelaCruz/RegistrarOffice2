<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Completion Portal - Student Login</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/UC_Official_Seal.png') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: radial-gradient(ellipse at center, #ffffff 0%, #dbeafe 25%, #93c5fd 50%, #60a5fa 75%, #3b82f6 100%);
            font-family: Arial, sans-serif;
        }
        .header {
            background: linear-gradient(45deg, #15803d 0%, #166534 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            min-height: 50px;
        }
        .header-left, .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            font-size: 18px;
        }
        .header-center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .header-center .logo {
            font-weight: bold;
            font-size: 16px;
            color: #fbbf24;
        }
        .header-center .tagline {
            font-size: 12px;
            margin-top: 2px;
            color: #e5e7eb;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: calc(100vh - 100px);
            padding: 40px 20px 20px 20px;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            width: 100%;
            max-width: 650px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login-header {
            background: #f97316;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            border-radius: 20px 20px 0 0;
        }
        .login-form {
            padding: 50px;
            background: rgba(186, 230, 253, 0.4);
            border-radius: 0 0 20px 20px;
        }
        .form-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0 auto;
        }
        .form-table td {
            padding: 0;
            margin: 0;
        }
        .form-row-table {
            margin-bottom: 25px;
        }
        .form-row-table td {
            vertical-align: middle;
        }
        .form-row-table:first-child {
            margin-bottom: 25px;
        }
        .form-label {
            background: #0891b2;
            color: white;
            padding: 12px 18px;
            font-weight: bold;
            width: 200px;
            text-align: center;
            font-size: 16px;
            border-radius: 25px 0 0 25px;
            white-space: nowrap;
        }
        .form-input {
            width: 300px;
            padding: 12px 18px;
            border: none;
            background: #f0f9ff;
            font-size: 16px;
            outline: none;
            color: #475569;
            box-sizing: border-box;
            border-radius: 0 25px 25px 0;
        }
        .form-input::placeholder {
            color: #94a3b8;
        }
        .form-input:focus {
            background: white;
        }
        .login-btn {
            background: radial-gradient(ellipse at center, #ffffff 0%, #dbeafe 30%, #93c5fd 60%, #3b82f6 100%);
            color: #1e293b;
            border: none;
            padding: 14px 50px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            display: block;
            margin: 35px auto 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            transform: translateY(0px);
        }
        .login-btn:hover {
            background: radial-gradient(ellipse at center, #f8fafc 0%, #bfdbfe 30%, #60a5fa 60%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }
        .login-btn:active {
            transform: translateY(0px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        @media (max-width: 640px) {
            .header {
                padding: 15px 20px;
                min-height: 50px;
            }
            .header-left, .header-right {
                font-size: 14px;
            }
            .header-center .logo {
                font-size: 14px;
            }
            .header-center .tagline {
                font-size: 10px;
            }
            .form-label {
                min-width: 120px;
                font-size: 14px;
            }
            .login-card {
                margin: 10px;
            }
            .login-container {
                min-height: calc(100vh - 80px);
                padding: 20px 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
        <!-- Header -->
    <div class="header">
        <div class="header-left">
            <img src="{{ asset('images/UC_Official_Logo.png') }}" alt="University Logo" style="height: 75px; width: 250px;">
        </div>
        <div class="header-right">
            <!-- Replace 'your-logo.png' with your actual logo filename -->
            <img src="{{ asset('images/SCHOOLAUTOMATE.png') }}" alt="University Logo" style="height: 75px; width: 350px;">
        </div>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                Grade Completion Portal - Login
            </div>
            
            <form action="/login" method="POST" class="login-form">
                @csrf

                <!-- Login Form Table -->
                <div style="display: flex; justify-content: center; width: 100%; margin-top: 20px;">
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 20px;">
                        <!-- Email/ID Row -->
                        <div style="display: flex; align-items: center;">
                            <div class="form-label">Email or ID Number:</div>
                            <input 
                                type="text" 
                                name="login_id" 
                                id="login-input"
                                value="{{ old('login_id') }}"
                                placeholder="student@uc.edu.ph or 00-0000-000"
                                class="form-input"
                                required
                            >
                        </div>
                        
                        <!-- Password Row -->
                        <div style="display: flex; align-items: center;">
                            <div class="form-label">Password:</div>
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="Enter your password"
                                class="form-input"
                                required
                            >
                        </div>
                        
                        <!-- Login Button -->
                        <div style="margin-top: 15px;">
                            <button type="submit" class="login-btn">Login</button>
                        </div>

                        <!-- Info Text -->
                    
                    </div>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div style="background: #fee2e2; border: none; color: #dc2626; padding: 8px; margin-top: 15px; font-size: 13px; border-radius: 8px; text-align: center;">
                        @foreach ($errors->all() as $error)
                            <p style="margin: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div style="background: #d1fae5; border: none; color: #065f46; padding: 8px; margin-top: 15px; font-size: 13px; border-radius: 8px; text-align: center;">
                        <p style="margin: 0;">{{ session('success') }}</p>
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
