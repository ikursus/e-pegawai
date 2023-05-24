<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role != User::ROLE_ADMIN)
        {
            return redirect()->route('dashboard')
            ->with('type', 'danger')
            ->with('message', 'Anda tidak mempunyai kebenaran untuk membuka halaman admin');
        }

        return $next($request);
    }
}
