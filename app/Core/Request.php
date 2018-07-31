<?php

namespace App\Core;

class Request
{
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function parseRequestMethod()
    {
        return strtolower(trim($_SERVER['REQUEST_METHOD']));
    }

    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getRoot()
    {
        return $_SERVER["DOCUMENT_ROOT"];
    }

    public function getWebParams($path, $route)
    {
        $method = $this->getMethod();
       
        if ($method === 'GET') {
            return $this->processGetParams($path, $route);
        }

        if ($method === 'POST') {
            return (object) $_POST;
        }
    }

    public function getApiParams($path, $route)
    {
        $method = $this->getMethod();

        if ($method === 'GET') {
            return $this->processGetParams($path, $route);
        }

        if ($method === 'POST') {
            if (file_get_contents('php://input')) {
                return json_decode(file_get_contents('php://input'));
            }

            if ($_POST) {
                return json_decode(json_encode($_POST));
            }
        }
    }

    public function getApiFiles()
    {
        if ($_FILES) {
            return json_decode(json_encode($_FILES));
        }
    }

    protected function processGetParams($path, $route)
    {
        $uri = $this->getUri();
        $reqParams = str_replace($path, '', $uri);
        $reqParams = explode('/', $reqParams);
        $paramsKeys = $route['handler']['params'];
        $params = [];

        foreach ($reqParams as $key => $value) {
            $params[$paramsKeys[$key]] = $value;
        }

        return (object) $params;
    }
}
