<?php

namespace App\Core\Contracts;

interface APIInterface
{
    public function get($params);
    public function post($params);
    public function put($params);
    public function patch($params);
    public function delete($params);
}
