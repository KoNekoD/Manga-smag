<?php

declare(strict_types=1);

namespace App\Products\DTO;

use JsonSerializable;

class CartProductDTO implements JsonSerializable
{
    public function __construct(
        public int     $id,
        public int     $count,
        public float   $itemPrice,
        public ?string $image,
        public string  $name,
    )
    {
    }

    public function getTotalPrice(): float
    {
        return $this->count * $this->itemPrice;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'count' => $this->count,
            'itemPrice' => $this->itemPrice,
            'image' => $this->image,
            'name' => $this->name
        ];
    }
}