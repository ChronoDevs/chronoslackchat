<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = config('const.user_role.admin');
        
        if (Auth::check()) {
            if (Auth::user()->role_id == $admin) {
                return $next($request);
            }
        }

        return redirect()->route('web.auth.login');
    }
}
