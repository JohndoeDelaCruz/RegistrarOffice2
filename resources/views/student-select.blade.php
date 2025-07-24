<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UC Registrar - Student Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: #0284c7;
            font-family: Arial, sans-serif;
        }
        .header {
            background: linear-gradient(45deg, #15803d 0%, #166534 100%);
            color: white;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .header-left, .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            font-size: 16px;
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
            font-size: 14px;
            color: #fbbf24;
        }
        .header-center .tagline {
            font-size: 10px;
            margin-top: 1px;
            color: #e5e7eb;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 65px);
            padding: 20px;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            width: 100%;
            max-width: 650px;
            overflow: hidden;
        }
        .login-header {
            background: #f97316;
            color: white;
            padding: 16px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .login-form {
            padding: 40px;
            background: rgba(186, 230, 253, 0.4);
            border-radius: 8px;
        }
        .login-types {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-type-btn {
            background: #e5e7eb;
            color: #374151;
            border: none;
            padding: 8px 15px;
            margin: 0 2px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }
        .login-type-btn.active {
            background: #1d4ed8;
            color: white;
        }
        .form-table {
            width: 100%;
            border-collapse: collapse;
        }
        .form-table td {
            padding: 0;
            margin: 0;
        }
        .form-row-table {
            margin-bottom: 10px;
        }
        .form-label {
            background: #0891b2;
            color: white;
            padding: 12px 18px;
            font-weight: bold;
            width: 45%;
            text-align: right;
            font-size: 16px;
        }
        .form-input {
            width: 55%;
            padding: 12px 18px;
            border: none;
            background: #f0f9ff;
            font-size: 16px;
            outline: none;
            color: #475569;
            box-sizing: border-box;
        }
        .form-input::placeholder {
            color: #94a3b8;
        }
        .form-input:focus {
            background: white;
        }
        .login-btn {
            background: linear-gradient(180deg, #c7d2fe 0%, #818cf8 100%);
            color: #1e293b;
            border: none;
            padding: 12px 40px;
            border-radius: 6px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            display: block;
            margin: 25px auto 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .login-btn:hover {
            background: linear-gradient(180deg, #818cf8 0%, #c7d2fe 100%);
        }
        @media (max-width: 640px) {
            .header-left, .header-right {
                font-size: 14px;
            }
            .header-center .logo {
                font-size: 12px;
            }
            .header-center .tagline {
                font-size: 9px;
            }
            .form-label {
                min-width: 120px;
                font-size: 14px;
            }
            .login-card {
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <i class="fas fa-university"></i>
            <span>UNIVERSITY OF THE CORDILLERAS</span>
        </div>
        <div class="header-center">
            <div class="logo">SchoolAutomate®</div>
            <div class="tagline">Integrating technology to advance education</div>
        </div>
        <div class="header-right">
            <span>UNIVERSITY OF THE CORDILLERAS</span>
            <i class="fas fa-university"></i>
        </div>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                Student/Parent/New Student Login
            </div>
            
            <form action="/student-login" method="POST" class="login-form">
                @csrf

                <!-- Login Type Selection -->
                <div class="login-types">
                    <button type="button" onclick="setLoginType('student')" id="btn-student" class="login-type-btn active">Student</button>
                    <button type="button" onclick="setLoginType('faculty')" id="btn-faculty" class="login-type-btn">Faculty</button>
                    <button type="button" onclick="setLoginType('dean')" id="btn-dean" class="login-type-btn">Dean</button>
                    <button type="button" onclick="setLoginType('admin')" id="btn-admin" class="login-type-btn">Admin</button>
                </div>

                <!-- Hidden field to track login type -->
                <input type="hidden" name="login_type" id="login-type" value="student">

                <!-- Login Form Table -->
                <table class="form-table">
                    <tr class="form-row-table">
                        <td class="form-label" id="login-label">Student ID Number:</td>
                        <td>
                            <input 
                                type="text" 
                                name="login_id" 
                                id="login-input"
                                value="{{ old('login_id') }}"
                                placeholder="00-0000-000"
                                class="form-input"
                                required
                            >
                        </td>
                    </tr>
                    <tr class="form-row-table">
                        <td class="form-label">Password:</td>
                        <td>
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="******"
                                class="form-input"
                                required
                            >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; padding-top: 15px;">
                            <button type="submit" class="login-btn">Login Now</button>
                        </td>
                    </tr>
                </table>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div style="background: #fee2e2; border: none; color: #dc2626; padding: 8px; margin-top: 15px; font-size: 13px;">
                        @foreach ($errors->all() as $error)
                            <p style="margin: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        function setLoginType(type) {
            // Update hidden field
            document.getElementById('login-type').value = type;
            
            // Update button styles
            document.querySelectorAll('.login-type-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            document.getElementById('btn-' + type).classList.add('active');
            
            // Update label and placeholder
            const label = document.getElementById('login-label');
            const input = document.getElementById('login-input');
            
            switch(type) {
                case 'student':
                    label.textContent = 'Student ID Number:';
                    input.placeholder = '00-0000-000';
                    input.type = 'text';
                    break;
                case 'faculty':
                    label.textContent = 'Email/ID:';
                    input.placeholder = 'faculty@uc.edu.ph or FAC-2020-001';
                    input.type = 'text';
                    break;
                case 'dean':
                    label.textContent = 'Email/ID:';
                    input.placeholder = 'dean@uc.edu.ph or DEAN-2025-001';
                    input.type = 'text';
                    break;
                case 'admin':
                    label.textContent = 'Email/ID:';
                    input.placeholder = 'admin@uc.edu.ph or ADM-2025-001';
                    input.type = 'text';
                    break;
            }
        }
    </script>
</body>
</html>
