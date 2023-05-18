<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUserByLogin;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Exception\UserNotFoundException;
use App\Users\Domain\Repository\UserRepositoryInterface;

class FindUserByLoginQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(FindUserByLoginQuery $query): UserDTO
    {
        $user = $this->userRepository->findByLogin($query->login);

        return UserDTO::fromEntity($user);
    }
}
