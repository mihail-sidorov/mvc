<?php

namespace App;

use App;

class Kernel 
{
    
    public $defaultControllerName = 'Home';
    
    public $defaultActionName = "index";
    
    public function launch()
    {
        
        echo $this->launchAction(App::$router->controller, App::$router->action, App::$router->params);
            
    }
    

    public function launchAction($controllerName, $actionName, $params)
    {
        
        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
        if(!file_exists(ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php')){
            $error404 = new \Controllers\Error;
            return $error404->error404();
        }
        require_once ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!class_exists("\\Controllers\\".ucfirst($controllerName))){
            $error404 = new \Controllers\Error;
            return $error404->error404();
        }
        $controllerName = "\\Controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)){
            $error404 = new \Controllers\Error;
            return $error404->error404();
        }
        return $controller->$actionName(App::$request, $params);
        
    }

}