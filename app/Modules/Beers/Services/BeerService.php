<?php

namespace App\Modules\Beers\Services;

use App\Models\Beer;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BeerService extends Service
{
    protected $rules = [
        'name' => 'required',
    ];

    public function validate($data)
    {
        $this->errors = new MessageBag();

        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
        }
    }
}
