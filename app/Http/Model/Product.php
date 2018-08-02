<?php

namespace App\Http\Model;

use App\Core\Model;

class Product extends Model
{
    protected $table = 'products';

    public function getProducts($limit, $offset)
    {
        $params = [];

        $params["fields"] = 't.id, t.name, t.description, t.image, t.sku';
        $params["order"] = [
            'param' => 'id',
            'order' => 'ASC'
        ];

        $params['limit'] = $limit;
        $params['offset'] = $offset;

        $this->setRequestParams($params);
        return $this->get();
    }

    public function count()
    {
        return parent::count();
    }

    public function getBest()
    {
        $params = [];
        $params['filters'] = [
            'filter' => 'important',
            'op' => '=',
            'value' => 1
        ];
        $this->setRequestParams($params);
        return parent::get();
    }
}
