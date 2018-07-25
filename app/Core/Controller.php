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

        $model = explode('\\', get_class($this));
            
        if (empty($this->model)) {
            $this->model = ucwords(str_replace("Controller", "", $model[count($model) - 1]));
        }

        if ($model[1] === 'Api') {
            $model = "\App\Api\Model\\" . ucwords($this->model);
        } else {
            $model = "\App\Http\Model\\" . ucwords($this->model);
        }

        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    protected function model()
    {
        return $this->model;
    }
}
