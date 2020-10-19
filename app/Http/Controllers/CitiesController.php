<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Inertia\Inertia;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $cities = Cities::all();
        return Inertia::render('Home', [
            'cities' => $cities,
        ]);
    }
}
