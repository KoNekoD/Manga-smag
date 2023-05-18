<?php

declare(strict_types=1);

namespace App\Products\Repository;

use App\Products\Entity\Product;
use App\Products\Exception\ProductNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByIds(array $ids): array
    {
        return $this->findBy(['id' => $ids]);
    }

    public function findById(int $id): Product
    {
        $product = $this->find($id);

        if (null === $product) {
            throw new ProductNotFoundException();
        }

        return $product;
    }
}