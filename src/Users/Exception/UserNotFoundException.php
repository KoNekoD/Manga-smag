<?php

declare(strict_types=1);

namespace App\Users\Exception;

use App\Shared\Exception\BaseException;

class UserNotFoundException extends BaseException
{
    public function __construct(string $message = 'User not found')
    {
        parent::__construct($message, self::USERS_USER_NOT_FOUND);
    }

    public function getStatusCode(): int
    {
        return 404;
    }
}
