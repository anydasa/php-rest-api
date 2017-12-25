<?php

namespace Security\Authorization;


use Config\ConfigInterface;
use Exception\ForbiddenHttpException;
use Security\Authentication\User;
use Router\Route;

class Checker
{
    /** @var ConfigInterface  */
    private $config;

    /**
     * Checker constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @param Route $route
     * @param User $user
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function isGranted(Route $route, User $user)
    {
        foreach ($this->config->toArray() as $accessItem) {
            $pattern = '@^' . $accessItem['path'] . '@i';

            if (!preg_match($pattern, $route->getUrl())) {
                continue;
            }

            if (count(array_intersect($user->getRoles(), $accessItem['roles'])) > 0) {
                return true;
            }
        }
        
        throw new ForbiddenHttpException('Forbidden');
    }
}
