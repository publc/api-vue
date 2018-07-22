<?php

$app->get('/', 'Home\HomeController@index');

$app->get('/admin', 'Admin\AdminController@index');
