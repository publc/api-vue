<?php

namespace App\Http\Controller;


use DateTime;
use App\Core\Controller;

class SeminarsController extends Controller
{
    protected $model = 'seminar';

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
