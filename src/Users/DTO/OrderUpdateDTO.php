<?php

namespace App\Users\DTO;

class OrderUpdateDTO
{
    public function __construct(
        public readonly string $userName,
        public readonly string $userPhone,
        public readonly string $userComment,
        public readonly string $status,
    )
    {
    }
}