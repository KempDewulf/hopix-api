<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aroma extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function beers(): BelongsToMany
    {
        return $this->belongsToMany(Beer::class, 'beers_aromas', 'aroma_id', 'beer_id');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(AromaLanguage::class);
    }

    public function language(): HasMany
    {
        return $this->languages()->where('language_id', 1)->first();
    }
}
