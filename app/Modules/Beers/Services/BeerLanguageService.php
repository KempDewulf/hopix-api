<?php

namespace App\Modules\Beers\Services;

use App\Models\BeerLanguage;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\Validator;

class BeerLanguageService extends Service
{
    protected $rules = [
        'beer_id' => 'required|exists:beers,id',
        'language_id' => 'required|exists:languages,id',
        'name' => 'required|string|max:255',
        'style' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function __construct(BeerLanguage $model)
    {
        parent::__construct($model);
    }

    public function getValidationRules()
    {
        return $this->rules;
    }

    public function createBeerLanguageForNewlyCreatedBeer($beerId, $languageData)
    {
        $languageData['beer_id'] = $beerId;

        $validator = Validator::make($languageData, $this->rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validatedLanguageData = $validator->validate();

        return BeerLanguage::create([
            'beer_id' => $beerId,
            'language_id' => $validatedLanguageData['language_id'],
            'name' => $validatedLanguageData['name'],
            'style' => $validatedLanguageData['style'],
            'description' => $validatedLanguageData['description'],
        ]);
    }
}
