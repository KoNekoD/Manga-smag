<?php

declare(strict_types=1);

namespace App\Product\Domain\Repository;

use App\Product\Domain\Entity\Product;
use App\Product\Domain\Exception\ProductNotFoundException;

interface ProductRepositoryInterface
{
    // TODO
    /**
     * @param int[] $ids
     * @return Product[]
     */
    public function findByIds(array $ids): array;

    /** @throws ProductNotFoundException */
    public function findById(int $id): Product;
}