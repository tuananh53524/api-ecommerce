<?php
namespace App\Repositories\_Auth;

use App\Repositories\BaseRepositoryInterface;

interface AuthRepositoryInterface
{
    public function login($input);
}