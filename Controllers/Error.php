<?php

namespace Controllers;

class Error extends \App\Controller
{
    
    public function error404 ()
    {
        
        define('NO_LAYOUT', true);
        return $this->render('404');
        
    }
    
}