<?php

declare(strict_types=1);

namespace App\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Exception\UserAlreadyExistException;
use App\Users\Domain\Exception\UserNotFoundException;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository, private readonly UserFactory $userFactory)
    {
    }

    /**
     * @throws UserAlreadyExistException
     */
    public function __invoke(CreateUserCommand $createUserCommand): User
    {
        try {
            $this->userRepository->findByEmail($createUserCommand->email);
        } catch (UserNotFoundException) {
            $user = $this->userFactory->create(
                $createUserCommand->name,
                $createUserCommand->email,
                $createUserCommand->password
            );
            $this->userRepository->save($user, true);

            return $user;
        }

        throw new UserAlreadyExistException();
    }
}
