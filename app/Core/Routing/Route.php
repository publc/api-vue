<?php

namespace App\Core\Routing;

class Route
{
    protected $uri;
    protected $handler;
    protected $controller;
    protected $processor;
    protected $params = [];
    protected $method;

    public function addRoute($uri, $handler, $method)
    {
        $this->resetRoute();
        return $this->processRoute($uri, $handler, $method);
    }

    protected function resetRoute()
    {
        $this->uri = null;
        $this->handler = null;
        $this->controller = null;
        $this->processor = null;
        $this->params = [];
        $this->method = null;
    }

    protected function processRoute($uri, $handler, $method)
    {
        $this->addUri($uri)->setHandler($handler)->setMethod($method);
        return [
            'uri' => $this->uri,
            'handler' => [
                'controller' => $this->controller,
                'proccesor' => $this->processor,
                'params' => $this->params
            ],
            'method' => $this->method
        ];
    }

    protected function addUri($uri)
    {
        $this->parseUri($uri)->parseParams($uri);
        return $this;
    }

    protected function setHandler($handler)
    {
        $handler = explode('@', $handler);
        $this->controller = $handler[0];
        $this->processor = $handler[1];
        return $this;
    }

    protected function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    protected function parseUri($uri)
    {
        $parseUri = explode('{', $uri);
        $this->uri = reset($parseUri);
        return $this;
    }

    protected function parseParams($uri)
    {
        $parseUri = explode('{', $uri);
        unset($parseUri[0]);

        if (count($parseUri) < 1) {
            return $this;
        }
        
        $parseUri = implode('', $parseUri);
        $parseUri = str_replace('/', '', $parseUri);
        $parseUri = explode('}', $parseUri);
        foreach ($parseUri as $value) {
            if (!empty($value)) {
                $this->params[] = $value;
            }
        }

        return $this;
    }
}
