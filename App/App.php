<?php

class App

{
        
    public static $router;

    public static $request;
    
    public static $db;
    
    public static $kernel;

    public static $validator;
    
    public static function init()
    {
        spl_autoload_register(['static','loadClass']);
        static::bootstrap();
        
    }
    
    public static function bootstrap()
    {
        static::$router = new App\Router();
        static::$kernel = new App\Kernel();
        static::$db = new App\Db();
        static::$request = new App\Request();
        static::$validator = new App\Validator();
       
    }
    
    public static function loadClass ($className)
    {
        
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH.DIRECTORY_SEPARATOR.$className.'.php';
        
    }

    public static function message($message)
    {

        ob_start();
        require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'message.php';
        return ob_get_clean();

    }
    
}