<?php

namespace App\Api\Controller;

use App\Api\Api;

class ProductController extends Api
{
    public function index($data)
    {
        return $this->app->response()->json(['Greeting' => 'Say Hello From API']);
    }
}
