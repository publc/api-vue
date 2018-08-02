<?php

namespace App\Http\Controller;

use stdClass;
use App\Core\Controller;

class ProductsController extends Controller
{
    protected $model;

    public function get($params)
    {
        $page = $params->page;
        $limit = $params->limit;

        $offset = ($page - 1) * $limit;
        
        $products = $this->model->getProducts($limit, $offset);
        $max_page = ceil((int) $this->model->count() / $limit);

        $paginate = new stdClass();
        $paginate->current_page = $page;
        $paginate->prev_page = $page === 1 ? null : $page - 1;
        $paginate->next_page = ($page + 1) >= $max_page ? null : $page + 1;
        $paginate->quantity = $max_page;

        $response = new stdClass();
        $response->products = $products;
        $response->paginate = $paginate;

        return $response;
    }

    public function getBest()
    {
        return $this->model->getBest();
    }
}
