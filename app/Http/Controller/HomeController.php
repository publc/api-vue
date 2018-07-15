<?php

namespace App\Http\Controller;

use App\Http\Controller;

class HomeController extends Controller
{
    public function index($data)
    {
        $this->app->response()->view('home')->layout('home')->send();
    }
}
