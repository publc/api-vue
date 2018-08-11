<?php

namespace App\Http\Model\Auth;

use App\Core\Model;

class User extends Model
{
    protected $user;

    public function count()
    {
        return parent::count();
    }

    public function find($item, $value)
    {
        if (!is_null($this->user) || !empty($this->user)) {
            return $this->user;
        }

        $params = [
            'filters' => [
                'filter' => $item,
                'op' => '=',
                'value' => $value
            ]];

        $this->setRequestParams($params);
        $user = $this->findOne();

        $this->user = $user ? $user : null;

        return $this->user;
    }

    public function show($params)
    {
        $queryParams = [];
        $queryParams['fields'] = 't.id, t.email, t.name, t.phone';
        $queryParams['limit'] = $params->limit;
        $queryParams['offset'] = ($params->page - 1) * $params->limit;

        $this->setRequestParams($queryParams);
        return $this->get();
    }

    public function put($params)
    {
        $queryParams['params'] = (array) $params;
        
        $this->setRequestParams($queryParams);
        
        try {
            return $this->create();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function patch($params, $filter, $value)
    {
        $queryParams['params'] = (array) $params;
        $queryParams['filters'] = [
            'filter' => $filter,
            'op' => '=',
            'value' => $value
        ];
        
        $this->setRequestParams($queryParams);
        
        try {
            return $this->update();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function destroy($filter, $value)
    {
        $params['filters'] = [
            'filter' => $filter,
            'op' => '=',
            'value' => $value
        ];
        
        $this->setRequestParams($params);
        
        try {
            return $this->delete();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}
