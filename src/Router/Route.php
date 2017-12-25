<?php

namespace Router;

use InvalidArgumentException;

class Route
{
    private $url;
    private $methods;
    private $controller;
    private $action;

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

    /*public function dispatch()
    {
        $class = "\\Controller\\{$this->controller}";
        $controller = new $class();
        $controller->{$this->action}();
    }*/
}
