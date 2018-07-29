<?php

namespace App\Core;

use App\Core\Hash;
use App\Core\Config;

class Cookie
{
    protected $container;

    public function __construct()
    {
        $this->container = new Container([
            'config' => function () {
                return new Config();
            },
            'hash' => function () {
                return new Hash();
            }
        ]);
    }

    public function exists($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    public function get($name)
    {
        $cookie = ($this->exists($name)) ? $_COOKIE[$name] : false;

        if ($cookie === false) {
            return false;
        }

        return $this->processBearer($cookie);
    }

    public function put($name = null, $value = null, $expiry = null)
    {
        $config = $this->container->config->get('remember');
        $jwtExp = $this->container->config->get('jwt');
        $hash = $this->container->hash;

        $name = (is_null($name)) ? $config->name : $name;
        $value = (is_null($value)) ? $hash->unique() : $value;
        $expiry = (is_null($expiry)) ? $jwtExp->payload->exp : $expiry;

        return (setcookie($name, $value, $expiry, "/")) ? true : false;
    }

    public function destroy($name)
    {
        return $this->put($name, "", - 60);
    }

    protected function processBearer($cookie)
    {
        if (strpos($cookie, 'Bearer ') === false) {
            return $cookie;
        }

        return str_replace('Bearer ', '', $cookie);
    }
}
