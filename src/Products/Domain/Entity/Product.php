<?php

declare(strict_types=1);

namespace App\Products\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'manga_products')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


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

    public function updateInformation(
        string  $name,
        int     $code,
        float   $price,
        ?string $description,
        ?string $image,
    ): void
    {
        $this->name = $name;
        $this->code = $code;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }
}