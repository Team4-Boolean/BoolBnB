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
        $tokenHeader = $request->header('authorization');
        if (empty($tokenHeader)) {
            return response()->json([
                'success' => false,
                'response' => 'Authorization assente'
            ]);
        }
        $apikey = 'Bearer ' . config('app.api_key');
        if ($tokenHeader != $apikey) {
            return response()->json([
                'success' => false,
                'response' => 'Authorization errata'
            ]);
        }
        return $next($request);
    }
}
