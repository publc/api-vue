<?php

$app->post('/api/email', 'Mail\APIEmail@send');

$app->get('/api/check', 'APIAuth@check');
$app->post('/api/login', 'APIAuth@login');
$app->post('/api/register', 'APIAuth@register');
$app->post('/api/logout', 'APIAuth@logout');
$app->post('/api/update', 'APIAuth@patch');
$app->post('/api/delete', 'APIAuth@destroy');


$app->post('/api/seminars/put', 'APISeminars@put');
