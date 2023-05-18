<?php

declare(strict_types=1);

namespace App\Users\Service;

use App\Users\Entity\User;

interface UserPasswordHasherInterface
{
    public function hash(User $user, string $password): string;
}
