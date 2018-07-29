<?php

namespace App\Core;

use App\App;
use App\Core\Config;
use App\Core\Request;
use App\Core\Auth\Auth;
use App\Core\Container;
use App\Core\PHPMailer;
use App\Core\Contracts\APIInterface;

class Api implements APIInterface
{
    protected $app;
    protected $mailer;
    protected $config;
    protected $request;
    protected $auth;
    protected $container;
    protected $controller;

    public function __construct()
    {
        $this->container = new Container([
            'app' => function () {
                return new App();
            },
            'mailer' => function () {
                return new PHPMailer();
            },
            'config' => function () {
                return new Config();
            },
            'request' => function () {
                return new Request();
            },
            'auth' => function () {
                return new Auth();
            }
        ]);

        $this->app = $this->container->app;
        $this->mailer = $this->container->mailer;
        $this->config = $this->container->config;
        $this->request = $this->container->request;
        $this->auth = $this->container->auth;

        $this->addController();
    }

    public function response($response)
    {
        if (is_null($response)) {
            $response = [
                'error' => 'Can not process the request'
            ];
            return $this->app->response()->json($response, 400);
        }

        return $this->app->response()->json($response);
    }

    protected function validate($params)
    {
        $method = $this->request->parseRequestMethod();

        if ($method !== 'get' && (is_null($params) || empty($params))) {
            return $this->app->response()->json([
                'error' => 'Can not process the request. Not payload provided'
            ], 400);
        }
    }

    protected function addController()
    {
        if (is_null($this->controller)) {
            $controller = (new \ReflectionClass($this))->getShortName();
            $controller = str_replace('API', '', $controller);
            $controller = 'App\Http\Controller\\' . $controller . 'Controller';
        } else {
            $path = explode('->', $this->controller);

            foreach ($path as &$param) {
                $param = ucwords(strtolower($param));
            }

            $path = implode('\\', $path);
            $controller = 'App\Http\Controller\\' . $path . 'Controller';
        }

        if (class_exists($controller)) {
            $this->controller = new $controller();
        }
    }
}
