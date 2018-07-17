<?php

$app->get('/', 'Home\HomeController@index');
$app->get('/seminarios', 'Home\SeminarsController@index');
$app->get('/productos', 'Home\ProductsController@index');
$app->get('/nosotros', 'Home\AboutController@index');
$app->get('/contacto', 'Home\ContactController@index');

$app->get('/admin', 'Admin\AdminController@index');
