<?php

declare(strict_types=1);

namespace App\Products\Entity;

use App\Shared\Domain\Service\UlidService;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'manga_orders_products')]
class OrderProduct
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'NONE'), ORM\Column]
    private readonly string $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'elements')]
        #[ORM\JoinColumn(name: 'order_id', referencedColumnName: 'id')]
        private readonly Order   $order,
        #[ORM\ManyToOne(targetEntity: Product::class)]
        #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
        private readonly Product $product,
        #[ORM\Column]
        private readonly int     $count
    )
    {
        $this->id = UlidService::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}