<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SeparateAdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isSuper() && !$request->is('admeen*')) {
            auth()->logout();

            auth()->guard('web')->loginUsingId(auth()->id());
        }
        return $next($request);
    }
}
