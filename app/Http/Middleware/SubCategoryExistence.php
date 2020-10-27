<?php

namespace App\Http\Middleware;

use App\Models\SubCategories;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubCategoryExistence
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
        $subcategory = SubCategories::where('slug',$request->route()->parameter('subcategory_slug'))->first();
        if ($subcategory === null) {
            return Redirect::route('category',['city_slug' => $request->route()->parameter('city_slug'),'category_slug' => $request->route()->parameter('category_slug')]);
        }
        return $next($request);
    }
}
