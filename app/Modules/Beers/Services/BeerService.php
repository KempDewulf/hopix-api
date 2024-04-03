<?php

namespace App\Modules\Beers\Services;

use App\Models\Beer;
use App\Modules\Core\Services\Service;

class BeerService extends Service
{
    protected $rules = [
        'name' => 'required|string|max:255',
        'style' => 'required|string|max:255',
        'abv' => 'required|numeric|min:0',
        'drinking_temp' => 'required|integer|min:0',
        'ibu' => 'required|integer|min:0',
        'brewery_id' => 'required|exists:breweries,id',
        'amount_of_ratings' => 'integer|min:0',
        'sum_ratings' => 'numeric|min:0',
    ];

    public function __construct(Beer $model)
    {
        parent::__construct($model);
    }
}
