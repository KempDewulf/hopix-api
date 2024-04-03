<?php

namespace App\Http\Controllers;

use App\Modules\Users\Services\UserService;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        parent::__construct($userService);
    }
}
