<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    private function getLoggedInFaculty()
    {
        // For demo purposes, get the first faculty user
        // In a real system, this would get from session/auth
        return Faculty::first();
    }

    public function dashboard()
    {
        $faculty = $this->getLoggedInFaculty();
        return view('faculty.dashboard', compact('faculty'));
    }

    public function studentsChecklist()
    {
        $faculty = $this->getLoggedInFaculty();
        return view('faculty.students-checklist', compact('faculty'));
    }

    public function announcement()
    {
        $faculty = $this->getLoggedInFaculty();
        return view('faculty.announcement', compact('faculty'));
    }

    public function profile()
    {
        $faculty = $this->getLoggedInFaculty();
        return view('faculty.profile', compact('faculty'));
    }

    public function updateProfile(Request $request)
    {
        $faculty = $this->getLoggedInFaculty();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string|max:500',
            'office_location' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:100',
        ]);

        $faculty->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'office_location' => $request->office_location,
            'specialization' => $request->specialization,
            'education_level' => $request->education_level,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
        ]);

        return redirect()->route('faculty.profile')->with('success', 'Profile updated successfully!');
    }
}
