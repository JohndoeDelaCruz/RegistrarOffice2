<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
            'login_type' => 'required|in:student,faculty,dean',
        ]);

        $user = null;
        $loginType = $request->login_type;

        // Find user based on login type
        if ($loginType === 'student') {
            $user = User::where('student_id', $request->login_id)
                       ->where('role', 'student')
                       ->first();
        } else {
            // For faculty and dean, check both email and student_id (which contains their ID number)
            $user = User::where('role', $loginType)
                       ->where(function($query) use ($request) {
                           $query->where('email', $request->login_id)
                                 ->orWhere('student_id', $request->login_id);
                       })
                       ->first();
        }

        if ($user && Hash::check($request->password, $user->password)) {
            // Use Laravel's built-in authentication
            auth()->login($user);
            
            // Also store in session for backward compatibility
            session([
                'user_id' => $user->id,
                'user_role' => $user->role
            ]);
            
            // Redirect based on role
            switch ($user->role) {
                case 'student':
                    return redirect('/student/dashboard')->with('success', 'Login successful!');
                case 'faculty':
                    return redirect('/faculty/dashboard')->with('success', 'Login successful!');
                case 'dean':
                    return redirect('/dean/dashboard')->with('success', 'Login successful!');
                case 'admin':
                    return redirect('/admin/dashboard')->with('success', 'Login successful!');
                default:
                    return redirect('/student/dashboard')->with('success', 'Login successful!');
            }
        }

        // Failed login
        return back()->withErrors([
            'login' => 'Invalid credentials or user type.',
        ])->withInput($request->only('login_id', 'login_type'));
    }

    public function logout(Request $request)
    {
        // Logout from Laravel's built-in auth
        auth()->logout();
        
        // Clear all user session data
        session()->forget(['user_id', 'user_role', 'student_id']);
        session()->flush();
        
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
  

