<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeanController extends Controller
{
    public function dashboard()
    {
        return view('dean.dashboard');
    }

    public function digitalSignature()
    {
        return view('dean.digital-signature');
    }

    public function announcement()
    {
        return view('dean.announcement');
    }

    public function profile()
    {
        return view('dean.profile');
    }
}
