<?php

declare(strict_types=1);

namespace App\Users\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserEditDTO
{
    public function __construct(
        #[Assert\NotBlank, Assert\Length(min: 3)]
        public ?string $newName = null,
        public ?string $newPassword = null
    )
    {
    }
}