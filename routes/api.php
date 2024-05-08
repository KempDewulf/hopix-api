<?php

use App\Http\Controllers\AromaController;
use App\Http\Controllers\AromaLanguageController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\BeerLanguageController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TranslationController;
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


/** api routes **/
Route::middleware('language')->group(function () {
    /** JWT Auth routes **/
    Route::post("register", [JwtAuthController::class, "register"]);
    Route::post("login", [JwtAuthController::class, "login"])->name("login");

    /** authenticated routes **/
    Route::group([
        "middleware" => ["auth:api", "auth.csrf.jwt"]
    ], function(){

        Route::get("profile", [JwtAuthController::class, "profile"]);
        Route::get("refresh", [JwtAuthController::class, "refreshToken"]);
        Route::get("logout", [JwtAuthController::class, "logout"]);

        Route::post('/beers/{id}/reviews', [ReviewController::class, 'createForBeer']);

        /**backoffice routes**/
        Route::group([
            "middleware" => ["isAdmin"]
        ], function(){

            //users

            Route::get('/users', [UserController::class, 'all']);

            Route::get('/users/{id}', [UserController::class, 'find']);

            //beers

            Route::post('/beers', [BeerController::class, 'create']);

            Route::put('/beers/{id}', [BeerController::class, 'update']);

            //breweries

            Route::post('/breweries', [BreweryController::class, 'create']);

            Route::put('/breweries/{id}', [BreweryController::class, 'update']);

            //aromas

            Route::post('/aromas', [AromaController::class, 'create']);

            Route::put('/aromas/{id}', [AromaController::class, 'update']);

            //languages

            Route::post('/languages', [LanguageController::class, 'create']);

            Route::put('/languages/{id}', [LanguageController::class, 'update']);

            //reviews

            Route::put('/reviews/{id}', [ReviewController::class, 'update']);

            //users

            Route::post('/users', [UserController::class, 'create']);

            Route::put('/users/{id}', [UserController::class, 'update']);

        });
    });

    /** Public routes **/

    //Beers
        Route::get('/beers', [BeerController::class, 'all']);

        Route::get('/beers/{id}', [BeerController::class, 'find'])->where('id', '[0-9]+');

        Route::get('/beers/{name}', [BeerController::class, 'findByName'])->where('name', '[a-zA-Z-]+');

        Route::get('/beers/{id}/aromas', [BeerController::class, 'aromas']);

        Route::get('/beers/{id}/reviews', [BeerController::class, 'reviews']);

    //Breweries

        Route::get('/breweries', [BreweryController::class, 'all']);

        Route::get('/breweries/{id}', [BreweryController::class, 'find']);

    //Aromas

        Route::get('/aromas', [AromaController::class, 'all']);

        Route::get('/aromas/{id}', [AromaController::class, 'find']);

    //Languages

        Route::get('/languages', [LanguageController::class, 'all']);

        Route::get('/languages/{id}', [LanguageController::class, 'find']);

    //Reviews

        Route::get('/reviews', [ReviewController::class, 'all']);

        Route::get('/reviews/{id}', [ReviewController::class, 'find']);

        Route::post('/reviews', [ReviewController::class, 'create']);

    //translations

        Route::get('/translations', [TranslationController::class, 'translations']);

});
