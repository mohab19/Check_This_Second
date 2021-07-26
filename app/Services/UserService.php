<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;

class UserService
{

	private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

	public function ListUsers()
    {
        $users = $this->userRepository->all();

        return json_encode($users);
    }

}
