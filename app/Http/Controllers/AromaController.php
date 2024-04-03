<?php

namespace App\Http\Controllers;

use App\Modules\Aromas\Services\AromaService;

class AromaController extends Controller
{
    public function __construct(AromaService $aromaService)
    {
        parent::__construct($aromaService);
    }
}
