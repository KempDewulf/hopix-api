<?php

namespace App\Http\Controllers;

use App\Modules\Beers\Services\BeerLanguageService;

class BeerLanguageController extends Controller
{
    public function __construct(BeerLanguageService $beerLanguageService)
    {
        parent::__construct($beerLanguageService);
    }
}
