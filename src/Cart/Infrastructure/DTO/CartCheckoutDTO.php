<?php

declare(strict_types=1);

namespace App\Cart\Infrastructure\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CartCheckoutDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public ?string $userName = null,
        #[Assert\NotBlank]
        public ?string $userPhone = null,
        public ?string $userComment = null,
    )
    {
    }
}