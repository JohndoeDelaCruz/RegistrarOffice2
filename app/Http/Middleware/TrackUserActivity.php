<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Update user activity if authenticated
        if (Auth::check()) {
            Auth::user()->update(['last_activity' => Carbon::now()]);
        }
        
        // Also check for session-based authentication (for demo users)
        $userId = session('user_id');
        if ($userId && !Auth::check()) {
            $user = \App\Models\User::find($userId);
            if ($user) {
                $user->update(['last_activity' => Carbon::now()]);
            }
        }

        return $next($request);
    }
}
