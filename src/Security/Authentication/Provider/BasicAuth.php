<?php

namespace Security\Authentication\Provider;


use Exception\UnauthorizedHttpException;
use Security\Authentication\Storage\StorageInterface;
use Security\Authentication\User;

class BasicAuth implements ProviderInterface
{
    /** @var StorageInterface  */
    private $storage;

    /**
     * BasicAuth constructor.
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return User
     * @throws UnauthorizedHttpException
     */
    public function authenticate(): User
    {
        $user = $this->storage->findUserByUsername($_SERVER['PHP_AUTH_USER']);

        if (!$user) {
            throw new UnauthorizedHttpException('Unauthorized');
        }

        if (password_verify($_SERVER['PHP_AUTH_PW'], $user->getPassword())) {
            return $user;
        }

        throw new UnauthorizedHttpException('Unauthorized');
    }
}
