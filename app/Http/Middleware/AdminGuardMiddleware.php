<?php

namespace App\Http\Middleware;

use Closure;

class AdminGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('full_name')) 
            return redirect()->away('http://ecommerce5/ipc_central/main_home.php');

        return $next($request);
    }
}
