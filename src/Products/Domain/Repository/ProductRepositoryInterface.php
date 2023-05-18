<?php

declare(strict_types=1);

namespace App\Products\Domain\Repository;

use App\Products\Domain\Entity\Product;
use App\Products\Domain\Exception\ProductNotFoundException;

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