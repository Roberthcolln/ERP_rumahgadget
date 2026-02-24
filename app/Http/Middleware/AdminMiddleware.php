<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN (jabatan Admin ATAU id user adalah 1)
        if (auth()->check() && (auth()->user()->jabatan == 'Admin' || auth()->user()->id == 1)) {
            return $next($request);
        }

        // Jika bukan admin, tendang kembali ke index dengan pesan error
        return redirect()->route('berita.index')->with('error', 'Anda tidak memiliki akses ke fitur ini.');
    }
}
