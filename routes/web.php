<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\UserDefaultCityController;
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

Route::get('/', CitiesController::class)->name('home');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/test', function () {
    return Inertia\Inertia::render('Test');
})->name('test');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');


//waiting for solution
if (Features::enabled(Features::updateProfileInformation())) {
    Route::put('/user/update-default-city', [UserDefaultCityController::class, 'update'])
        ->middleware(['auth'])
        ->name('/user/update-default-city');
}
