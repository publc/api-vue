<?php

namespace App\Api;

use App\App;
use App\Core\Config;
use App\Core\Container;
use App\Core\PHPMailer;

class Api extends App
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
}
