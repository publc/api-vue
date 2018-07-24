<?php

namespace App\Core;

use App\App;
use App\Core\Container;
use App\Core\Contracts\ControllerInterface;

class Controller implements ControllerInterface
{
    protected $app;
    protected $container;
    protected $model;

    public function __construct()
    {
        $this->container = new Container([
            'app' => function () {
                return new App();
            }
        ]);

        $this->app = $this->container->app;

        if (empty($this->model)) {
            $model = explode("\\", get_class($this));
            $this->model = ucwords(str_replace("Controller", "", $model[count($model) - 1]));
        }

        $model = "\App\Http\Model\\" . ucwords($this->model);
        if (class_exists($model)) {
            $this->modelClass = new $model();
        }
    }
}
