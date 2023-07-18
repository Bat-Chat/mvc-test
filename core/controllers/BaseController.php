<?php

namespace app\core\controllers;

use app\core\Application;

class BaseController
{
    public function render(string $view, array $params = [])
    {
        return $this->renderView($view, $params);
    }

    private function renderView($view, array $params)
    {
        $layoutContent = $this->getLayout();
        $viewContent = $this->getView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    private function getLayout()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";

        return ob_get_clean();
    }

    private function getView($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";

        return ob_get_clean();
    }

    public function renderError(array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        include_once Application::$ROOT_DIR."/core/views/_error.php";
    }
}
