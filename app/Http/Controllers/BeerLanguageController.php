<?php

namespace App\Http\Controllers;

use App\Modules\Beers\Services\BeerLanguageService;

class BeerLanguageController extends Controller
{
    private BeerLanguageService $service;

    public function __construct(BeerLanguageService $beerLanguageService)
    {
        $this->service = $beerLanguageService;
    }
}
