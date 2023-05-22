<?php

namespace App\Users\DTO;

class ProductUpdateDTO
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