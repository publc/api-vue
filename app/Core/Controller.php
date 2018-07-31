<?php

namespace App\Core;

use App\App;
use App\Core\Auth\Auth;
use App\Core\Container;
use App\Core\Contracts\ControllerInterface;

class Controller implements ControllerInterface
{
    protected $app;
    protected $container;
    protected $file;
    protected $model;

    public function __construct()
    {
        $this->container = new Container([
            'app' => function () {
                return new App();
            },
            'auth' => function () {
                return new Auth();
            },
            'file' => function () {
                return new File();
            }
        ]);

        $this->app = $this->container->app;
        $this->auth = $this->container->auth;
        $this->file = $this->container->file;

        $this->setModel();
    }

    protected function model()
    {
        return $this->model;
    }

    protected function setModel()
    {
        if (is_null($this->model)) {
            $model = (new \ReflectionClass($this))->getShortName();
            $model = str_replace('Controller', '', $model);
            $model = 'App\Http\Model\\' . $model;
        } else {
            $path = explode('->', $this->model);

            foreach ($path as &$param) {
                $param = ucwords(strtolower($param));
            }

            $path = implode('\\', $path);
            $model = 'App\Http\Model\\' . $path;
        }
        
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }
}
