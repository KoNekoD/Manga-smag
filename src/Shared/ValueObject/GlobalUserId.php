<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

use App\Shared\Service\AssertService;

class GlobalUserId
{
    private readonly int $id;

    public function __construct(int $id)
    {
        AssertService::true($id > 0);
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
