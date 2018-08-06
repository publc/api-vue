<?php

namespace App\Http\Controller;


use DateTime;
use App\Core\Controller;

class ProductsController extends Controller
{
    protected $model = 'product';

    public function show($params)
    {
        if ($params->page < 1) {
            $params->page = 1;
        }
        
        $products = $this->model->show($params);
        $total = $this->model->count($params);
        $max_page = ceil($total / $params->limit);

        $prevPage = $params->page === 1 ? null : $params->page - 1;
        $nextPage = ($params->page + 1) > $max_page ? null : $params->page + 1;
        $paginate = [
            'prev_page' => $prevPage,
            'next_page' => $nextPage,
            'max_page' => $max_page,
            'current_page' => $params->page,
            'total' => $total
        ];

        $data = new \stdClass();
        $data->products = $products;
        $data->paginate = $paginate;

        return $data;
    }

    public function view($params)
    {
        $products = $this->model->view($params);
        $total = $this->model->count($params);
        $max_page = ceil($total / $params->limit);
        $prevPage = $params->page === 1 ? null : $params->page - 1;
        $nextPage = ($params->page + 1) > $max_page ? null : $params->page + 1;

        $paginate = [
            'prev_page' => $prevPage,
            'next_page' => $nextPage,
            'max_page' => $max_page,
            'current_page' => $params->page,
            'total' => $total
        ];

        $data = new \stdClass();
        $data->products = $products;
        $data->paginate = $paginate;

        return $data;
    }

    public function put($params)
    {
        $files = $this->file->process($params, 'products');

        if ($files === false) {
            return $this->app->response()->json([
                'error' => 'Image upload process fail'
            ], 400);
        }

        $this->app->validate($params, [
            'category' => 'required|max:45',
        ]);

        try {
            return $this->model->put($params, $params->files);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($params)
    {
        $filter = 'id';
        $value = $params->id;

        try {
            $product = $this->model->find($filter, $value);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

        $files = [];
        if (!empty($product->image)) {
            $files[] = $product->image;
        }

        $unlink = $this->file->unlink($files, 'products');

        if (!$unlink) {
            return $this->app->response()->json([
                'error' => 'Could not unlink files for our system. Please try again'
            ], 500);
        }

        try {
            $this->model->destroy($filter, $value);
            $response = new \stdClass();
            $response->id = $params->id;
            return $response;
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
