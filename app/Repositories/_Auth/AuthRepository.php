<?php

namespace App\Repositories\_Auth;

use App\Models\User;
use App\Repositories\_Auth\AuthRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
   public function getModel()
   {
    return User::class;
   }

    public function firstByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function generateToken(string $email)
    {
        $user = $this->firstByEmail($email);

        return $user->createToken('user', ['user-abilities'], now()->addMinutes(config('sanctum.expiration')));
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
