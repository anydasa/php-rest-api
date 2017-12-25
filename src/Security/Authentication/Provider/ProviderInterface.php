<?php

namespace Security\Authentication\Provider;


use Security\Authentication\User;

interface ProviderInterface
{
    public function authenticate(): User;
}