<?php

namespace App\Api;

use App\Core\Api;

class APIProducts extends Api
{
    protected $controller;

    public function get($params)
    {
        $response = $this->controller->get($params);
        $this->app->response()->json([
            'code' => 1,
            'products' => $response->products,
            'paginate' => $response->paginate
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
