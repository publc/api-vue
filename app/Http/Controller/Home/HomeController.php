<?php

namespace App\Http\Controller\Home;


use App\Core\Controller;
use App\Http\Model\Home;

class HomeController extends Controller
{
    public function index($data)
    {

        $this->app->response()->view('home/home')->layout('home')->send();
    }
}
