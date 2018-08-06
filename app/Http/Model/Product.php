<?php

namespace App\Http\Model;

use App\Core\Model;

class Product extends Model
{
    public function show($params)
    {
        $queryParams = [];

        $queryParams['limit'] = $params->limit;
        $queryParams['offset'] = ($params->page - 1) * $params->limit;
        $queryParams['filters'] = [
            'filter' => 'category',
            'op' => '=',
            'value' => $params->category
        ];

        $this->setRequestParams($queryParams);
        return $this->get();
    }

    public function view($params)
    {
        $queryParams = [];
        $queryParams['filters'] = [
            'filter' => 'category',
            'op' => '=',
            'value' => $params->category
        ];
        $queryParams['limit'] = $params->limit;
        $queryParams['offset'] = ($params->page - 1) * $params->limit;
        
        $this->setRequestParams($queryParams);
        return $this->get();
    }

    public function find($filter, $value)
    {
        $params = [];
        $params['filters'] = [
            'filter' => $filter,
            'op' => '=',
            'value' => $value
        ];
        $this->setRequestParams($params);
        return $this->findOne();
    }

    public function count()
    {
        return parent::count();
    }

    public function put($data, $files)
    {
        $params = [];
        $params['params'] = [
            'category' => $data->category,
            'image' => time() . $files->image->name,
        ];

        $this->setRequestParams($params);
        return $this->create();
    }

    public function destroy($filter, $value)
    {
        $params = [];
        $params['filters'] = [
            'filter' => $filter,
            'op' => '=',
            'value' => $value
        ];
        $this->setRequestParams($params);
        return $this->delete();
    }
}
