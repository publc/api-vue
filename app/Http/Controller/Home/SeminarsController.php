<?php

namespace App\Http\Controller\Home;

use App\Http\Controller;

class SeminarsController extends Controller
{
    public function index($data)
    {
        $this->app->response()->view('home/seminars')->layout('home')->send();
    }
}
