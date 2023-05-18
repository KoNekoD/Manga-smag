<?php

declare(strict_types=1);

namespace App\Security\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationDataStructure
{
    public function __construct(
        #[Assert\NotBlank]
        public ?string $name = null,
        #[Assert\NotBlank]
        public ?string $email = null,
        #[Assert\NotBlank, Assert\Length(min: 6)]
        public ?string $password = null
    )
    {
    }
}