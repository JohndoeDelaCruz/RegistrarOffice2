<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function dashboard()
    {
        // For demo purposes, get the first student user
        $student = User::whereNotNull('track')->first();
        return view('student.dashboard', compact('student'));
    }

    public function announcement()
    {
        $student = User::whereNotNull('track')->first();
        return view('student.announcement', compact('student'));
    }

    public function gradeCompletion()
    {
        $student = User::whereNotNull('track')->first();
        return view('student.grade-completion', compact('student'));
    }

    public function profile()
    {
        $student = User::whereNotNull('track')->first();
        return view('student.profile', compact('student'));
    }

    public function checklist()
    {
        $student = User::whereNotNull('track')->first();
        return view('student.checklist', compact('student'));
    }
}
