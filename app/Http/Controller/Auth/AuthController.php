<?php

namespace App\Http\Controller\Auth;


use App\Core\Controller;

class AuthController extends Controller
{
    protected $model = 'auth->user';

    public function check()
    {
        $email = $this->auth->logged();

        if (!$email) {
            return $this->app->response()->json([
                'error' => 'not logged user'
            ], 400);
        }
    }

    public function login($params)
    {
        $this->app->validate($params, [
            'email' => 'required|email|max:45',
            'password' => 'required|min:6|max:45'
        ]);

        $user = $this->model->find('email', $params->email);
        
        if (empty($user) || !password_verify($params->password, $user->password)) {
            return $this->app->response()->json([
                'error' => 'bad user credentials provided'
            ], 400);
        }

        return $this->auth->login($params);
    }

    public function register($params)
    {
        $this->app->validate($params, [
            'email' => 'required|email|unique:auth->user|max:45',
            'name' => 'required|max:45',
            'password' => 'required|min:6|max:45',
            'confirm_password' => 'required|matches:password'
        ]);
        
        $params->password = $this->auth->hash($params->password);
        unset($params->confirm_password);
        unset($params->files);

        try {
            return $this->model->put($params);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function logout()
    {
        $logout = $this->auth->logout();

        if ($logout !== true) {
            return $this->app->response()->json([
                'error' => 'We have problems to logout the user'
            ], 400);
        }
    }

    public function patch($params)
    {
        $this->app->validate($params, [
            'name' => 'max:45',
            'password' => 'required|min:6|max:45',
            'confirm_password' => 'required|matches:password'
        ]);
        
        $email = $this->auth->logged();

        if (!$email) {
            return $this->app->response()->json([
                'error' => 'not logged user'
            ], 400);
        }

        unset($params->confirm_password);
        $params->password = $this->auth->hash($params->password);

        return $this->model->patch($params, 'email', $email);
    }

    public function destroy($params)
    {
        $this->app->validate($params, [
            'email' => 'required|email|max:45'
        ]);

        $email = $this->auth->logged();

        if (!$email) {
            return $this->app->response()->json([
                'error' => 'not logged user'
            ], 400);
        }

        $user = $this->model->find('email', $email);

        if (empty($user)) {
            return $this->app->response()->json([
                'error' => 'bad user credentials provided'
            ], 400);
        }

        if ($email === $params->email) {
            $this->auth->logout();
        }
        
        return $this->model->destroy('email', $email);
    }
}
