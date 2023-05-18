<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Service\AssertService;

class GlobalUserId
{
    private readonly string $id;

    public function __construct(string $id)
    {
        AssertService::true(UlidService::isValid($id));
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
