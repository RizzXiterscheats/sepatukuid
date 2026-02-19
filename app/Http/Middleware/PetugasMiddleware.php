<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetugasMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if (!$user->isPetugas() && !$user->isAdmin()) {
            abort(403, 'Hanya petugas/admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}