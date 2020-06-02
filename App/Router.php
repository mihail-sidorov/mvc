<?php
namespace App;

class Router

{

    public $controller;

    public $action;

    public $params;
    
    function __construct()
    {
        
        $params = [];
        if(($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false){
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
            foreach(explode('&', substr($_SERVER['REQUEST_URI'], $pos + 1)) as $value) {
                $arr = explode('=', $value);
                $params[$arr[0]] = $arr[1];
            }
        }
        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = explode('/', $route);
        array_shift($route);

        $this->controller = array_shift($route);
        $this->action = array_shift($route);
        $this->params = $params;
        
    }

    public function get_link_without_param($name_params)
    {

        $first = true;
        if(($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false){
            $link = substr($_SERVER['REQUEST_URI'], 0, $pos);
            foreach ($this->params as $index => $param) {
                if (!in_array($index, $name_params)) {
                    if ($first) {
                        $link .= "?$index=$param";
                        $first = false;
                    }
                    else {
                        $link .= "&$index=$param";
                    }
                }
            }
        }
        else {
            $link = $_SERVER['REQUEST_URI'];
        }
        if (!$first) {
            $link .= '&';
        }
        else {
            $link .= '?';
        }

        return $link;

    }
    
}