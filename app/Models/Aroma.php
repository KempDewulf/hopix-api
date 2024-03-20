<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Aroma extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function beers(): BelongsToMany
    {
        return $this->belongsToMany(Beer::class, 'beers_aromas', 'beer_id', 'aroma_id');
    }
}
