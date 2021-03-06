<?php

namespace App\Core;

class Config
{
    public static function get($path = null, $file = null)
    {
        if (is_null($path)) {
            return;
        }

        $config = require __DIR__ . '/../../config/app.php';

        if (!is_null($file)) {
            $config = require __DIR__ . '/../../config/' . $file . '.php';
        }
        
        $path = explode('.', $path);

        foreach ($path as $bit) {
            if (isset($config[$bit])) {
                $response = $config[$bit];
            }
        }

        return json_decode(json_encode($response));
    }
}
