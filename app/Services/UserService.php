<?php

namespace App\Services;

use App\Helper\ApiResponseHelper;
use App\Helper\ConstantHelper;
use App\Repositories\User\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    protected $userRepository;
    public function __construct( UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list($requests){
        $page = $requests['page'] ?? ConstantHelper::DEFAULT_PAGE;
        $perPage = $requests['per_page'] ?? ConstantHelper::DEFAULT_PER_PAGE;

        $users = $this->userRepository->list($requests, $page, $perPage);
        return ApiResponseHelper::sendSuccessResponse($users, Response::HTTP_OK);
    }
}