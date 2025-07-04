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
            // Successful login - redirect to appropriate dashboard based on track
            if ($student->track === 'Web Technology Track') {
                return redirect('/student-webtech')->with('success', 'Login successful!');
            } elseif ($student->track === 'Network Security Track') {
                return redirect('/student-netsec')->with('success', 'Login successful!');
            } else {
                return redirect('/student/dashboard')->with('success', 'Login successful!');
            }
        }

        // Failed login
        return back()->withErrors([
            'login' => 'Invalid Student ID or Password.',
        ])->withInput($request->only('student_id'));
    }
}
