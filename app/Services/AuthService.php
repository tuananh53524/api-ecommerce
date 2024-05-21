<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Helper\ApiResponseHelper;
use App\Repositories\_Auth\AuthRepository;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($credentials)
    {
        $attributes = [
            'email' => strtolower($credentials['email']),
            'password' => $credentials['password'],
        ];

        if (! $token = auth()->attempt($attributes)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
        return ApiResponseHelper::sendSuccessResponse($data, Response::HTTP_OK);
    }
}
