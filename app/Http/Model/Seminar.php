<?php

namespace App\Http\Model;

use App\Core\Model;

class Seminar extends Model
{
    public function show($params)
    {
        $queryParams = [];
        $queryParams['order'] = [
            'param' => 'date',
            'order' => 'DESC'
        ];
        $queryParams['limit'] = $params->limit;
        $queryParams['offset'] = ($params->page - 1) * $params->limit;

        $this->setRequestParams($queryParams);
        return $this->get();
    }

    public function view()
    {
        $params = [];
        $params['filters'] = [
            'filter' => 'date',
            'op' => '>=',
            'value' => time()
        ];
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
            'title' => $data->title,
            'subtitle' => $data->subtitle,
            'place' => $data->place,
            'knowledge' => $data->knowledge,
            'date' => $data->date,
            'expositor' => $data->expositor,
            'contact' => $data->contact,
            'image_left' => time() . $files->image_left->name,
            'image_left_title' => $data->image_left_title,
            'image_right' => time() . $files->image_right->name,
            'image_right_title' => $data->image_right_title,
            'limited' => $data->limited
        ];

        $this->setRequestParams($params);
        return $this->create();
    }

    public function patch($data, $files)
    {
        $params = [];
        $params['params'] = [
            'title' => $data->title,
            'subtitle' => $data->subtitle,
            'place' => $data->place,
            'knowledge' => $data->knowledge,
            'date' => $data->date,
            'expositor' => $data->expositor,
            'contact' => $data->contact,
            'image_left' => time() . $files->image_left->name,
            'image_left_title' => $data->image_left_title,
            'image_right' => time() . $files->image_right->name,
            'image_right_title' => $data->image_right_title,
            'limited' => $data->limited
        ];

        $params['filters'] = [
            'filter' => 'id',
            'op' => '=',
            'value' => $data->id
        ];

        $this->setRequestParams($params);
        $update = $this->update();
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
