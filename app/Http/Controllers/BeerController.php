<?php

namespace App\Http\Controllers;

use App\Modules\Beers\Services\BeerService;

class BeerController extends Controller
{
    public function __construct(BeerService $beerService)
    {
        parent::__construct($beerService);
    }
}
