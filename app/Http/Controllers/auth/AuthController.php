<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Services\auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('auth.login');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->ensureIsNotRateLimited();

        $credentials = $request->only('username','password');
        $remember = $request->get('remember');

        if ( $this->authService->login($credentials,$remember) ) {

            RateLimiter::clear($request->throttleKey());

            return redirect()->intended();
        }

        RateLimiter::hit($request->throttleKey());

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return back();
    }
}
