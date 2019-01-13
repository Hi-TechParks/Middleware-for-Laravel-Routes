<?php

namespace App\Http\Middleware;

use Closure;

class TrainerMiddleware
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
        if ($request->user() && $request->user()->USER_TYPE === 'T')
        {
            return $next($request);
            
        }

        return redirect('/login');
    }
}
