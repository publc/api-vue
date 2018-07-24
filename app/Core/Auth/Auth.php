<?php

namespace App\Core\Auth;

use App\App;
use App\Core\JWT;
use App\Core\Config;
use App\Core\Cookie;
use App\Core\Contracts\AuthInterface;


class Auth implements AuthInterface
{
    protected $container;
    protected $app;
    protected $config;
    protected $jwt;

    public function __construct()
    {
        $this->container = new Container([
            'app' => function () {
                return new App();
            },
            'config' => function () {
                return new Config();
            },
            'jwt' => function () {
                return new JWT();
            },
            'cookie' => function () {
                return new Cookie();
            },
            'validate' => function () {
                return new Validate();
            },
            'session' => function () {
                return new Session();
            }
        ]);

        $this->app = $this->container->app;
        $this->config = $this->container->config;
        $this->jwt = $this->container->jwt;
        $this->cookie = $this->container->cookie;
        $this->validate = $this->container->validate;
        $this->session = $this->container->session;
    }

    protected function login()
    {
        //
    }

    public function register()
    {
        //
    }

    public function updatePassword()
    {
        //
    }

    public function remember()
    {
        //
    }

    public function rememberPassword()
    {
        //
    }
}
