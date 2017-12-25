<?php

require_once __DIR__.'/../src/autoload.php';
$configDir = __DIR__.'/../config/';


use \Router\{RouteCollection, Router};
use \Rest\Server;
use \Config\File\Factory as ConfigFactory;
use \Security\Handler as SecurityHandler;
use \Security\Authentication\Storage\File as AuthStorage;
use \Security\Authentication\Provider\BasicAuth as AuthProvider;
use \Security\Authorization\Checker as AuthorizationChecker;

$routerConfig = ConfigFactory::file($configDir.'routes.json', 'json');
$routeCollection = new RouteCollection($routerConfig);
$router = new Router($routeCollection);

$usersConfig = ConfigFactory::file($configDir.'users.json', 'json');
$authStorage = new AuthStorage($usersConfig);
$authProvider = new AuthProvider($authStorage);

$securityConfig = ConfigFactory::file($configDir.'security.json', 'json');
$securityChecker = new AuthorizationChecker($securityConfig);

$securityHandler = new SecurityHandler($authProvider, $securityChecker);

$restServer = new Server($router, $securityHandler);
$restServer->dispatch();

