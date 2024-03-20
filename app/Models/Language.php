<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function beerLanguages(): HasMany
    {
        return $this->hasMany(BeerLanguage::class);
    }

    public function aromaLanguages(): HasMany
    {
        return $this->hasMany(AromaLanguage::class);
    }

}
