<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
   public function getModel()
   {
    return User::class;
   }

    public function firstByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function list($requests, $page, $perpage){
        return $this->model->paginate($perpage, ['*'], 'page', $page);
    }
}
