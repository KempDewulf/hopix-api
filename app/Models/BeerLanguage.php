<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeerLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'style',
        'description',
        'beer_id',
        'language_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function beer(): BelongsTo
    {
        return $this->belongsTo(Beer::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
