<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserDefaultCityController;
use App\Http\Middleware\CityExistence;
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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/test', function () {
    return Inertia\Inertia::render('Test');
})->name('test');

Route::get('/', [CitiesController::class, 'list'])->name('home');

Route::get('/{city_slug}', [CategoriesController::class, 'show'])->name('categories')->middleware(CityExistence::class);
Route::get('post/{post_slug}', [PostsController::class, 'show'])->name('post');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');


//waiting for solution
if (Features::enabled(Features::updateProfileInformation())) {
    Route::put('/user/update-default-city', [UserDefaultCityController::class, 'update'])
        ->middleware(['auth'])
        ->name('/user/update-default-city');
}
