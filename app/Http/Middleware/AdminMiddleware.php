<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->is_admin) {
            return response()->json([
                "responseCode" => 403,
                "responseStatus" => "error",
                "responseMassage" => "Access forbidden. You are not authorized to perform this action.",
                'errors' => 'Unauthorized'
            ], 403);
        }
        return $next($request);
    }
}
