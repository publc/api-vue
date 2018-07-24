<?php

$app->get('/', 'Home\HomeController@index');

$app->get('/admin', 'Admin\AdminController@index');

$app->get('/login', function ($app) {
    $app->response()->view('admin/home')->layout('home')->send();
});
