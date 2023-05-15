<?php

namespace App\Services\auth;

use App\Repositories\auth\AuthRepository;

class AuthService
{
    private $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($credentials,$remember): bool
    {
        return $this->authRepository->login($credentials,$remember);
    }

}
