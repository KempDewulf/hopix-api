<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Modules\Beers\Services\BeerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BeerController extends Controller
{
    private BeerService $service;

    public function __construct(BeerService $beerService)
    {
        $this->service = $beerService;
    }
}
