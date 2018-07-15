<?php

namespace App\Api;

use App\App;
use App\Core\Container;

class Api extends App
{
    protected $app;
    protected $container;

    public function __construct()
    {
        $this->container = new Container([
            'app' => function () {
                return new App();
            }
        ]);

        $this->app = $this->container->app;
    }
}
