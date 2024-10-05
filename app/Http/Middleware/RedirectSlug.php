<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectSlug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()->parameter('city')) {
            $response = $next($request);
            if ($response->getStatusCode() !== 200) {
                return $response;
            }
            session(['city' => $request->route()->parameter('city')]);
            return $response;
        }

        if (!session('city')) {
            return $next($request);
        }

        $request->route()->setParameter('city', session('city'));

        return redirect(route($request->route()->getName(), $request->route()->parameters()), 301);
    }
}
