<?php

namespace App\Http\Controllers;

use App\Modules\Aromas\Services\AromaService;

class AromaController extends Controller
{
    protected AromaService $service;

    public function __construct(AromaService $aromaService)
    {
        $this->service = $aromaService;
    }
}
