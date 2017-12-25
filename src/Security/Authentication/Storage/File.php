<?php
/**
 * Created by PhpStorm.
 * User: anydasa
 * Date: 12/24/17
 * Time: 8:29 PM
 */

namespace Security\Authentication\Storage;


use Config\ConfigInterface;
use Security\Authentication\User;

class File implements StorageInterface
{
    private $users;

    public function __construct(ConfigInterface $config)
    {
        $this->users = $config->toArray();
    }

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
