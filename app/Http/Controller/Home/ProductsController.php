<?php

namespace App\Http\Controller\Home;

use App\Http\Controller;

class ProductsController extends Controller
{
    public function index($data)
    {
        $this->app->response()->view('home/products')->layout('home')->send();
    }
}
