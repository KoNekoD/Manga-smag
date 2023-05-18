<?php

declare(strict_types=1);

namespace App\Users\Application\DTO;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Users\Domain\Entity\User;

class UserDTO implements \JsonSerializable
{
    public function __construct(public readonly string $id, public readonly string $login)
    {
    }

    public static function fromEntity(User $user): self
    {
        return self::fromAuthUserInterface($user);
    }

    public static function fromAuthUserInterface(AuthUserInterface $authUser): self
    {
        return new self($authUser->getId(), $authUser->getLogin());
    }

    /** @return array<string> */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
