<?php

namespace App\Http\Controller;

use App\Core\Controller;

class UsersController extends Controller
{
    protected $model = 'auth->user';

    public function show($params)
    {
        if ($params->page < 1) {
            $params->page = 1;
        }
        
        try {
            $users = $this->model->show($params);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

        $users = $this->model->show($params);
        $total = $this->model->count($params);
        $max_page = ceil($total / $params->limit);

        $prevPage = $params->page === 1 ? null : $params->page - 1;
        $nextPage = ($params->page + 1) > $max_page ? null : $params->page + 1;
        $paginate = [
            'prev_page' => $prevPage,
            'next_page' => $nextPage,
            'max_page' => $max_page,
            'current_page' => $params->page
        ];

        $data = new \stdClass();
        $data->users = $users;
        $data->paginate = $paginate;

        return $data;
    }
}
