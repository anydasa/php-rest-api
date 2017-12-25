<?php

namespace Security\Authorization;


use Config\ConfigInterface;
use Security\Authentication\User;
use Router\Route;

class Checker
{
    private $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function isGranted(Route $route, User $user)
    {
        return true;
    }
}
