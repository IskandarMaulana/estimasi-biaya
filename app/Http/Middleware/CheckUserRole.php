<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!session('logged_in')) {
            return redirect('login')
                ->with('error', 'Silahkan login terlebih dahulu.');
        }
        
        // Cek apakah role user sesuai
        if (!in_array(session('role'), $roles)) {
            return redirect('dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
        
        return $next($request);
    }
}