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
        $total = $this->model->count($params);
        $max_page = ceil($total / $params->limit);

        foreach ($seminars as $seminar) {
            $seminar->date = date('d/m/Y', $seminar->date);
        }

        $prevPage = $params->page === 1 ? null : $params->page - 1;
        $nextPage = ($params->page + 1) > $max_page ? null : $params->page + 1;
        $paginate = [
            'prev_page' => $prevPage,
            'next_page' => $nextPage,
            'max_page' => $max_page,
            'current_page' => $params->page,
            'total' => $total
        ];

        $data = new \stdClass();
        $data->seminars = $seminars;
        $data->paginate = $paginate;

        return $data;
    }

    public function view()
    {
        try {
            return $this->model->view();
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function put($params)
    {
        $files = $this->file->process($params, 'seminars');

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
            'expositor' => 'required',
            'contact' => 'required',
            'image_left_title' => 'required',
            'image_right_title' => 'required'
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

    public function patch($params)
    {
        $filter = 'id';
        $value = $params->id;

        try {
            $seminar = $this->model->find($filter, $value);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

        $this->app->validate($params, [
            'title' => 'required|max:45',
            'subtitle' => 'required|max:60',
            'place' => 'required',
            'date' => 'required',
            'knowledge' => 'required',
            'expositor' => 'required',
            'contact' => 'required',
            'image_left_title' => 'required',
            'image_right_title' => 'required'
        ]);
        
        $params->date = strtotime($params->date);

        if ($params->date < time()) {
            return $this->app->response()->json([
                'error' => 'Bad date selected'
            ], 400);
        }
        
        try {
            $this->model->patch($params, $params->files);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

        $files = $this->file->process($params, 'seminars');

        if ($files === false) {
            return $this->app->response()->json([
                'error' => 'Image upload process fail'
            ], 400);
        }

        $unlinkFiles = [];
        if (!empty($seminar->image_left)) {
            $unlinkFiles[] = $seminar->image_left;
        }

        if (!empty($seminar->image_right)) {
            $unlinkFiles[] = $seminar->image_right;
        }

        $unlink = $this->file->unlink($unlinkFiles, 'seminars');

        if (!$unlink) {
            return $this->app->response()->json([
                'error' => 'Could not unlink files for our system. Please try again'
            ], 500);
        }
    }

    public function destroy($params)
    {
        $filter = 'id';
        $value = $params->id;

        try {
            $seminar = $this->model->find($filter, $value);
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

        $files = [];
        if (!empty($seminar->image_left)) {
            $files[] = $seminar->image_left;
        }

        if (!empty($seminar->image_right)) {
            $files[] = $seminar->image_right;
        }

        $unlink = $this->file->unlink($files, 'seminars');

        if (!$unlink) {
            return $this->app->response()->json([
                'error' => 'Could not unlink files for our system. Please try again'
            ], 500);
        }

        try {
            $this->model->destroy($filter, $value);
            $response = new \stdClass();
            $response->id = $params->id;
            return $response;
        } catch (\PDOException $e) {
            return $this->app->response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
