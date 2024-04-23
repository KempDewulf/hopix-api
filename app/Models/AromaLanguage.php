<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AromaLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'aroma_id',
        'language_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'aroma_id',
        'language_id',
    ];

    public function aroma(): BelongsTo
    {
        return $this->belongsTo(Aroma::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
