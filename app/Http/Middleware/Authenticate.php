<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Cek apakah pengguna ingin login sebagai admin atau user
            if ($request->is('index*')) {
                // If the requested URL matches '/index*' (admin routes), redirect to admin login
                return route('auth.login_admin');
            } elseif ($request->is('home*')) {
                // If the requested URL matches '/home*' (user routes), redirect to user login
                return route('auth.login_user');
            } else {
                // Jika tidak ada prefix admin atau user dalam URL, arahkan ke route login default
                return route('login');
            }
        }
    }
}
