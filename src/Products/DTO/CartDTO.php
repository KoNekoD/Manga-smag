<?php

declare(strict_types=1);

namespace App\Products\DTO;

use App\Products\Entity\Product;
use JsonSerializable;

class CartDTO implements JsonSerializable
{
    /**
     * @param CartProductDTO[] $products
     */
    public function __construct(
        public array $products = [],
    )
    {
    }

    /**
     * @return int[]
     */
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
                $this->products[$i]->itemPrice = $entity->getPrice();
                $this->products[$i]->image = $entity->getImage();
                $this->products[$i]->name = $entity->getName();
                return;
            }
        }
    }

    public function addProduct(CartProductDTO $dto): void
    {
        foreach ($this->products as $i => $product) {
            if ($product->id === $dto->id) {
                $this->products[$i]->count++;
                return;
            }
        }

        $this->products[] = $dto;
    }

    /**
     * Remove 1 item of product form cart
     */
    public function removeProduct(int $id): void
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

    /**
     * Remove a product from the cart
     */
    public function removeProductPosition(int $id): void
    {
        foreach ($this->products as $i => $product) {
            if ($product->id === $id) {
                unset($this->products[$i]);
                return;
            }
        }
    }
}