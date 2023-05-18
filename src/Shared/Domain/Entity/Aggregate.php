<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\Event\EventInterface;

class Aggregate
{
    /**
     * @var array<EventInterface>
     */
    private array $events;

    /**
     * @return array<EventInterface>
     */
    public function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    public function raise(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
