<?php

declare(strict_types=1);

namespace App\Shared\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

abstract class BaseException extends \Exception implements HttpExceptionInterface
{
    public function __construct(string $message = 'Unnamed exception', int $code = 0)
    {
        parent::__construct($message, $code);
    }

    abstract public function getStatusCode(): int;

    /**
     * @return array<null>
     */
    public function getHeaders(): array
    {
        return [];
    }

    public const SHARED_VALIDATION_FAILED = 666;

    public const USERS_USER_NOT_FOUND = 501;
    public const USERS_USER_ALREADY_EXIST = 502;
}
