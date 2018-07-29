<?php

namespace App\Api;

use App\Core\Api;
use App\Core\Auth\Auth;
use App\Http\Model\Auth\User;

class APIAuth extends Api
{
    protected $controller = 'auth->auth';

    public function get($params)
    {
        $this->validate($params);
    }

    public function login($params)
    {
        $this->controller->login($params);
        $this->response([
            'code' => 1,
            'message' => 'user logged in'
        ]);
    }

    public function register($params)
    {
        $this->controller->register($params);
        $this->response([
            'code' => 1,
            'message' => 'user created and logged in'
        ]);
    }

    public function logout($params)
    {
        $this->controller->logout();
        $this->response([
            'code' => 1,
            'message' => 'user logout'
        ]);
    }

    public function patch($params)
    {
        $this->controller->patch($params);
        $this->response([
            'code' => 1,
            'message' => 'user modify'
        ]);
    }

    public function destroy($params)
    {
        $this->controller->destroy($params);
        $this->response([
            'code' => 1,
            'message' => 'user destroy'
        ]);
    }
}
