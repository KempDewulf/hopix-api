<?php

namespace App\Modules\Reviews\Services;

use App\Models\Review;
use App\Modules\Core\Services\Service;

class ReviewService extends Service
{
    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'beer_id' => 'required|exists:beers,id',
        'review_text' => 'nullable|string',
        'rating' => 'required|numeric|min:0|max:5',
        'show_username' => 'boolean',
    ];

    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
}
