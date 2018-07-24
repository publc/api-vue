<?php

namespace App\Core\Contracts;

interface AuthInterface
{
    public function login();
    public function register();
    public function updatePassword();
    public function remember();
    public function rememberPassword();
}
