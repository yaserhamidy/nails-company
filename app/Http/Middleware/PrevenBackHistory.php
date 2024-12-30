<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrevenBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);
        return $response->header('cache-control', 'nocache,no-store,max-age=0,must-revalidate')
                        ->header('pragma', 'no-cache')
                        ->header('expires', 'sun, 02 Jan 1990 00:00:00 GMT');
    }
}
