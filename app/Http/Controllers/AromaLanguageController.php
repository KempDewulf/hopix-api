<?php

namespace App\Http\Controllers;

use App\Modules\Aromas\Services\AromaLanguageService;

class AromaLanguageController extends Controller
{
    protected AromaLanguageService $service;

    public function __construct(AromaLanguageService $aromaLanguageService)
    {
        $this->service = $aromaLanguageService;
    }
}
