<?php

namespace App\Http\Middleware;

use App\Models\Categories;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryExistence
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
        $category = Categories::where('slug',$request->route()->parameter('category_slug'))->first();
        if ($category === null) {
            return Redirect::route('city',['city_slug' => $request->route()->parameter('city_slug')]);
        }
        return $next($request);
    }
}
