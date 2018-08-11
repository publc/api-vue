<?php

namespace App\Api;

use App\Core\Api;

class APIProducts extends Api
{
    protected $controller = 'products';

    public function show($params)
    {
        $data = $this->controller->show($params);
        return $this->app->response()->json([
            'code' => 1,
            'products' => $data->products,
            'paginate' => $data->paginate
        ]);
    }

    public function put($params)
    {
        $this->controller->put($params);
        return $this->app->response()->json([
            'code' => 1,
            'message' => 'product successfully created'
        ]);
    }

    public function view($params)
    {
        $data = $this->controller->view($params);
        return $this->app->response()->json([
            'code' => 1,
            'products' => $data->products,
            'paginate' => $data->paginate
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
