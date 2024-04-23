<?php

namespace App\Modules\Aromas\Services;

use App\Models\Aroma;
use App\Modules\Core\Services\Service;
use Illuminate\Http\Request;

class AromaService extends Service
{
    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function __construct(Aroma $model)
    {
        parent::__construct($model);
    }

    public function all($pages, Request $request)
    {
        parent::setLocale($request);

        $aromas = $this->fetchAromasWithTranslations($this->model->query(), $request)
            ->paginate($pages)
            ->withQueryString();

        $aromas->setCollection($aromas->getCollection()->map(function ($aroma) {
            return $this->translateAromaFields($aroma);
        }));

        return $aromas;
    }

    public function find($id, Request $request)
    {
        parent::setLocale($request);

        $aroma = $this->fetchAromasWithTranslations($this->model->query(), $request)
            ->find($id);

        return $this->translateAromaFields($aroma);
    }

    private function fetchAromasWithTranslations($query, Request $request)
    {
        $language = $request->input('lang', 'US_EN');

        return $query->with(['languages' => function ($query) use ($language) {
            $query->join('languages', 'languages.id', '=', 'aroma_languages.language_id')
                ->where('languages.code', $language)
                ->select('aroma_languages.*', 'languages.code', 'aroma_languages.name as translated_name');
        }]);
    }

    private function translateAromaFields($aroma)
    {
        $translation = $aroma->languages->first();
        $aroma = $aroma->toArray();
        if ($translation) {
            $translation = $translation->toArray();
            $aroma['name'] = $translation['translated_name'];
            unset($aroma['languages']);
        }
        return $aroma;
    }
}
