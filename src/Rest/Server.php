<?php

namespace Rest;


use Exception\HttpException;
use Router\{RouteCollection, Router};
use Config\File\Factory as ConfigFactory;
use Security\Handler as SecurityHandler;
use Security\Authentication\Storage\File as AuthStorage;
use Security\Authentication\Provider\BasicAuth as AuthProvider;
use Security\Authorization\Checker as AuthorizationChecker;

class Server
{
    /** @var Router */
    private $router;

    /** @var Response */
    private $response;

    /** @var SecurityHandler  */
    private $securityHandler;

    /** @var string */
    private $configDir;

    /**
     * Server constructor.
     * @param $configDir
     */
    public function __construct($configDir)
    {
        $this->configDir = $configDir;
        $this->response = new Response();

        $this->configureRouter();
        $this->configureSecurity();
    }

    /**
     *
     */
    public function run()
    {
        try {
            $route = $this->router->getCurrentRoute();
            $this->securityHandler->handle($route);

            $this->response->send(200, [
                'code'    => 200,
                'message' => 'OK',
                'content' =>  $route->dispatch()
            ]);
        } catch (HttpException $e) {
            $this->response->send($e->getStatusCode(), [
                'code'    => $e->getStatusCode(),
                'message' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            $this->response->send(500, [
                'code'    => 500,
                'message' => 'Internal Server Error'
            ]);
        }
    }

    /**
     *
     */
    private function configureRouter()
    {
        $configFile = $this->configDir . 'routes.json';
        $config = ConfigFactory::file($configFile, 'json');
        $routeCollection = new RouteCollection($config);
        $this->router = new Router($routeCollection);
    }

    /**
     *
     */
    private function configureSecurity()
    {
        $configFileUsers = $this->configDir . 'users.json';
        $configFileSecurity = $this->configDir . 'security.json';

        $usersConfig = ConfigFactory::file($configFileUsers, 'json');
        $authStorage = new AuthStorage($usersConfig);
        $authProvider = new AuthProvider($authStorage);

        $securityConfig = ConfigFactory::file($configFileSecurity, 'json');
        $securityChecker = new AuthorizationChecker($securityConfig);

        $this->securityHandler = new SecurityHandler($authProvider, $securityChecker);
    }
}
