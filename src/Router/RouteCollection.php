<?php

namespace Router;

use Config\ConfigInterface;

class RouteCollection extends \SplObjectStorage
{

    /**
     * RouteCollection constructor.
     * @param ConfigInterface|null $config
     */
    public function __construct(ConfigInterface $config = null)
    {
        if (!is_null($config)) {
            $this->setConfig($config);
        }
    }

    /**
     * @param ConfigInterface $config
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->fromArray($config->toArray());
    }

    /**
     * @param array $array
     */
    public function fromArray(array $array)
    {
        foreach ($array as $item) {
            $this->attachRoute(new Route($item));
        }
    }

    /**
     * @param Route $route
     */
    public function attachRoute(Route $route)
    {
        parent::attach($route);
    }
}
