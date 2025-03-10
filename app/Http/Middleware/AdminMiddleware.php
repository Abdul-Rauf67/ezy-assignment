<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
{
    if (Auth::check()) {

        /** @var \App\Models\User */

        $user = Auth::user();
        // Check if the user has any administrative role
        if ($user->hasRole(['super-admin', 'admin', 'partner'])) {
            return $next($request);
        }
        abort(403, "User does not have correct ROLE");
    }
    abort(401);
}

}
