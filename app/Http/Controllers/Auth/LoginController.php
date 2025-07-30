<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        // Automatically find user by email or student_id (works for all user types)
        // This allows students, faculty, dean, and admin to use either their email or ID
        $user = User::where('email', $request->login_id)
                   ->orWhere('student_id', $request->login_id)
                   ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Use Laravel's built-in authentication
            Auth::login($user);
            
            // Also store in session for backward compatibility
            session([
                'user_id' => $user->id,
                'user_role' => $user->role
            ]);
            
            // Automatically redirect to appropriate dashboard based on user's role
            switch ($user->role) {
                case 'student':
                    return redirect('/student/dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
                case 'faculty':
                    return redirect('/faculty/dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
                case 'dean':
                    return redirect('/dean/dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
                case 'admin':
                    return redirect('/admin/dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
                default:
                    // Fallback to student dashboard if role is undefined
                    return redirect('/student/dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
            }
        }

        // Failed login - more user-friendly error message
        return back()->withErrors([
            'login' => 'Invalid email/ID or password. Please check your credentials and try again.',
        ])->withInput($request->only('login_id'));
    }

    public function logout(Request $request)
    {
        // Logout from Laravel's built-in auth
        Auth::logout();
        
        // Clear all user session data
        session()->forget(['user_id', 'user_role', 'student_id']);
        session()->flush();
        
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
  

