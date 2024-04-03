<?php

use App\Http\Controllers\BeerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Beers

Route::get('/beers', [BeerController::class, 'all']);

Route::get('/beers/{id}', [BeerController::class, 'find']);

Route::post('/beers', [BeerController::class, 'create']);

Route::put('/beers/{id}', [BeerController::class, 'update']);

//BeerLanguages

Route::get('/beerLanguages', [\App\Http\Controllers\BeerLanguageController::class, 'all']);

Route::get('/beerLanguages/{id}', [\App\Http\Controllers\BeerLanguageController::class, 'find']);

Route::post('/beerLanguages', [\App\Http\Controllers\BeerLanguageController::class, 'create']);

Route::put('/beerLanguages/{id}', [\App\Http\Controllers\BeerLanguageController::class, 'update']);

//Breweries

Route::get('/breweries', [\App\Http\Controllers\BreweryController::class, 'all']);

Route::get('/breweries/{id}', [\App\Http\Controllers\BreweryController::class, 'find']);

Route::post('/breweries', [\App\Http\Controllers\BreweryController::class, 'create']);

Route::put('/breweries/{id}', [\App\Http\Controllers\BreweryController::class, 'update']);

//Aromas

Route::get('/aromas', [\App\Http\Controllers\AromaController::class, 'all']);

Route::get('/aromas/{id}', [\App\Http\Controllers\AromaController::class, 'find']);

Route::post('/aromas', [\App\Http\Controllers\AromaController::class, 'create']);

Route::put('/aromas/{id}', [\App\Http\Controllers\AromaController::class, 'update']);

//AromaLanguages

Route::get('/aromaLanguages', [\App\Http\Controllers\AromaLanguageController::class, 'all']);

Route::get('/aromaLanguages/{id}', [\App\Http\Controllers\AromaLanguageController::class, 'find']);

Route::post('/aromaLanguages', [\App\Http\Controllers\AromaLanguageController::class, 'create']);

Route::put('/aromaLanguages/{id}', [\App\Http\Controllers\AromaLanguageController::class, 'update']);

//Languages

Route::get('/languages', [\App\Http\Controllers\LanguageController::class, 'all']);

Route::get('/languages/{id}', [\App\Http\Controllers\LanguageController::class, 'find']);

Route::post('/languages', [\App\Http\Controllers\LanguageController::class, 'create']);

Route::put('/languages/{id}', [\App\Http\Controllers\LanguageController::class, 'update']);

//Reviews

Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'all']);

Route::get('/reviews/{id}', [\App\Http\Controllers\ReviewController::class, 'find']);

Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'create']);

Route::put('/reviews/{id}', [\App\Http\Controllers\ReviewController::class, 'update']);

//Users

Route::get('/users', [\App\Http\Controllers\UserController::class, 'all']);

Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'find']);

Route::post('/users', [\App\Http\Controllers\UserController::class, 'create']);

Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);














