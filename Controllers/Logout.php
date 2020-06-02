<?php

namespace Controllers;

class Logout extends \App\Controller
{

    public function index()
    {

        session_destroy();
        header('Location: /login');

    }

}