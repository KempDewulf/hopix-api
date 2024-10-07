<?php

namespace App\Http\Controllers;

use App\Modules\Reviews\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected ReviewService $service;

    public function __construct(ReviewService $reviewService)
    {
        $this->service = $reviewService;
    }

    public function createForBeer(Request $request, $id)
    {
        return [
            "data" => $this->service->createForBeer($id, $request)
        ];
    }

}
