<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\_Auth\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthRepository $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        dd($request->all());
        return $this->authService->login($request);
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
