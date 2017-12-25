<?php

namespace Security;


use Router\Route;
use Security\Authorization\Checker;
use Security\Authentication\Provider\ProviderInterface;

class Handler
{
    private $authorizationChecker;
    private $authenticationProvider;

    public function __construct(ProviderInterface $authenticationProvider, Checker $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->authenticationProvider = $authenticationProvider;
    }

    public function handle(Route $route)
    {
        $user = $this->authenticationProvider->authenticate();
        return $this->authorizationChecker->isGranted($route, $user);
    }

}
