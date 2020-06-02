<?php

session_start();

define('ROOTPATH', __DIR__);

require __DIR__.'/App/App.php';

App::init();
App::$kernel->launch();