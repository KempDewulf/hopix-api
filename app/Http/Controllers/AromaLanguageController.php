<?php

namespace App\Http\Controllers;

use App\Modules\Aromas\Services\AromaLanguageService;

class AromaLanguageController extends Controller
{
    public function __construct(AromaLanguageService $aromaLanguageService)
    {
        parent::__construct($aromaLanguageService);
    }
}
