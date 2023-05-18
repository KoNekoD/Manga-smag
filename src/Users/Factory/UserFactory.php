<?php

declare(strict_types=1);

namespace App\Users\Factory;

use App\Users\Entity\User;
use App\Users\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(string $name, string $email, string $password): User
    {
        $user = new User($name, $email);

        $user->setPassword($password, $this->passwordHasher);

        return $user;
    }
}
