<?php

namespace App\Http\Controller\Home;

use App\Http\Controller;

class AboutController extends Controller
{
    public function index($data)
    {
        $this->app->response()->view('home/about')->layout('home')->send();
    }
}
