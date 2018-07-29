<?php

namespace App\Core\Auth;

use App\App;
use App\Core\JWT;
use App\Core\Hash;
use App\Core\Config;
use App\Core\Cookie;
use App\Core\Session;
use App\Core\Validate;
use App\Core\Container;
use App\Core\Contracts\AuthInterface;


class Auth implements AuthInterface
{
    protected $container;
    protected $app;
    protected $config;
    protected $jwt;
    protected $hash;
    protected $cookie;
    protected $validate;
    protected $session;

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
            'hash' => function () {
                return new Hash();
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
        $this->hash = $this->container->hash;
        $this->cookie = $this->container->cookie;
        $this->validate = $this->container->validate;
        $this->session = $this->container->session;
    }

    public function hash($pass)
    {
        return $this->hash->make($pass);
    }

    public function login($params)
    {
        if (!empty($params->remember) || $params->remember === true) {
            $config = $this->config->get('remember');
            $expired = $config->exp;
        }

        $jwt = $this->setJwt($params, !empty($remember));
        return $this->setCookie($jwt, !empty($remember));
    }

    public function logged()
    {
        $cookie = $this->cookie->get('user');
        
        if (empty($cookie) || is_null($cookie)) {
            return false;
        }

        $config = $this->config->get('jwt');
        $jwt = $this->jwt->decode($cookie, $config->secret, $config->algo);
        
        if (!empty($jwt->user)) {
            return $jwt->user;
        }
    }

    public function logout()
    {
        return $this->cookie->destroy('user');
    }

    protected function setJwt($params, $remember)
    {
        $config = $this->config->get('jwt');

        $payload = (array) $config->payload;

        if ($remember !== false) {
            $payload['exp'] = $remember;
        }

        $payload['user'] = $params->email;

        return 'Bearer ' . $this->jwt->encode($payload, $config->secret);
    }

    protected function setCookie($jwt, $remember = null)
    {
        $config = $this->config->get('app');

        return $this->cookie->put('user', $jwt, !empty($remember));
    }
}
