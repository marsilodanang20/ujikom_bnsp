<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // admin has full access
        if ($user->role === 'admin') {
            return $next($request);
        }

        // if role matches exactly (e.g., users trying to access users route)
        if ($user->role === $role) {
            return $next($request);
        }

        // If 'users' role tries to access something other than allowed, redirect to /pendaftaran
        if ($user->role === 'users') {
            return redirect()->route('pendaftaran.index')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        // Default deny all
        return redirect()->route('login')->with('error', 'Akses ditolak.');
    }
}
