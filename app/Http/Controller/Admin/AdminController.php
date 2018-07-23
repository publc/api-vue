<?php

namespace App\Http\Controller\Admin;

use App\Http\Controller;

class AdminController extends Controller
{
    public function index($data)
    {
        $this->app->response()->view('admin/home')->layout('home')->send();
    }
}
