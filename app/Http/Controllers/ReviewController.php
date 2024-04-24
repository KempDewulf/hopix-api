<?php

namespace App\Http\Controllers;

use App\Modules\Reviews\Services\ReviewService;

class ReviewController extends Controller
{
    protected ReviewService $service;

    public function __construct(ReviewService $reviewService)
    {
        $this->service = $reviewService;
    }
}
