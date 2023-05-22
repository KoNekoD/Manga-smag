<?php

declare(strict_types=1);

namespace App\Products\Entity;

use App\Users\DTO\ProductUpdateDTO;
use Carbon\Carbon;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'manga_products')]
class Product
{
    const LATEST_PRODUCTS_COUNT = 10;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __construct(
        #[ORM\Column(length: 180)]
        private string  $name,
        #[ORM\Column]
        private int     $code,
        #[ORM\Column]
        private float   $price,
        #[ORM\Column(type: 'text', nullable: true)]
        private ?string $description = null,
        #[ORM\Column(type: 'text', nullable: true)]
        private ?string $image = null,
    )
    {
        $this->createdAt = (new Carbon())->toDateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function updateInformation(ProductUpdateDTO $dto): void
    {
        $this->name = $dto->name;
        $this->code = (int)$dto->code;
        $this->price = (float)$dto->price;
        $this->description = $dto->description;
    }

    public function setImage(string $newFilename): void
    {
        $this->image = $newFilename;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}