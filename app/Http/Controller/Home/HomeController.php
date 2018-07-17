<?php

namespace App\Http\Controller\Home;

use App\Http\Controller;

class HomeController extends Controller
{
    public function index($data)
    {
        $this->app->response()->view('home/home')->layout('home')->send();
    }
}
