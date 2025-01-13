<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if(!Auth::check()) {
            abort(403, 'Acesso não autorizado.');
        }

         $user = Auth::user();
         
         if (!$user instanceof User || !$user->hasRole($role)) {
            abort(403, 'Acesso não autorizado.');
         }

        return $next($request);
    }
}