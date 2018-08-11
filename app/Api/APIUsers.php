<?php

namespace App\Api;

use App\Core\Api;

class APIUsers extends Api
{
    public function show($params)
    {
        $data = $this->controller->show($params);
        return $this->app->response()->json([
            'code' => 1,
            'users' => $data->users,
            'paginate' => $data->paginate
        ]);
    }
}
