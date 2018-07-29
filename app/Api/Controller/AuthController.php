<?php

namespace App\Api\Controller;

use App\Core\Controller;

class AuthController extends Controller
{
    protected $model = "user";

    public function login()
    {
        //
    }

    public function register($params)
    {
        $validate = $this->app->validate()->check((array) $params, [
            'email' => [
                'required' => true,
                'unique' => $this->model,
                'email' => true,
                'max' => 45
            ],
            'pass' => [
                'require' => true,
                'min' => 6,
                'max' => 45
            ],
            'name' => [
                'required' => true,
                'min' => 2,
                'max' => 45
            ],
            'phone' => [
                'min' => 6,
                'max' => 11
            ]
        ]);

        $errors = $validate->errors();

        if (!empty($errors)) {
            return $errors;
        }

        return true;
    }
}
