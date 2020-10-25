<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Cities;
use App\Models\Post;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function show($city_slug)
    {
        $categories = Categories::with('subcategories')->get();
        $current_city = Cities::where('slug','like', '%'.$city_slug.'%')->first();

        return Inertia::render('Categories', [
            'categories' => $categories,
            'current_city' => $current_city

        ]);
    }

    public function display($city_slug, $category_slug)
    {
        $posts = Post::where('city_slug','like', '%'.$city_slug.'%')->where('category_slug','like', '%'.$category_slug.'%')->with('subcategory','category','city', 'user')->first();
        $current_city = Cities::where('slug','like', '%'.$city_slug.'%')->first();
        $current_category = Categories::where('slug','like', '%'.$category_slug.'%')->first();

        return Inertia::render('Display', [
            'posts' => $posts,
            'current_city' => $current_city,
            'current_category' => $current_category,
        ]);
    }
}
