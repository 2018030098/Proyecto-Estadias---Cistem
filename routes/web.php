<?php

use App\Http\Controllers\publicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pruebasController; //eliminar

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/social', publicationController::class);
    Route::put('/social/{id}/{status}', [publicationController::class, 'status'])->name('changeStatus');
    Route::get('/prueba',[pruebasController::class, 'prueba'])->name('prueba'); //eliminar
    Route::get('/prueba.shows',[pruebasController::class, 'shows'])->name('prueba.shows'); //eliminar
});