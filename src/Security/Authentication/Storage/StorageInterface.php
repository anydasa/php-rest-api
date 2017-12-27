<?php

namespace Security\Authentication\Storage;


use Security\Authentication\User;

interface StorageInterface
{
    /**
     * @param $username
     * @return null|User
     */
    public function findUserByUsername($username):? User;
}
