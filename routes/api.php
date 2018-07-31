<?php

$app->post('/api/email', 'Mail\APIEmail@send');

$app->post('/api/login', 'Auth\APIAuth@login');
$app->post('/api/register', 'Auth\APIAuth@register');
$app->post('/api/logout', 'Auth\APIAuth@logout');
$app->post('/api/update', 'Auth\APIAuth@patch');
$app->post('/api/delete', 'Auth\APIAuth@destroy');

$app->get('/api/products', 'APIProducts@get');
$app->get('/api/best_products', 'APIProducts@getBest');
