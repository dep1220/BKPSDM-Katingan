<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memaksa header 'Accept' untuk selalu 'application/json' pada request yang masuk
        $request->headers->set('Accept', 'application/json');

        // Lanjutkan request ke tujuan berikutnya
        return $next($request);
    }
}
