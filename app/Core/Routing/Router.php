<?php

namespace App\Core\Routing;

use App\Core\Container;

class Router
{
    protected $path;
    protected $routes = [];
    protected $container;

    public function __construct()
    {
        $this->container = new Container([
            'route' => function () {
                return new Route();
            }
        ]);
    }

    public function setPath($path = '/')
    {
        
        foreach ($this->routes as $uri => $route) {
            $params = $route['handler']['params'];
            
            if (count($params) !== 0 && strpos($path, $uri) !== false) {
                $path = $this->setPathWithParams($path, $uri, $params);
            }

            if ($path === $uri) {
                $this->path = $uri;
                return $this;
            }
        }
    }

    public function addRoute($uri, $handler, $method)
    {
        $route = $this->container->route->addRoute($uri, $handler, $method);
        $this->routes[$route['uri']] = [
            'handler' => $route['handler'],
            'method' => $route['method']
        ];
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getRoute()
    {
        if (empty($this->routes[$this->path])) {
            return false;
        }

        return $this->routes[$this->path];
    }

    protected function setPathWithParams($path, $uri, $params)
    {
        $validator = str_replace($uri, '', $path);
        $validator = explode('/', $validator);
        
        if (!empty($validator[0]) && count($validator) === count($params)) {
            return $uri;
        }
    }
}
