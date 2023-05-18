<?php

declare(strict_types=1);

namespace App\Shared\Service;

class PaginatorService
{
    public function __construct()
    {
    }

    /**
     * @return iterable<object>
     * @deprecated
     *
     */
    public function paginate(mixed $target, int $page, int $limit): iterable
    {
        if ($page < 1) {
            $page = 1;
        }

        $firstResult = $limit * ($page - 1);

        return $target
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
            ->getResult();
        // old knp paginator #TODO remove
        // return $this->paginator->paginate($target, $page, $limit)->getItems();
    }

    /** @return iterable<object> */
    public function paginateNative(mixed $target, int $page, int $limit): iterable
    {
        if ($page < 1) {
            $page = 1;
        }

        $firstResult = $limit * ($page - 1);

        return $target
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
            ->getResult();
    }
}
