<?php

namespace App\Services;

use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        $user = $this->authRepository->register($data);
        return [
            'user' => $user,
            'token' => $user->createToken('API Token')->accessToken,
        ];
    }

    public function login(array $credentials)
    {
        $user = $this->authRepository->login($credentials);
        if (!$user) {
            return null;
        }

        return [
            'user' => $user,
            'token' => $user->createToken('API Token')->accessToken,
        ];
    }

    public function loggedInUser()
    {
        return $this->authRepository->loggedInUser();
    }


    public function logout()
    {
        return $this->authRepository->logout();
    }
}
