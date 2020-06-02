<?php

namespace App;

class Request

{

    public $method;

    public $params;

    function __construct()

    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->method = 'post';

            $this->params = [];
            foreach ($_POST as $index => $value) {

                $this->params[$index] = $value;
            }
        }

    }

}