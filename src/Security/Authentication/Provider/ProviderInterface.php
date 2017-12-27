<?php

namespace Security\Authentication\Provider;


use Security\Authentication\User;

interface ProviderInterface
{
    /**
     * @return User
     */
    public function authenticate(): User;
}