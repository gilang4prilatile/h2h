<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\User;

class LoginService
{
    private User $user;

    public function __construct(User $user)
    {
    }
}
