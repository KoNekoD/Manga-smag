<?php

declare(strict_types=1);

namespace App\Users\DTO;

use App\Shared\Security\AuthUserInterface;
use App\Users\Entity\User;
use JsonSerializable;

class UserDTO implements JsonSerializable
{
    public function __construct(public readonly int $id, public readonly string $login)
    {
    }

    public static function fromEntity(User $user): self
    {
        return self::fromAuthUserInterface($user);
    }

    public static function fromAuthUserInterface(AuthUserInterface $authUser): self
    {
        return new self($authUser->getId(), $authUser->getEmail());
    }

    /** @return array<string> */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
