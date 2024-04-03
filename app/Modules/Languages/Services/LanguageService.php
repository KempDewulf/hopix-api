<?php

namespace App\Modules\Languages\Services;

use App\Models\Language;
use App\Modules\Core\Services\Service;

class LanguageService extends Service
{
    protected $rules = [
        'code' => 'required|string|unique:languages|max:255',
        'name' => 'required|string|max:255',
    ];

    public function __construct(Language $model)
    {
        parent::__construct($model);
    }
}
