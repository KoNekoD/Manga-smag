<?php

namespace App\Shared\DTO;

use JsonSerializable;

class ErrorResponseDataDTO implements JsonSerializable
{
    public function __construct(public readonly int $code, public readonly string $reason)
    {
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
