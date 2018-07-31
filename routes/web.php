<?php

$app->get('/', 'Home\HomeController@index');

$app->get('/admin', 'Admin\AdminController@index');

$app->get('/login', function ($app) {
    $app->response()->view('admin/home')->layout('home')->send();
});

$app->get('/admin/register', function ($app) {
    $app->response()->view('admin/home')->layout('home')->send();
});
$app->get('/admin/seminars', function ($app) {
    $app->response()->view('admin/home')->layout('home')->send();
});
$app->get('/admin/seminars/create', function ($app) {
    $app->response()->view('admin/home')->layout('home')->send();
});
$app->get('/admin/products', function ($app) {
    $app->response()->view('admin/home')->layout('home')->send();
});
$app->get('/admin/users', function ($app) {
    $app->response()->view('admin/home')->layout('home')->send();
});
