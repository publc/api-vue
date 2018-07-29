<?php

namespace App\Api\Auth;

use App\Core\Api;
use App\Api\Controller\AuthController;

class APIAuth extends Api
{

    protected $authController;

    public function __construct()
    {
        parent::__construct();
        $this->container->offsetSet('authController', function () {
            return new AuthController();
        });

        $this->authController = $this->container->authController;
    }

    public function login($params)
    {
        //
    }

    public function register($params)
    {
        $var = $this->authController->register($params);
    }
}
