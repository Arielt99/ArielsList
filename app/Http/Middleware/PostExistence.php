<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostExistence
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
        $post = Post::where('slug',$request->route()->parameter('post_slug'))->first();
        if ($post === null) {
            return Redirect::route('subcategory',['city_slug' => $request->route()->parameter('city_slug'),'category_slug' => $request->route()->parameter('category_slug'),'subcategory_slug' => $request->route()->parameter('subcategory_slug')]);
        }
        return $next($request);
    }
}
