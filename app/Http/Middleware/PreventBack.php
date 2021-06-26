<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        return $response->header('Cache-Control','nocache,no-store,max-age=0;must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expire','sun,02 jun 1990 00:00:00 GMT');
    }
}
