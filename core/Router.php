<?php

namespace app\core;

use app\core\controllers\ErrorController;
use app\core\http\Request;
use app\core\http\Response;

class Router
{
    public Request $request;
    private Response $response;
    protected array $routes = [];

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(
        Request $request,
        Response $response
    ) {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? null;
        if (!is_array($callback)) {
            return $this->handleNotFound();
        }

        $controller = new $callback[0];

        if (!is_object($controller)) {
            return $this->handleNotFound();
        }

        $callback[0] = $controller;

        return call_user_func($callback, $this->request, $this->response);
    }

    private function handleNotFound() {
        $errorController = new ErrorController();

        return $errorController->notFound($this->request, $this->response);
    }
}