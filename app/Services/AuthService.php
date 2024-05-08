<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Helper\ApiResponseHelper;
use App\Repositories\_Auth\AuthRepository;
use Symfony\Component\HttpFoundation\Response;

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

        if (!Auth::attempt($attributes)) {
            return ApiResponseHelper::sendErrorResponse('Unauthenticated', Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->authRepository->generateToken($attributes['email']);
        // dd($token);
        $data = [
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_at' => $token->accessToken->expires_at->format('d-m-Y H:i:s'),
        ];
        return ApiResponseHelper::sendSuccessResponse($data, Response::HTTP_OK);
    }
}
