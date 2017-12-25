<?php

namespace Security\Authentication\Storage;


use Security\Authentication\User;

interface StorageInterface
{
    public function findUserByUsername($username):? User;
}
