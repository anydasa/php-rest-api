<?php

namespace Router;


use Exception\NotFoundHttpException;

class Router
{
    private $routeCollection;

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    /**
     * @return Route
     * @throws NotFoundHttpException
     */
    public function getCurrentRoute(): Route
    {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        return $this->match($url, $method);
    }

    /**
     * @param $requestUrl
     * @param $requestMethod
     * @return Route
     * @throws NotFoundHttpException
     */
    public function match($requestUrl, $requestMethod): Route
    {
        /** @var Route $route */
        foreach ($this->routeCollection as $route) {
            if (!in_array(strtoupper($requestMethod), $route->getMethods())) {
                continue;
            }
            return $route;
        }

        throw new NotFoundHttpException('Resource not found');
    }
}
