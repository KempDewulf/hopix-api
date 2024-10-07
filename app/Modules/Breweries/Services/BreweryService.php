<?php

namespace App\Modules\Breweries\Services;

use App\Models\Brewery;
use App\Modules\Core\Services\Service;

class BreweryService extends Service
{
    protected $rules = [
        'name' => 'required|string|unique:breweries|max:255',
    ];

    public function __construct(Brewery $model)
    {
        parent::__construct($model);
    }
}
