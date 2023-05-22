<?php

declare(strict_types=1);

namespace App\Shared\Security;

use Symfony\Bundle\SecurityBundle\Security;
use Webmozart\Assert\Assert;
use function get_class;

class UserFetcher implements UserFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getAuthUser(): AuthUserInterface
    {
        /** @var AuthUserInterface $user */
        $user = $this->security->getUser();


        Assert::notNull($user);
        Assert::isInstanceOf($user, AuthUserInterface::class, sprintf('Invalid user type %s', get_class($user)));

        return $user;
    }
}
