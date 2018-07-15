<?php

namespace App\Http;

use App\App;
use App\Core\Container;

class Controller
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
