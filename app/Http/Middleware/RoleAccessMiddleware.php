<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RoleAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        // Verifica si el rol actual del usuario es igual al rol necesario
        if ($user->activeRole && $user->activeRole->name === $role) {
            return $next($request);
        }

        // Redirige a una página de acceso no autorizado
        return redirect('/noacces');
    }
}
