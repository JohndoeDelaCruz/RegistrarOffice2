<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find student by student_id
        $student = User::where('student_id', $request->student_id)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            // Store the logged-in student ID in session
            session(['student_id' => $student->id]);
            
            // Successful login - redirect to dashboard
            return redirect('/student/dashboard')->with('success', 'Login successful!');
        }

        // Failed login
        return back()->withErrors([
            'login' => 'Invalid Student ID or Password.',
        ])->withInput($request->only('student_id'));
    }

    public function logout(Request $request)
    {
        // Clear the student session
        session()->forget('student_id');
        session()->flush();
        
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
