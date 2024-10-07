<?php

namespace App\Modules\Translations\Services;

use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;

class TranslationService
{
    public function __construct()
    {
        $this->errors = new MessageBag();
    }

    public function getTranslations()
    {
        $languages = Language::all()->pluck('code')->toArray();
        $translations = [];

        foreach ($languages as $language) {
            App::setLocale($language);
            $translations[$language] = trans('website');
        }

        return $translations;
    }


}
