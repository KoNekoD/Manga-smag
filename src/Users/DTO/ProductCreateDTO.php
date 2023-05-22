<?php

namespace App\Users\DTO;

class ProductCreateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly string $price,
        public readonly string $description,
    )
    {
    }
}