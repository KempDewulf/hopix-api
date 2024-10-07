<?php

namespace App\Modules\Users\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;

class UserService extends Service
{
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users|max:255',
        'password' => 'required|string|min:8',
        'is_admin' => 'boolean',
    ];

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
