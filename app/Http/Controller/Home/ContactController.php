<?php

namespace App\Http\Controller\Home;

use App\Http\Controller;

class ContactController extends Controller
{
    public function index($data)
    {
        $this->app->response()->view('home/contact')->layout('home')->send();
    }
}
