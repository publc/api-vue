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
                return require_once $file;
            }
            throw new \Exception("Error Processing Request. Routes File Not Found", 1);
        }
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
            $this->processApi($path, $route);
        }

        $this->processWeb($path, $route);
    }

    protected function processFile($uri)
    {
        $exts = ['.js', '.css', '.ico', '.png', '.jpeg', '.svg', '.pdf'];

        foreach ($exts as $ext) {
            if (strpos($uri, $ext) !== false) {
                require_once '../source/assets' . $uri;
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
        $handler = '\App\Api\Controller\\' . $route['handler']['controller'];
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
