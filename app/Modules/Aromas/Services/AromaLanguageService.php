<?php

namespace App\Modules\Aromas\Services;

use App\Models\AromaLanguage;
use App\Modules\Core\Services\Service;

class AromaLanguageService extends Service
{
    protected $rules = [
        'aroma_id' => 'required|exists:aromas,id',
        'language_id' => 'required|exists:languages,id',
        'name' => 'required|string|max:255',
    ];

    public function __construct(AromaLanguage $model)
    {
        parent::__construct($model);
    }
}
