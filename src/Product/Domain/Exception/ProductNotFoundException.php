<?php

declare(strict_types=1);

namespace App\Product\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class ProductNotFoundException extends BaseException
{
    public function getStatusCode(): int
    {
        return 404;
    }
}