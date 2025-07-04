<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DeanController extends Controller
{
    public function dashboard()
    {
        // Get the logged-in dean user
        $dean = $this->getLoggedInDean();
        return view('dean.dashboard', compact('dean'));
    }

    public function digitalSignature()
    {
        $dean = $this->getLoggedInDean();
        return view('dean.digital-signature', compact('dean'));
    }

    public function announcement()
    {
        $dean = $this->getLoggedInDean();
        return view('dean.announcement', compact('dean'));
    }

    public function profile()
    {
        $dean = $this->getLoggedInDean();
        return view('dean.profile', compact('dean'));
    }

    /**
     * Get the currently logged-in dean user
     */
    private function getLoggedInDean()
    {
        $userId = session('user_id');
        if (!$userId) {
            // If no user is logged in, redirect to login
            return redirect('/')->with('error', 'Please log in to access this page.');
        }

        $dean = User::where('id', $userId)
                   ->where('role', 'dean')
                   ->first();

        if (!$dean) {
            // If user is not a dean, redirect to login
            return redirect('/')->with('error', 'Access denied. Dean role required.');
        }

        return $dean;
    }
}
