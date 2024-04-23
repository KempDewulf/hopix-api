<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'style',
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
        return $this->belongsToMany(Aroma::class, 'beers_aromas', 'beer_id', 'aroma_id');
    }

    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Review::class, 'reviews');
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function triedBeers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tried_beers');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(BeerLanguage::class);
    }

    public function language(): HasMany
    {
        return $this->languages()->where('language_id', 1)->first();
    }
}
