<?php

declare(strict_types=1);

namespace App\Products\Entity;

use App\Users\DTO\OrderUpdateDTO;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /** @var Collection<int, OrderProduct> */
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderProduct::class, orphanRemoval: true)]
    private Collection $elements;

    public function __construct(
        #[ORM\Column(type: 'string', length: 180)]
        private string  $userName,
        #[ORM\Column(type: 'string', length: 180)]
        private string  $userPhone,
        #[ORM\Column(type: 'text', nullable: true)]
        private ?string $userComment,
        #[ORM\Column(type: 'integer', nullable: true)]
                        // TODO To relation maybe
        private readonly ?int $userId,
    )
    {
        $this->createdAt = new DateTimeImmutable();
        $this->elements = new ArrayCollection();
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

    public function getStatusText(): string
    {
        return match ($this->status) {
            '1' => 'Новый заказ',
            '2' => 'В обработке',
            '3' => 'Доставляется',
            '4' => 'Закрыт',
            default => "Неизвестный статус: $this->status",
        };
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

    public function updateInformation(OrderUpdateDTO $dto): void
    {
        $this->userName = $dto->userName;
        $this->userPhone = $dto->userPhone;
        $this->userComment = $dto->userComment;
        $this->status = $dto->status;
    }

    public function addElement(OrderProduct $orderProduct): void
    {
        $this->elements->add($orderProduct);
    }

    public function getElements(): Collection
    {
        return $this->elements;
    }
}