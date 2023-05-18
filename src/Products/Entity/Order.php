<?php

declare(strict_types=1);

namespace App\Products\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'manga_orders')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private readonly DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'string', length: 180)]
    private string $status = '1';

    public function __construct(
        #[ORM\Column(type: 'string', length: 180)]
        private string  $userName,
        #[ORM\Column(type: 'string', length: 180)]
        private string  $userPhone,
        #[ORM\Column(type: 'text', nullable: true)]
        private ?string $userComment,
        #[ORM\Column(type: 'integer', nullable: true)]
        private ?int    $userId,
        /** @var int[] $productsIds */
        #[ORM\Column(type: 'json')]
        private array   $productsIds,
    )
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserPhone(): string
    {
        return $this->userPhone;
    }

    public function getUserComment(): ?string
    {
        return $this->userComment;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getProductsIds(): array
    {
        return $this->productsIds;
    }
}