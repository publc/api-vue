<?php

namespace App;

use App\Core\Request;
use App\Core\Response;
use App\Core\Container;
use App\Core\Routing\Router;

class App
{
    protected $container;


    public function __construct()
    {
        $this->container = new Container([
            'router' => function () {
                return new Router();
            },
            'request' => function () {
                return new Request();
            },
            'response' => function () {
                return new Response();
            }
        ]);
    }

    public function import($files = array())
    {
        foreach ($files as $file) {
            $file = '../routes/' . $file . '.php';
            if (file_exists($file)) {
                $app = $this;
                require_once $file;
            } else {
                throw new \Exception("Error Processing Request. Routes File Not Found", 1);
            }
        }
        return;
    }

    public function get($uri, $handler, $method = 'GET')
    {
        $this->container->router->addRoute($uri, $handler, $method);
        return $this;
    }

    public function post($uri, $handler, $method = 'POST')
    {
        $this->container->router->addRoute($uri, $handler, $method);
        return $this;
    }

    public function group($name)
    {
        //
    }

    public function run()
    {
        $request = $this->container->request;
        $uri = $request->getUri();

        $this->processFile($uri);

        $this->container->router->setPath($_SERVER['REQUEST_URI'] ?? '/');
        $path = $this->container->router->getPath();

        $route = $this->container->router->getRoute();

        $processor = explode('/', $uri);
        
        if ($processor[1] === 'api') {
            return $this->processApi($path, $route);
        }
        
        return $this->processWeb($path, $route);
    }

    protected function processFile($uri)
    {
        $exts = [
            'application/javascript' => '.js',
            'text/css' => '.css',
            'text/ico' => '.ico',
            'image/png' => '.png',
            'image/jpg' => '.jpg',
            'image/jpeg' => '.jpeg',
            'image/svg' => '.svg',
            'application/pdf' => '.pdf'];

        foreach ($exts as $type => $ext) {
            if (strpos($uri, $ext) !== false) {
                $this->container->response->addHeader('Content-Type', $type);
                $this->container->response->addStatusCode(200);
                $this->container->response->setHeaders();
                require_once $uri;
                exit;
            }
        }

        return;
    }

    protected function processWeb($path, $route)
    {
        $requestMethod = $this->container->request->getMethod();
        if ($route === false || $requestMethod !== $route['method']) {
            $this->response()->view('errors/404', 404)->send();
        }

        if (is_callable($route['handler']['controller'])) {
            return $route['handler']['controller']($this);
        }

        $params = $this->container->request->getWebParams($path, $route);
        $handler = '\App\Http\Controller\\' . $route['handler']['controller'];
        $handler = new $handler();
        $callable = $route['handler']['proccesor'];

        return call_user_func_array([$handler, $callable], [$params]);
    }

    protected function processApi($path, $route)
    {
        
        if ($route === false) {
            echo $this->response()->json(['error' => 'Not Found'], 404);
            exit;
        }
        
        $params = $this->container->request->getApiParams($path, $route);
        $handler = '\App\Api\\' . $route['handler']['controller'];
        
        $handler = new $handler();
        $callable = $route['handler']['proccesor'];
        
        return call_user_func_array([$handler, $callable], [$params]);
    }

    public function response()
    {
        return $this->container->response;
    }

    public function view()
    {
        $this->container->response->send();
    }
}
