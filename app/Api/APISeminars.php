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

    public function view($params)
    {
        $seminars = $this->controller->view();
        return $this->app->response()->json([
            'code' => 1,
            'seminars' => $seminars
        ]);
    }

    public function patch($params)
    {
        $this->controller->patch($params);
        return $this->app->response()->json([
            'code' => 1,
            'message' => 'seminar successfully updated'
        ]);
    }

    public function destroy($params)
    {
        $response = $this->controller->destroy($params);
        return $this->app->response()->json([
            'code' => 1,
            'id' => $response->id
        ]);
    }
}
