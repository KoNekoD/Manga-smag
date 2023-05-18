<?php

declare(strict_types=1);

namespace App\Shared\Event;

interface EventBusInterface
{
    public function execute(EventInterface $event): mixed;
}
