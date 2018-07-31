<?php

namespace App\Http\Model;

use App\Core\Model;

class Product extends Model
{
    protected $table = 'products';

    public function get()
    {
        $params = [];
        $params["fields"] = 't.id, t.name, t.description, t.image, t.sku';
        $this->setRequestParams($params);
        return parent::get();
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
