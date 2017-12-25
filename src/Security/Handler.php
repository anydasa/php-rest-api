<?php

namespace Security;


use Router\Route;
use Security\Authorization\Checker;
use Security\Authentication\Provider\ProviderInterface;

class Handler
{
    /** @var Checker  */
    private $authorizationChecker;

    /** @var ProviderInterface  */
    private $authenticationProvider;

    /**
     * Handler constructor.
     * @param ProviderInterface $authenticationProvider
     * @param Checker $authorizationChecker
     */
    public function __construct(ProviderInterface $authenticationProvider, Checker $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->authenticationProvider = $authenticationProvider;
    }

    /**
     * @param Route $route
     * @return bool
     * @throws \Exception\ForbiddenHttpException
     */
    public function handle(Route $route)
    {
        $user = $this->authenticationProvider->authenticate();

        return $this->authorizationChecker->isGranted($route, $user);
    }

}
