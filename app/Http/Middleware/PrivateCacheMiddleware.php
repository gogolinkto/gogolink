<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PrivateCacheMiddleware
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
        $response = $next($request);

        /** @var $response \Illuminate\Http\Response */
        return $response->withHeaders(['Cache-Control' => 'private']);
    }
}
