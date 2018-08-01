<?php

namespace App\Api;

use App\Core\Api;

class APISeminars extends Api
{
    protected $controller = 'seminars';

    public function show($params)
    {
        $data = $this->controller->show($params);
        return $this->app->response()->json([
            'code' => 1,
            'seminars' => $data->seminars,
            'paginate' => $data->paginate
        ]);
    }

    public function put($params)
    {
        $this->controller->put($params);
        return $this->app->response()->json([
            'code' => 1,
            'message' => 'seminar successfully created'
        ]);
    }
}
