<?php

$app->post('/api/email', 'Mail\APIEmail@send');

$app->post('/api/login', 'Auth\APIAuth@login');
$app->post('/api/register', 'Auth\APIAuth@register');
