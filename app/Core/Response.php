<?php

namespace App\Core;

class Response
{
    protected $statusCode;
    protected $headers = [];
    protected $body;
    protected $view;
    protected $layout;
    protected $data;

    public function json($body = array(), $statusCode = 200)
    {
        $this->addHeader('Content-Type', 'application/json')
            ->addBody($body)
            ->addStatusCode($statusCode);

        $this->setHeaders();
        echo $this->body;
        exit;
    }

    public function view($view, $statusCode = 200)
    {
        $this->addHeader('Content-Type', 'text/html; charset=utf-8')
            ->addStatusCode($statusCode);

        $this->view = $view;

        return $this;
    }

    public function layout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function data($data = array())
    {
        $this->data = $data;
        return $this;
    }

    public function send()
    {
        $data = $this->data;

        if (!$this->layout) {
            require_once '../source/views/' . $this->view . '.view.php';
            exit;
        }

        $view = '../source/views/' . $this->view . '.view.php';
        require_once '../source/layouts/' . $this->layout . '.layout.php';
        exit;
    }

    public function addHeader($name, $value)
    {
        $this->headers[] = [$name, $value];
        return $this;
    }

    public function addStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setHeaders()
    {
        header(sprintf(
            '%s %s %s',
            $_SERVER['SERVER_PROTOCOL'],
            $this->statusCode,
            ''
        ));
        

        foreach ($this->headers as $header) {
            $header = implode(': ', $header);
            header($header);
        }

        return $this;
    }

    public function mailTemplate($template, $data)
    {
        $file = '../source/views/mail/' . $template . '.template.php';
        ob_start();
        require_once $file;
        $content = ob_get_clean();
        ob_end_clean();
        return $content;
    }

    protected function addBody($body)
    {
        $this->body = json_encode($body);
        return $this;
    }
}
