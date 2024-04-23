<?php

namespace App\Modules\Beers\Services;

use App\Models\Beer;
use App\Modules\Core\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;

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

    public function all($pages, Request $request)
    {
        parent::setLocale($request);

        $beers = $this->fetchBeersWithTranslations($this->model->query(), $request)
            ->paginate($pages)
            ->withQueryString();

        $beers->setCollection($beers->getCollection()->map(function ($beer) {
            return $this->translateBeerFields($beer);
        }));

        return $beers;
    }

    public function find($id, Request $request)
    {
        parent::setLocale($request);

        $beer = $this->fetchBeersWithTranslations($this->model->query(), $request)
            ->find($id);

        return $this->translateBeerFields($beer);
    }

    private function fetchBeersWithTranslations($query, Request $request)
    {
        $language = $request->input('lang', 'US_EN');

        return $query->with(['languages' => function ($query) use ($language) {
            $query->join('languages', 'languages.id', '=', 'beer_languages.language_id')
                ->where('languages.code', $language)
                ->select('beer_languages.*', 'languages.code', 'beer_languages.name as translated_name');
        }]);
    }

    private function translateBeerFields($beer)
    {
        $translation = $beer->languages->first();
        $beer = $beer->toArray();
        if ($translation) {
            $translation = $translation->toArray();
            $beer['name'] = $translation['translated_name'];
            $beer['style'] = $translation['style'];
            unset($beer['languages']);
        }
        return $beer;
    }
}
























