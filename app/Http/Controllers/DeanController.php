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
        // First try to get from Laravel's built-in auth
        if (auth()->check() && auth()->user()->role === 'dean') {
            return auth()->user();
        }
        
        // Then try to get from session
        $userId = session('user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user && $user->role === 'dean') {
                return $user;
            }
        }
        
        // Fallback for demo purposes - this should ideally redirect to login
        return User::where('role', 'dean')->first();
    }
}
