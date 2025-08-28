<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {

        if (!$request->user()) {
            abort(403, 'You do not have access to this resource.');
        }

        if ($role === 'user' && $request->user() && $request->user()->role !== 'user') {
            return redirect()->route('user.index');
        }

        if ($role === 'admin' && $request->user() && $request->user()->role !== 'admin') {
            return redirect()->route('admin.index');
        }

        return $next($request);
    }
}
