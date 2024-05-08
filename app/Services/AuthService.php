<?php

namespace App\Services;

use App\Repositories\_Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Helper\ApiResponseHelper;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    protected $authinterface;
    public function __construct(AuthRepositoryInterface $authinterface)
    {
        $this->authinterface = $authinterface;
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

        $token = $this->authinterface->generateToken($attributes['email']);
        // dd($token);
        $data = [
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_at' => $token->accessToken->expires_at->format('d-m-Y H:i:s'),
        ];
        return ApiResponseHelper::sendSuccessResponse($data, Response::HTTP_OK);
    }
}
