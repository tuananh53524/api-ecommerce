<?php
namespace App\Repositories\_Auth;

use App\Repositories\BaseRepositoryInterface;

interface AuthRepositoryInterface extends BaseRepositoryInterface
{
    public function firstByEmail(string $email);

    public function generateToken(string $email);
}