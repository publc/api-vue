<?php

namespace App\Api\Auth;

use App\Core\Api;

class APIAuth extends Api
{
    public function login()
    {
        return $this->app->response()->json(['hello' => 'Say hello from login']);
    }

    public function register($params)
    {
        return $this->app->response()->json(['hello' => 'Say hello from register']);
    }
}
