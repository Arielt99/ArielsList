<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Cities;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function display($city_slug, $category_slug)
    {
        $current_city = Cities::where('slug',$city_slug)->first();
        $current_category = Categories::where('slug',$category_slug)->first();

        if(Auth::id()){
            $posts = Post::whereDoesntHave('masked', function ($query) {
                return $query->where('user_id', Auth::id());
            })->with('subcategory','category','city', 'user')->where('city_slug',$city_slug)->where('isActive',true)->where('category_slug',$category_slug)->with('subcategory','category','city', 'user')->orderBy('created_at','DESC')->get();
        }else{
        $posts = Post::where('city_slug',$city_slug)->where('isActive',true)->where('category_slug',$category_slug)->with('subcategory','category','city', 'user')->orderBy('created_at','DESC')->get();
        }

        return Inertia::render('Display', [
            'posts' => $posts,
            'current_city' => $current_city,
            'current_category' => $current_category,
            'route_name' => 'category'
        ]);
    }
}
