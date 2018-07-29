<?php

namespace App\Api\Model;

use App\Core\Model;

class User extends Model
{
    public function find($filter, $value)
    {
        $params["filters"] = [
            'filter' => $filter,
            'op' => '=',
            'value' => $value
        ];

        $this->setRequestParams($params);
        return $this->findOne();
    }
}
