<?php

namespace App\Core;

use App\App;
use App\Core\Config;
use App\Core\Container;
use App\Core\PHPMailer;
use App\Core\Contracts\APIInterface;

class Api implements APIInterface
{
    protected $app;
    protected $mailer;
    protected $config;
    protected $container;

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
            }
        ]);

        $this->app = $this->container->app;
        $this->mailer = $this->container->mailer;
        $this->config = $this->container->config;
    }

    public function get($params)
    {
        //
    }

    public function post($params)
    {
        //
    }

    public function put($params)
    {
        //
    }

    public function patch($params)
    {
        //
    }

    public function delete($params)
    {
        //
    }
}
