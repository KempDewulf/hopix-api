<?php

use App\Http\Controllers\AromaController;
use App\Http\Controllers\AromaLanguageController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\BeerLanguageController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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


//Breweries

Route::get('/breweries', [BreweryController::class, 'all']);

Route::get('/breweries/{id}', [BreweryController::class, 'find']);

Route::post('/breweries', [BreweryController::class, 'create']);

Route::put('/breweries/{id}', [BreweryController::class, 'update']);

//Aromas

Route::get('/aromas', [AromaController::class, 'all']);

Route::get('/aromas/{id}', [AromaController::class, 'find']);

Route::post('/aromas', [AromaController::class, 'create']);

Route::put('/aromas/{id}', [AromaController::class, 'update']);

//Languages

Route::get('/languages', [LanguageController::class, 'all']);

Route::get('/languages/{id}', [LanguageController::class, 'find']);

Route::post('/languages', [LanguageController::class, 'create']);

Route::put('/languages/{id}', [LanguageController::class, 'update']);

//Reviews

Route::get('/reviews', [ReviewController::class, 'all']);

Route::get('/reviews/{id}', [ReviewController::class, 'find']);

Route::post('/reviews', [ReviewController::class, 'create']);

Route::put('/reviews/{id}', [ReviewController::class, 'update']);

//Users

Route::get('/users', [UserController::class, 'all']);

Route::get('/users/{id}', [UserController::class, 'find']);

Route::post('/users', [UserController::class, 'create']);

Route::put('/users/{id}', [UserController::class, 'update']);














