<?php

namespace App\Http\Controllers;

use App\Modules\Languages\Services\LanguageService;

class LanguageController extends Controller
{
    protected LanguageService $service;

    public function __construct(LanguageService $languageService)
    {
        $this->service = $languageService;
    }
}
