<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        $tokenHeader = $request->header('Authorization');

        if(empty($tokenHeader)) {
            return response()->json(
                [
                    'success' => false,
                    'error' => 'authorization assente'
                ]
            );
        }

        $apiKey = 'Bearer ' . config('app.api_key');

        if($tokenHeader != $apiKey) {
            return response()->json(
                [
                    'success' => false,
                    'error' => 'authorization errata'
                ]
            );
        }

        return $next($request);
    }
}
