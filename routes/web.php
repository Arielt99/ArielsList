<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\UserDefaultCityController;
use App\Http\Middleware\CategoryExistence;
use App\Http\Middleware\CityExistence;
use App\Http\Middleware\SubCategoryExistence;
use Laravel\Fortify\Features;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

// Route::get('/test', function () {
//     return Inertia\Inertia::render('Test');
// })->name('test');

Route::get('/', [CitiesController::class, 'list'])->name('home');
Route::get('post/{post_slug}', [PostsController::class, 'show'])->name('post');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

//adding post view
//display
Route::get('/AddPost', [PostsController::class, 'addShow'])->name('addpost')->middleware(['auth:sanctum', 'verified']);
//adding
Route::put('/AddPost', [PostsController::class, 'store'])->name('addNewPost')->middleware(['auth:sanctum', 'verified']);

//search post in everything
Route::get('/search/{search_content}', [SearchController::class, 'display'])->name('search');

//get category page
Route::get('/{city_slug}', [CitiesController::class, 'display'])->name('city')->middleware(CityExistence::class);

//get all the annonces filtered by
//the city and category
Route::get('/{city_slug}/{category_slug}', [CategoriesController::class, 'display'])->name('category')->middleware(CityExistence::class, CategoryExistence::class);
//the city, category and subcategory
Route::get('/{city_slug}/{category_slug}/{subcategory_slug}', [SubCategoriesController::class, 'display'])->name('subcategory')->middleware(CityExistence::class, CategoryExistence::class,SubCategoryExistence::class);
















//waiting for solution
if (Features::enabled(Features::updateProfileInformation())) {
    Route::put('/user/update-default-city', [UserDefaultCityController::class, 'update'])
        ->middleware(['auth'])
        ->name('/user/update-default-city');
}
