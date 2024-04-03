<?php

namespace App\Http\Controllers;

use App\Modules\Breweries\Services\BreweryService;

class BreweryController extends Controller
{
    public function __construct(BreweryService $breweryService)
    {
        parent::__construct($breweryService);
    }
}
