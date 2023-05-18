<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Console;

use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

#[AsCommand(
    name: 'app:users:create-user',
    description: 'Create user'
)]
final class CreateUser extends Command
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserFactory    $userFactory
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $login = $io->ask(
            'login',
            null,
            function (?string $login) {
                Assert::notEmpty($login, 'Login cannot be empty');

                return $login;
            }
        );

        $password = $io->askHidden(
            'password',
            function (?string $password) {
                Assert::notEmpty($password, 'Password cannot be empty');

                return $password;
            }
        );

        $user = $this->userFactory->create($login, $password);
        $this->userRepository->add($user);

        return Command::SUCCESS;
    }
}
