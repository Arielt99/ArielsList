<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\MaskedController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\UserDefaultCityController;
use App\Http\Middleware\CategoryExistence;
use App\Http\Middleware\CityExistence;
use App\Http\Middleware\PostExistence;
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
Route::get('/{city_slug}/{category_slug}/{subcategory_slug}/{post_slug}', [PostsController::class, 'show'])->name('post')->middleware(CityExistence::class, CategoryExistence::class,SubCategoryExistence::class, PostExistence::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

//adding post
//display
Route::get('/AddPost', [PostsController::class, 'addShow'])->name('addpost')->middleware(['auth:sanctum', 'verified']);
//adding
Route::put('/AddPost', [PostsController::class, 'store'])->name('addNewPost')->middleware(['auth:sanctum', 'verified']);

//search post in everything
Route::get('/search/{search_content}', [SearchController::class, 'display'])->name('search');


//display current user posts
Route::get('/your-posts', [PostsController::class, 'show_current'])->name('userPosts')->middleware(['auth:sanctum', 'verified']);

//modify post
//display
Route::get('/modify/{post_slug}', [PostsController::class, 'updateShow'])->name('updatepost')->middleware(['auth:sanctum', 'verified']);
//adding
Route::put('/modify/{post_slug}', [PostsController::class, 'update'])->name('updatecurrentpost')->middleware(['auth:sanctum', 'verified']);

//delete a post
Route::delete('/your-post', [PostsController::class, 'destroy'])->name('destroy_post')->middleware(['auth:sanctum', 'verified']);

//favorites gestion
//display favorites
Route::get('/favorite', [FavoritesController::class, 'display'])->name('favorite')->middleware(['auth:sanctum', 'verified']);
//add a favorite
Route::put('/favorite', [FavoritesController::class, 'store'])->name('addfavorite')->middleware(['auth:sanctum', 'verified']);

//maskeds gestion
//display maskeds
Route::get('/masked', [MaskedController::class, 'display'])->name('masked')->middleware(['auth:sanctum', 'verified']);
//add a masked
Route::put('/masked', [MaskedController::class, 'store'])->name('addmasked')->middleware(['auth:sanctum', 'verified']);

//get category page
Route::get('/{city_slug}', [CitiesController::class, 'display'])->name('city')->middleware(CityExistence::class);

//get all the annonces filtered by
//the city and category
Route::get('/{city_slug}/{category_slug}', [CategoriesController::class, 'display'])->name('category')->middleware(CityExistence::class, CategoryExistence::class);
//the city, category and subcategory
Route::get('/{city_slug}/{category_slug}/{subcategory_slug}', [SubCategoriesController::class, 'display'])->name('subcategory')->middleware(CityExistence::class, CategoryExistence::class,SubCategoryExistence::class);
