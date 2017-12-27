<?php

namespace Security\Authentication\Storage;


use Config\ConfigInterface;
use Security\Authentication\User;

class File implements StorageInterface
{
    /** @var array */
    private $users;

    /**
     * File constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->users = $config->toArray();
    }

    /**
     * @param $username
     * @return null|User
     */
    public function findUserByUsername($username):? User
    {
        foreach ($this->users as $user) {
            if ($user['username'] === $username) {
                $userObject = new User();
                $userObject->setUsername($user['username']);
                $userObject->setPassword($user['password']);
                $userObject->setRoles($user['roles']);
                return $userObject;
            }
        }

        return null;
    }
}
