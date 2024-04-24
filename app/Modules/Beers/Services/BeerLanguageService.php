<?php

namespace App\Modules\Beers\Services;

use App\Models\BeerLanguage;
use App\Modules\Core\Services\Service;

class BeerLanguageService extends Service
{
    protected $rules = [
        'beer_id' => 'required|exists:beers,id',
        'language_id' => 'required|exists:languages,id',
        'name' => 'required|string|max:255',
        'style' => 'required|string|max:255',
        'description' => 'required|text',
    ];

    public function __construct(BeerLanguage $model)
    {
        parent::__construct($model);
    }

}
