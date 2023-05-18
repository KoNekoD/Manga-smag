<?php

declare(strict_types=1);

namespace App\Shared\Query;

interface QueryBusInterface
{
    public function execute(QueryInterface $query): mixed;
}
