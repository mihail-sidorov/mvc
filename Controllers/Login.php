<?php

namespace Controllers;

use App;
use Models\User;

class Login extends \App\Controller
{

    public function index ($request)
    {

        if (!User::is_login()) {
            if ($request->method === 'post') {
                if (App::$validator->validate([
                    'login' => 'requare',
                    'password' => 'requare',
                ], $request->params)) {
                    if (User::login($request->params['login'], $request->params['password'])) {
                        header('Location: /admin');
                    }
                    else {
                        App::$validator->errors['login'] = 'Поле "логин" или поле "пароль" не совпадают!';
                        App::$validator->errors['password'] = 'Поле "логин" или поле "пароль" не совпадают!';
                    }
                }
            }
        }
        else {
            header('Location: /admin');
        }

        return $this->render('Login', [
            'request' => $request,
            'errors' => App::$validator->errors,
        ]);

    }

}