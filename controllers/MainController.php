<?php

namespace app\controllers;

use app\core\Application;
use app\core\controllers\BaseController;
use app\core\http\Request;
use app\core\http\Response;
use app\models\LoginModel;
use app\models\UserModel;

class MainController extends BaseController
{
    public function home()
    {
        return $this->render('home');
    }

    public function register(Request $request)
    {
        $userModel = new UserModel();
        if ($request->getMethod() === 'post') {
            $userModel->loadData($request->getBody());
            if ($userModel->validate()) {
                if ($this->isUserExist($userModel->email)) {
                    $userModel->addError('email', 'User with this email already exists');
                } elseif ($userModel->save()) {
                    Application::$app->response->redirect('/');
                }
            }
        }

        return $this->render('register', [
            'model' => $userModel
        ]);
    }

    public function login(Request $request)
    {
        $loginForm = new LoginModel();
        if ($request->getMethod() === 'post') {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
            }
        }

        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    private function isUserExist($email): bool
    {
        $user = UserModel::findOne(['email' => $email]);

        return !empty($user);
    }
}
