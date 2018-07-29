<?php

$app->post('/api/email', 'Mail\APIEmail@send');

<<<<<<< HEAD
$app->post('/api/login', 'Auth\APIAuth@login');
$app->post('/api/register', 'Auth\APIAuth@register');
=======
$app->post('/api/login', 'APIAuth@login');
$app->post('/api/register', 'APIAuth@register');
$app->post('/api/logout', 'APIAuth@logout');
$app->post('/api/update', 'APIAuth@patch');
$app->post('/api/delete', 'APIAuth@destroy');
>>>>>>> update-master
