<?php

namespace App\Http\Middleware;

use App\Models\Cities;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CityExistence
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
        $city = Cities::where('name','like', '%'.$request->route()->parameter('city_name').'%')->first();
        if ($city === null) {
            return Redirect::route('home');
        }
        return $next($request);
    }
}
