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

        $name = $io->ask(
            'name',
            null,
            static function (?string $name) {
                Assert::notEmpty($name, 'Name cannot be empty');

                return $name;
            }
        );

        $email = $io->ask(
            'email',
            null,
            static function (?string $email) {
                Assert::notEmpty($email, 'Email cannot be empty');

                return $email;
            }
        );

        $password = $io->askHidden(
            'password',
            static function (?string $password) {
                Assert::notEmpty($password, 'Password cannot be empty');

                return $password;
            }
        );

        $user = $this->userFactory->create($name, $email, $password);
        $this->userRepository->save($user, true);

        return Command::SUCCESS;
    }
}
