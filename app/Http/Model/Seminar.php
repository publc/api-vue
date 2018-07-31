<?php

namespace App\Http\Model;

use App\Core\Model;

class Seminar extends Model
{

    public function put($data, $files)
    {
        $params = [];
        $params['params'] = [
            'title' => $data->title,
            'subtitle' => $data->subtitle,
            'place' => $data->place,
            'knowledge' => $data->knowledge,
            'date' => $data->date,
            'image_left' => $files->image_left->name,
            'image_left_title' => $data->image_left_title,
            'image_right' => $files->image_right->name,
            'image_right_title' => $data->image_right_title,
            'limited' => $data->limited
        ];

        $this->setRequestParams($params);
        return $this->create();
    }
}
