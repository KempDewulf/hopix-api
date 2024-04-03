<?php

namespace App\Modules\Beers\Services;

use App\Models\Beer;
use App\Models\BeerLanguage;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BeerLanguageService extends Service
{
    protected $rules = [
        'beer_id' => 'required|exists:beers,id',
        'language_id' => 'required|exists:languages,id',
        'name' => 'required|string|max:255',
        'style' => 'required|string|max:255',
    ];

    public function __construct(BeerLanguage $model)
    {
        parent::__construct($model);
    }

}
