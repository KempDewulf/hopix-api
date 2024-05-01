<?php

namespace App\Http\Controllers;

use App\Modules\Translations\Services\TranslationService;

class TranslationController
{
    protected TranslationService $service;

    public function __construct(TranslationService $translationService)
    {
        $this->service = $translationService;
    }

    public function translations()
    {
        return $this->service->getTranslations();
    }

}
