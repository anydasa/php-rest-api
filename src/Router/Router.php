<?php

namespace Router;


class Router
{
    private $routeCollection;

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    public function match($requestUrl, $requestMethod) :?Route
    {
        /** @var Route $route */
        foreach ($this->routeCollection as $route) {
            if (!in_array(strtoupper($requestMethod), $route->getMethods())) {
                continue;
            }
            return $route;
        }

        return null;
    }

}
