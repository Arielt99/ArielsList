<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Cities;
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
}
