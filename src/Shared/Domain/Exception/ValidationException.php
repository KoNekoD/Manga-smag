<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception;

class ValidationException extends BaseException
{
    public function __construct(string $message = 'Validation failed')
    {
        parent::__construct($message, self::SHARED_VALIDATION_FAILED);
    }

    public function getStatusCode(): int
    {
        return 400; // Bad request
    }
}
