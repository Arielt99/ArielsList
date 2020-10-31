<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Cities;
use App\Models\Post;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function display($city_slug, $category_slug)
    {
        $posts = Post::where('city_slug',$city_slug)->where('isActive',true)->where('category_slug',$category_slug)->with('subcategory','category','city', 'user')->get();
        $current_city = Cities::where('slug',$city_slug)->first();
        $current_category = Categories::where('slug',$category_slug)->first();

        return Inertia::render('Display', [
            'posts' => $posts,
            'current_city' => $current_city,
            'current_category' => $current_category,
            'route_name' => 'category'
        ]);
    }
}
