<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Validate;

class File
{

    protected $validate;
    protected $request;
    protected $container;
    
    public function __construct()
    {
        $this->container = new Container([
            'validate' => function () {
                return new Validate();
            },
            'request' => function () {
                return new Request();
            },
        ]);

        $this->validate = $this->container->validate;
        $this->request = $this->container->request;
    }

    public function process($params, $folder = '')
    {
        $validate = $this->validate->validateFile($params);
        
        if (is_null($validate) || $validate === false) {
            return false;
        }
       
        $root = $this->request->getRoot();
        
        $files = $params->files;
        $folder = !is_null($folder) ? $folder . '/' : '';
        $uploads = [];
        foreach ($files as $file) {
            $path = $root . '/img/' . $folder . time() . $file->name;
            $uploads[] = move_uploaded_file($file->tmp_name, $path);
        }

        foreach ($uploads as $upload) {
            if ($upload === false) {
                return false;
            }
        }
    }

    public function unlink($params, $folder = null)
    {
        if (is_null($params)) {
            return false;
        }

        $folder = !is_null($folder) ? $folder . '/' : '';
        $root = $this->request->getRoot();
        $unlinks = [];
        foreach ($params as $fileName) {
            $path = $root . '/img/' . $folder . $fileName;
            $uploads[] = unlink($path);
        }

        foreach ($uploads as $upload) {
            if ($upload === false) {
                return false;
            }
        }

        return true;
    }
}
