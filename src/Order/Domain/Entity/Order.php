<?php

declare(strict_types=1);

namespace App\Order\Domain\Entity;

class Order
{
    public function __construct(
        public string  $userName,
        public string  $userPhone,
        public ?string $userComment,
        public ?string $userId,
        /** @var int[] $productsIds */
        public array   $productsIds,
    )
    {
    }
}