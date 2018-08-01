<?php

namespace App\Http\Controller;


use DateTime;
use App\Core\Controller;

class SeminarsController extends Controller
{
    protected $model = 'seminar';

    public function show($params)
    {
        if ($params->page < 1) {
            $params->page = 1;
        }
        
        $seminars = $this->model->show($params);

        foreach ($seminars as $seminar) {
            $seminar->date = date('d/m/Y', $seminar->date);
        }

        $prevPage = $params->page === 1 ? null : $params->page - 1;
        $nextPage = count($seminars) < 10 ? null : $params->page + 1;
        $paginate = [
            'prev_page' => $prevPage,
            'next_page' => $nextPage,
            'current_page' => $params->page
        ];

        $data = new \stdClass();
        $data->seminars = $seminars;
        $data->paginate = $paginate;

        return $data;
    }

    public function put($params)
    {
        $files = $this->file->process($params);

        if ($files === false) {
            return $this->app->response()->json([
                'error' => 'Image upload process fail'
            ], 400);
        }

        $this->app->validate($params, [
            'title' => 'required|max:45',
            'subtitle' => 'required|max:60',
            'place' => 'required',
            'date' => 'required',
            'knowledge' => 'required',
            'image_left_title' => 'required',
            'image_right_title' => 'required',
            'limited' => 'required'
        ]);
        
        $params->date = strtotime($params->date);

        if ($params->date < time()) {
            return $this->app->response()->json([
                'error' => 'Bad date selected'
            ], 400);
        }

        try {
            return $this->model->put($params, $params->files);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
