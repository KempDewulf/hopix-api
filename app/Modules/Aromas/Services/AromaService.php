<?php

namespace App\Modules\Aromas\Services;

use App\Models\Aroma;
use App\Modules\Core\Services\Service;

class AromaService extends Service
{
    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function __construct(Aroma $model)
    {
        parent::__construct($model);
    }
}
