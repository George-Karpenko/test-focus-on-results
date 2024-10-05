<?php

namespace App\Http\Middleware;

use App\Models\City;
use App\Models\Region;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class Slug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $parameters = explode('.', $request->route()->parameter('city'));
        $parameterRegion = $parameters[0];
        $parameterCity = isset($parameters[1]) ? $parameters[1] : null;

        if ($parameterCity) {
            $city = City::whereHas('region', function (Builder $query) use ($parameterRegion) {
                $query->whereSlug($parameterRegion);
            })->whereSlug($parameterCity)->firstOrFail();
        } elseif ($parameterRegion) {
            $city = Region::whereSlug($parameterRegion)->has('cities', '=', 0)->firstOrFail();
        }

        View::share('cityName', isset($city) ? $city->name : 'Выберите город');
        View::share('city', isset($city) ? $city : null);
        View::share('citySlug', $request->route()->parameter('city'));

        return $next($request);
    }
}
