<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,  ...$roles): Response
    {
        if ($request->user() === null) {
            throw UnauthorizedException::notLoggedIn();
        }

        $roles = is_array($roles) ? $roles : array_slice(func_get_args(), 2);

        if ($request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        throw UnauthorizedException::forRoles($roles);
    }
}
