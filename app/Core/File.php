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

    public function process($params)
    {
        $validate = $this->validate->validateFile($params);
        
        if (is_null($validate) || $validate === false) {
            return false;
        }
       
        $root = $this->request->getRoot();
        
        $files = $params->files;

        $uploads = [];

        foreach ($files as $file) {
            $path = $root . '/img/' . $file->name;
            $uploads[] = move_uploaded_file($file->tmp_name, $path);
        }

        foreach ($uploads as $upload) {
            if ($upload === false) {
                return false;
            }
        }
    }
}
