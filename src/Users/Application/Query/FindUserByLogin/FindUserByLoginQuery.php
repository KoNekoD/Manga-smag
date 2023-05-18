<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUserByLogin;

use App\Shared\Application\Query\QueryInterface;

class FindUserByLoginQuery implements QueryInterface
{
    public function __construct(public readonly string $login)
    {
    }
}
