<?php

namespace App\Http\Controllers;

use App\Modules\Reviews\Services\ReviewService;

class ReviewController extends Controller
{
    public function __construct(ReviewService $reviewService)
    {
        parent::__construct($reviewService);
    }
}
