<?php

namespace app\core\controllers;

use app\core\http\Request;
use app\core\http\Response;

class ErrorController extends BaseController
{
    const NOT_FOUND_MESSAGE = 'Page not found.';

    public function notFound(Request $request, Response $response)
    {
        $response->setStatusCode(404);

        return $this->renderError([
            'message' => self::NOT_FOUND_MESSAGE
        ]);
    }
}