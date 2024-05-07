<?php

namespace App\Repositories\_Auth;

use App\Models\User;
use App\Repositories\_Auth\AuthRepositoryInterface;
use App\Services\_Response\ApiResponseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends ApiResponseRepository implements AuthRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function login($input)
    {
        $password = Hash::make($input['password']);
        
        $user = $this->model->where('email', $input['email'])->where('password', $password)->first();
        if (!$user) {
            return $this->sendErrorResponse('Unauthorized', 401);
        }
        // $token = auth(ConstantService::AUTH_USER)->login($user);
        // $user = auth(ConstantService::AUTH_USER)->user();
        $data = [
            // 'token' => $token,
            // 'user' => [
            //     'name' => $user->fullname,
            //     'email' => $user->email,
            //     'avatar' => $user->avatar,
            //     'user_group_id' => explode(',', $user->user_group_id),
            //     'position_id' => $user->position_id,
            // ],
            // 'users' => $this->commonService->getAllUser(),
            // 'products' => $this->commonService->getAllProduct(),

        ];
        return $this->sendSuccessResponse($data);
    }


    public function register(array $data)
    {
        $user = $this->model->create($data);
        if ($user) {
            Auth::login($user);
            return $user;
        } else {
            return null;
        }
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }
}
