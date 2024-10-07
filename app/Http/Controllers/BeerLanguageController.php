<?php

namespace App\Http\Controllers;

use App\Modules\Beers\Services\BeerLanguageService;

class BeerLanguageController extends Controller
{
    protected BeerLanguageService $service;

    public function __construct(BeerLanguageService $beerLanguageService)
    {
        $this->service = $beerLanguageService;
    }
}
