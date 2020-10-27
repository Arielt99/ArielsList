<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Cities;
use Inertia\Inertia;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $cities = Cities::all();
        return Inertia::render('Home', [
            'cities' => $cities,
        ]);
    }

    public function display($city_slug)
    {
        $categories = Categories::with('subcategories')->get();
        $current_city = Cities::where('slug', $city_slug)->first();

        return Inertia::render('Categories', [
            'categories' => $categories,
            'current_city' => $current_city
        ]);
    }
}
