<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Beer extends Model
{
    use HasFactory;


    protected $fillable = [
        'abv',
        'drinking_temp',
        'ibu',
        'amount_of_ratings',
        'sum_ratings',
        'brewery_id',
    ];

    protected $hidden = [
        'brewery_id',
        'created_at',
        'updated_at',
    ];

    public function brewery(): BelongsTo
    {
        return $this->belongsTo(Brewery::class, 'brewery_id');
    }

    public function aromas(): BelongsToMany
    {
        return $this->belongsToMany(Aroma::class, 'beers_aromas', 'aroma_id', 'beer_id');
    }

    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Review::class, 'reviews');
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'beer_id');
    }

    public function triedBeers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tried_beers', 'user_id', 'beer_id');
    }
}
