<?php

namespace Security\Authentication\Provider;


use Security\Authentication\Storage\StorageInterface;
use Security\Authentication\User;

class BasicAuth implements ProviderInterface
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function authenticate(): User
    {
        $user = $this->storage->findUserByUsername($_SERVER['PHP_AUTH_USER']);

        $passwordHash = password_hash($_SERVER['PHP_AUTH_PW'], PASSWORD_BCRYPT);

        if ($user->getPassword() === $passwordHash) {
            return $user;
        }

        throw new UnauthorizedException('Unauthorized');
    }
}
