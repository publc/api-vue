<?php

$app->post('/api/email', 'Mail\APIEmail@send');

$app->get('/api/check', 'APIAuth@check');
$app->post('/api/login', 'APIAuth@login');
$app->post('/api/register', 'APIAuth@register');
$app->post('/api/logout', 'APIAuth@logout');
$app->post('/api/update', 'APIAuth@patch');
$app->post('/api/delete', 'APIAuth@destroy');


$app->get('/api/seminars/view', 'APISeminars@view');
$app->post('/api/seminars/show', 'APISeminars@show');
$app->post('/api/seminars/put', 'APISeminars@put');
$app->post('/api/seminars/patch', 'APISeminars@patch');
$app->post('/api/seminars/destroy', 'APISeminars@destroy');

$app->post('/api/products/view', 'APIProducts@view');
$app->post('/api/products/show', 'APIProducts@show');
$app->post('/api/products/put', 'APIProducts@put');
$app->post('/api/products/destroy', 'APIProducts@destroy');
