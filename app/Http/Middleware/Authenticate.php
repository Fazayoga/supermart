<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Cek apakah pengguna ingin login sebagai admin atau user
            if (Str::contains($request->path(), ['index', 'kasir', 'diskon', 'barang', 'transaksi', 'member', 'barang_exp', 'profil-admin'])) {
                return route('auth.login_admin');
            } elseif (Str::contains($request->path(), ['home', 'keranjang'])) {
                return route('auth.login_user');
            } elseif (Str::contains($request->path(), 'membership')) {
                return route('auth.login_user');
            } elseif (Str::contains($request->path(), 'point')) {
                return route('auth.login_user');
            } elseif (Str::contains($request->path(), 'profil-user')) {
                return route('auth.login_user');
            } else {
                return route('login');
            }
        }
    }
}
