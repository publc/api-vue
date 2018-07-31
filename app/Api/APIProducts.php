<?php

namespace App\Api;

use App\Core\Api;

class APIProducts extends Api
{
    protected $controller;

    public function get()
    {
        $products = $this->controller->get();
        $this->app->response()->json([
            'code' => 1,
            'products' => $products
        ]);
    }

    public function getBest()
    {
        $products = $this->controller->getBest();
        $this->app->response()->json([
            'code' => 1,
            'products' => $products
        ]);
    }
}
