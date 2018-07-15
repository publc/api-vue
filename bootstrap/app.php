<?php

use App\App;
use Bootstrap\Autoloader;

session_start();

require_once 'Autoloader.php';

try {
    Autoloader::register();
    $app = new App();
} catch (Exception $e) {
    throw new Exception("Error Processing Request. \n Error: " . $e);
};



require_once '../routes/web.php';
require_once '../routes/api.php';

$app->run();
