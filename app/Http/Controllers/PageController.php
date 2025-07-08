<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function rulesGuidelines()
    {
        // Determine the current user's role and return appropriate view
        $user = Auth::user();
        
        if (!$user) {
            // If not authenticated, redirect to login
            return redirect('/');
        }
        
        // Return the rules and guidelines view
        return view('rules-guidelines');
    }
}
