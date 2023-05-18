<?php

declare(strict_types=1);

namespace App\Users\Service;

use App\Users\Entity\User;
use App\Users\Exception\UserAlreadyExistException;
use App\Users\Exception\UserNotFoundException;
use App\Users\Factory\UserFactory;
use App\Users\Repository\UserRepository;

class CreateUserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserFactory    $userFactory
    )
    {
    }

    /** @throws UserAlreadyExistException */
    public function create(
        string $name,
        string $email,
        string $password
    ): User
    {
        try {
            $this->userRepository->findByEmail($email);
        } catch (UserNotFoundException) {
            $user = $this->userFactory->create(
                $name,
                $email,
                $password
            );
            $this->userRepository->save($user, true);

            return $user;
        }

        throw new UserAlreadyExistException();
    }
}