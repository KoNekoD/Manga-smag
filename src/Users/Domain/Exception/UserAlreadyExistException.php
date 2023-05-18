<?php

namespace App\Users\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;
use Symfony\Component\HttpFoundation\Response;

class UserAlreadyExistException extends BaseException
{
    public function __construct(string $message = 'User already exist')
    {
        parent::__construct($message, self::USERS_USER_ALREADY_EXIST);
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}
