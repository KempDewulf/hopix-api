<?php

namespace App\Modules\Beers\Services;

use App\Models\Beer;
use App\Models\BeerLanguage;
use App\Modules\Core\Services\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BeerService extends Service
{
    protected $rules = [
        'name' => 'required|string|max:255',
        'style' => 'required|string|max:255',
        'abv' => 'required|numeric|min:0',
        'drinking_temp' => 'required|integer|min:0',
        'ibu' => 'required|integer|min:0',
        'description' => 'required|string',
        'brewery_id' => 'required|exists:breweries,id',
        'amount_of_ratings' => 'integer|min:0',
        'sum_ratings' => 'numeric|min:0',
    ];

    protected $beerLanguageService;

    public function __construct(Beer $model, BeerLanguageService $beerLanguageService)
    {
        parent::__construct($model);
        $this->beerLanguageService = $beerLanguageService;
    }

    public function all($perPage, Request $request)
    {
        $beers = $this->fetchBeersWithTranslations($this->model->query(), $request);

        if ($request->has('search')) {
            $search = $request->input('search');
            $beers = $beers->where('name', 'like', "%{$search}%");
        }

        $beers = $this->filterByAromas($beers, $request->input('aroma_ids', []));
        $beers = $this->filterByBreweries($beers, $request->input('brewery_ids', []));
        $beers = $this->sortBeers($beers, $request->input('sort_order', 'name'));

        $beers = $beers->paginate($perPage)->withQueryString();

        $beers->setCollection($beers->getCollection()->map(function ($beer) {
            return $this->translateBeerFields($beer);
        }));

        return $beers;
    }

    private function filterByAromas($beers, $aromaIds)
    {
        if (!empty($aromaIds)) {
            $aromaIds = is_array($aromaIds) ? $aromaIds : explode(',', $aromaIds);
            $beers = $beers->whereHas('aromas', function ($query) use ($aromaIds) {
                $query->whereIn('aromas.id', $aromaIds);
            });

            // Log the SQL query
            Log::info('SQL query: ' . $beers->toSql());
            Log::info('SQL query parameters: ' . implode(', ', $beers->getBindings()));
        }


        return $beers;
    }

    private function filterByBreweries($beers, $breweryIds)
    {
        if (!empty($breweryIds)) {
            $breweryIds = is_array($breweryIds) ? $breweryIds : explode(',', $breweryIds);
            $beers = $beers->whereIn('brewery_id', $breweryIds);
        }

        return $beers;
    }

    private function sortBeers($beers, $sortOrder)
    {
        if ($sortOrder === 'name') {
            $beers = $beers->orderBy('name', 'asc');
        } elseif ($sortOrder === 'amount_of_ratings') {
            $beers = $beers->orderBy('amount_of_ratings', 'desc');
        } elseif ($sortOrder === 'id') {
            $beers = $beers->orderBy('id', 'desc');
        }

        return $beers;
    }

    public function find($id, Request $request)
    {
        $beer = $this->model->find($id);

        if (!$beer) {
            return response()->json(['error' => 'Beer not found'], 404);
        }

        if ($request->has('withlanguages')) {
            $beer->load('languages');
            $locale = App::getLocale();
            $translation = $beer->languages->where('language.code', $locale)->first();

            if ($translation) {
                $beer->name = $translation->translated_name;
                $beer->style = $translation->style;
                $beer->description = $translation->description;
            }

            $beer['aroma_ids'] = $beer->aromas()->pluck('aromas.id')->toArray();
            $beer->makeVisible('brewery_id');
        } else {
            $beer = $this->fetchBeersWithTranslations($this->model->query(), $request)
                ->where('id', $id)
                ->first();

            if ($beer) {
                $beer = $this->translateBeerFields($beer);
            }
        }

        return $beer;
    }

    public function findByName($name, Request $request)
    {
        $name = str_replace('-', ' ', $name);
        $language = $request->input('lang', 'en');

        $beer = $this->model->whereHas('languages', function ($query) use ($name, $language) {
            $query->where('name', $name)
                ->whereHas('language', function ($query) use ($language) {
                    $query->where('code', $language);
                });
        })->first();
        if ($beer == null) {
            $beer = $this->fetchBeersWithTranslations($this->model->query(), $request)
                ->where('name', $name)
                ->first();
        }

        return $this->find($beer->id, $request);
    }

    private function fetchBeersWithTranslations($query, Request $request)
    {
        $language = $request->input('lang', 'en');

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
            $beer['description'] = $translation['description'];
            unset($beer['languages']);
        }
        return $beer;
    }

    /**
     * @param $data
     * @param Request $request
     * @throws \Exception
     */
    public function create($data, Request $request)
    {
        $this->validate($data);

        $this->validateAromaIds($data);

        DB::beginTransaction();

        try {
            $beer = $this->createBeer($data);

            $this->attachAromasToBeer($data, $beer);

            $this->createBeerLanguages($data, $beer);

            DB::commit();

            return $beer;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function update($id, $data, Request $request)
    {
        $this->validate($data);

        $this->validateAromaIds($data);

        DB::beginTransaction();

        try {
            $beer = $this->model->find($id);

            if (!$beer) {
                return response()->json(['error' => 'Beer not found'], 404);
            }

            $beer->update([
                'name' => $data['name'],
                'style' => $data['style'],
                'abv' => $data['abv'],
                'drinking_temp' => $data['drinking_temp'],
                'ibu' => $data['ibu'],
                'description' => $data['description'],
                'brewery_id' => $data['brewery_id'],
            ]);

            $beer->aromas()->detach();

            if (isset($data['aroma_ids'])) {
                foreach ($data['aroma_ids'] as $aromaId) {
                    $beer->aromas()->attach($aromaId);
                }
            }

            foreach ($data['languages'] as $languageData) {
                $beerLanguage = BeerLanguage::where('beer_id', $beer->id)
                    ->where('language_id', $languageData['language_id'])
                    ->first();

                if ($beerLanguage) {
                    $beerLanguage->update([
                        'name' => $languageData['name'],
                        'style' => $languageData['style'],
                        'description' => $languageData['description'],
                    ]);
                } else {
                    $this->beerLanguageService->createBeerLanguageForNewlyCreatedBeer($beer->id, $languageData);
                }
            }

            DB::commit();

            return $beer;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    private function validateAromaIds($data)
    {
        if (isset($data['aroma_ids'])) {
            $validator = Validator::make($data, [
                'aroma_ids.*' => 'exists:aromas,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        return true;
    }

    private function createBeer($data)
    {
        return Beer::create([
            'name' => $data['name'],
            'style' => $data['style'],
            'abv' => $data['abv'],
            'drinking_temp' => $data['drinking_temp'],
            'ibu' => $data['ibu'],
            'description' => $data['description'],
            'brewery_id' => $data['brewery_id'],
        ]);
    }

    private function attachAromasToBeer($data, $beer)
    {
        if (isset($data['aroma_ids'])) {
            foreach ($data['aroma_ids'] as $aromaId) {
                $beer->aromas()->attach($aromaId);
            }
        }
    }

    private function createBeerLanguages($data, $beer)
    {
        foreach ($data['languages'] as $languageData) {
            $response = $this->beerLanguageService->createBeerLanguageForNewlyCreatedBeer($beer->id, $languageData);

            if ($response instanceof JsonResponse) {
                DB::rollback();
                return $response;
            }
        }

        return true;
    }

    public function aromas($id, Request $request)
    {
        $beer = $this->model->find($id);

        if (!$beer) {
            return response()->json(['error' => 'Beer not found'], 404);
        }

        return $beer->aromas;
    }

    public function reviews($id, Request $request)
    {
        $beer = $this->model->find($id);

        if (!$beer) {
            return response()->json(['error' => 'Beer not found'], 404);
        }

        return $beer->reviews()->with('user')->orderBy('created_at', 'desc')->get();
    }

    public function brewery($id, Request $request)
    {
        $beer = $this->model->find($id);

        if (!$beer) {
            return response()->json(['error' => 'Beer not found'], 404);
        }

        return $beer->brewery;
    }

    public function delete($id)
    {
        $beer = $this->model->find($id);

        if (!$beer) {
            return response()->json(['error' => 'Beer not found'], 404);
        }

        // Detach related aromas
        $beer->aromas()->detach();

        // Delete related beer languages
        $beer->languages()->delete();

        // Delete the beer itself
        $beer->delete();

        return response()->json(['message' => 'Beer deleted successfully'], 200);
    }
}
























