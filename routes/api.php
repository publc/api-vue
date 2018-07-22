<?php

$app->get('/api/product/{id}/{test}', 'ProductController@index');
$app->post('/api/email', 'EmailController@send');
