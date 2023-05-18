<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Exception\UserNotFoundException;

interface UserRepositoryInterface
{
    /** @throws UserNotFoundException */
    public function findByEmail(string $email): User;

    public function save(User $entity, bool $flush = false): void;
}