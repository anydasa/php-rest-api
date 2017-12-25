<?php

namespace Router;

use InvalidArgumentException;

class Route
{
    private $url;
    private $methods;
    private $controller;
    private $action;
    private $params = [];

    public function __construct(array $config)
    {
        $this->setConfig($config);
    }

    public function setConfig(array $config)
    {
        if (!array_key_exists('route', $config)) {
            throw new InvalidArgumentException('Parameter route is required');
        }
        if (!array_key_exists('methods', $config) || !is_array($config['methods'])) {
            throw new InvalidArgumentException('Parameter methods is required and must to be an array');
        }
        if (!array_key_exists('controller', $config)) {
            throw new InvalidArgumentException('Parameter controller is required');
        }
        if (!array_key_exists('action', $config)) {
            throw new InvalidArgumentException('Parameter action is required');
        }

        $this->url        = $config['route'];
        $this->methods    = array_map('strtoupper', $config['methods']);
        $this->controller = $config['controller'];
        $this->action     = $config['action'];
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function match($requestUrl)
    {
        $route = preg_replace('/:([\w]+)/', '([\w-%]+)', $this->getUrl());
        $pattern = '@^' . $route . '/?$@i';


        if (!preg_match($pattern, $requestUrl, $matches)) {
            return false;
        }

        if (count($matches) === 1) {
            return true;
        }

        if (preg_match_all('/:([\w-%]+)/', $this->getUrl(), $argument_keys)) {

            if(count($argument_keys[1]) !== (count($matches)-1)) {
                return false;
            }

            $this->params = array_combine(
                $argument_keys[1],
                array_slice($matches, 1)
            );

            return true;
        }

        return false;
    }

    public function dispatch($params = [])
    {
        $class = "\\Controller\\{$this->controller}";

        if (!class_exists($class)) {
            throw new \Exception('Controller not found');
        }

        $controller = new $class();
        $action = $this->action.'Action';

        if (!method_exists($class, $action)) {
            throw new \Exception('Action not found');
        }

        $reflectionMethod = new \ReflectionMethod($class, $action);

        $arrangedParams = array_map(function ($parameter) use ($params) {
            $param = $parameter->getName();
            return array_key_exists($param, $params) ? $params[$param] : null;
        }, $reflectionMethod->getParameters());
        

        return $reflectionMethod->invokeArgs($controller, $arrangedParams);
    }
}
