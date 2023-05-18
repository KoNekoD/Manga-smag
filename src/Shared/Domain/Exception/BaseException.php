<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception;

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

    public const PROFILES_PROFILE_NOT_FOUND = 1001;
    public const PROFILES_NOT_YOUR_PROFILE = 1003;

    public const FRIENDS_FRIEND_NOT_FOUND = 2003;
    public const FRIENDS_USING_SHARED_USER = 2001;
    public const FRIENDS_SELF_FRIEND_ADDING = 2002;

    public const CHATS_CHAT_NOT_FOUND = 5001;
    public const CHATS_PARTICIPANT_NOT_FOUND = 5002;
    public const CHATS_PARTICIPANT_ALREADY_EXIST = 5003;
    public const CHATS_ROLE_NOT_FOUND = 5004;
    public const CHATS_ROLE_NOT_OWNER = 5005;
    public const CHATS_ROLE_NOT_CAN_RESTRICT = 5006;
    public const CHATS_MESSAGE_NOT_FOUND = 5007;
}
