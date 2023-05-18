<?php

declare(strict_types=1);

namespace App\Cart\DTO;

use App\Products\Entity\Product;
use JsonSerializable;

class CartDTO implements JsonSerializable
{
    public function __construct(
        /** @var CartProductDTO[] $products */
        public array $products = [],
    )
    {
    }

    /** @return int[] */
    public function getProductsIds(): array
    {
        $result = [];
        foreach ($this->products as $product) {
            $result[] = $product->id;
        }
        return $result;
    }

    public function jsonSerialize(): array
    {
        return [
            'products' => $this->products
        ];
    }

    public function getTotalPrice(): float
    {
        $totalPrice = 0.0;
        foreach ($this->products as $product) {
            $totalPrice += $product->itemPrice * $product->count;
        }
        return $totalPrice;
    }

    public function getTotalCount(): int
    {
        $totalCount = 0;
        foreach ($this->products as $product) {
            $totalCount += $product->count;
        }
        return $totalCount;
    }

    public function updateProductPrice(Product $entity): void
    {
        foreach ($this->products as $i => $product) {
            if ($entity->getId() === $product->id) {
                $this->products[$i]->itemPrice = $product->getPrice();
                $this->products[$i]->image = $product->getImage();
                $this->products[$i]->name = $product->getName();
                return;
            }
        }
    }

    public function addProduct(int $id, string $name, float $price, string $image): void
    {
        foreach ($this->products as $i => $product) {
            if ($product->id === $id) {
                $this->products[$i]->count++;
                return;
            }
        }

        $this->products[] = new CartProductDTO(
            $id,
            1,
            $price,
            $image,
            $name
        );
    }

    public function removeProduct(int $id, string $name, float $price, string $image): void
    {
        foreach ($this->products as $i => $product) {
            if ($product->id === $id) {
                if ($product->count === 1) {
                    unset($this->products[$i]);
                    return;
                }

                $this->products[$i]->count--;
                return;
            }
        }
    }
}