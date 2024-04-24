<?php

namespace App\Http\Controllers;

use App\Modules\Breweries\Services\BreweryService;

class BreweryController extends Controller
{
    protected BreweryService $service;

    public function __construct(BreweryService $breweryService)
    {
        $this->service = $breweryService;
    }
}
