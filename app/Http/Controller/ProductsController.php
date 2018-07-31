<?php

namespace App\Http\Controller;

use App\Core\Controller;

class ProductsController extends Controller
{
    protected $model;

    public function get()
    {
        return $this->model->get();
    }

    public function getBest()
    {
        return $this->model->getBest();
    }
}
