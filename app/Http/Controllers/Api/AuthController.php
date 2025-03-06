<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Traits\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->respondWithSuccess('Registered and Logged in Successfully', $this->authService->register($request->all()));
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $authData = $this->authService->login($credentials);
        if (!$authData) {
            return $this->respondWithError('Invalid Credentials');
        }

        return $this->respondWithSuccess('Logged in Successfully', $authData);
    }

    public function loggedInUser()
    {
        return $this->respondWithSuccess('Logged In User',$this->authService->loggedInUser());

    }

    public function logout()
    {
        $this->authService->logout();
        return $this->respondWithSuccess('Logged out successfully');
    }
}

