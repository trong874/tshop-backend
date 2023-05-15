<?php

namespace App\Repositories\auth;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    private const IS_ADMIN = '1';
    public function login($credentials,$remember): bool
    {
        $credentials['account_type'] = self::IS_ADMIN; //phải là admin mới được vào

        return Auth::attempt($credentials,$remember);
    }
}
