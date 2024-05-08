<?php

namespace App\Modules\Reviews\Services;

use App\Models\Beer;
use App\Models\Review;
use App\Modules\Core\Services\Service;
use Illuminate\Http\Request;

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

    public function createForBeer($beerId, Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'review_text' => 'required|string',
            'rating' => 'required|integer|min:0|max:5',
            'show_username' => 'required|boolean',
        ]);

        // Add the user_id and beer_id to the data
        $data['user_id'] = $request->user()->id;
        $data['beer_id'] = $beerId;

        // Create the review
        $review = Review::create($data);

        // Update the beer's rating fields
        $beer = Beer::find($beerId);
        $beer->increment('amount_of_ratings');
        $beer->increment('sum_ratings', $data['rating']);

        return $review;
    }
}
