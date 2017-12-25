<?php

namespace Rest;

use Router\Route;
use Router\Router;
use Security\Authentication\Provider\UnauthorizedException;
use Security\Handler as SecurityHandler;

class Server
{
    /** @var Router */
    private $router;

    /** @var Response */
    private $response;

    /** @var SecurityHandler  */
    private $securityHandler;

    public function __construct(Router $router, SecurityHandler $securityHandler)
    {
        $this->router = $router;
        $this->securityHandler = $securityHandler;
        $this->response = new Response();
    }

    public function dispatch()
    {
        try {
            $route = $this->matchRoute();
            $this->handleSecurityRoute($route);

        } catch (RestException $e) {
            $this->response->setStatus($e->getCode());
            $this->response->send(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

    private function matchRoute()
    {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if ($route = $this->router->match($url, $method)) {
            return $route;
        }

        throw new RestException(404, 'Not Found');
    }

    private function handleSecurityRoute(Route $route)
    {
        try {
            $this->securityHandler->handle($route);
        } catch (UnauthorizedException $e) {
            throw new RestException(401, $e->getMessage());
        }

    }



}
