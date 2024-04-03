<?php

namespace App\Http\Controllers;

use App\Modules\Languages\Services\LanguageService;

class LanguageController extends Controller
{
    public function __construct(LanguageService $languageService)
    {
        parent::__construct($languageService);
    }
}
