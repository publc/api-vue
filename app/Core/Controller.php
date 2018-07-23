<?php

namespace App\Core;

use App\App;
use App\Core\Container;
use App\Core\Contracts\ControllerInterface;

class Controller implements ControllerInterface
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

    public function index($data)
    {
        return $this->app->response()->view('home/home')->layout('home')->send();
    }
}
