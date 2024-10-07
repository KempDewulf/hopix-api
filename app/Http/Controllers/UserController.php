<?php

namespace App\Http\Controllers;

use App\Modules\Users\Services\UserService;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
}
