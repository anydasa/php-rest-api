<?php

namespace Router;

use Config\ConfigInterface;

class RouteCollection extends \SplObjectStorage
{

    public function __construct(ConfigInterface $config = null)
    {
        if (!is_null($config)) {
            $this->setConfig($config);
        }
    }

    public function setConfig(ConfigInterface $config)
    {
        $this->fromArray($config->toArray());
    }

    public function fromArray(array $array)
    {
        foreach ($array as $item) {
            $this->attachRoute(new Route($item));
        }
    }

    public function attachRoute(Route $route)
    {
        parent::attach($route);
    }

}
