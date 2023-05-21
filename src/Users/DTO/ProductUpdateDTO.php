<?php

namespace App\Users\DTO;

class ProductUpdateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly int $code,
        public readonly float $price,
        public readonly string $image,
        public readonly string $description,
    )
    {
    }
}