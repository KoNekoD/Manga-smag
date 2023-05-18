<?php

declare(strict_types=1);

namespace App\Products\Exception;

use App\Shared\Exception\BaseException;

class ProductNotFoundException extends BaseException
{
    public function getStatusCode(): int
    {
        return 404;
    }
}