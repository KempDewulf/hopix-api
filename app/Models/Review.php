<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_text',
        'rating',
        'show_username',
        'user_id',
        'beer_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'beer_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

    public function beer(): BelongsTo
    {
        return $this->belongsTo(Beer::class);
    }
}
