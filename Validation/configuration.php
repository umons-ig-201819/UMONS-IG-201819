<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define("__ROOT_DIR__",dirname(__DIR__));
define("__VALIDATION_DIR__",__ROOT_DIR__.'/Validation');
define("__WEB_DIR__",__ROOT_DIR__.'/WebPortal');

define('ENVIRONMENT', 'development');
define("BASEPATH",__WEB_DIR__.'/system/');
define("APPPATH",__WEB_DIR__.'/application/');
define("VIEWPATH",APPPATH.'/views/');

function load_model($name){
    require_once(__WEB_DIR__."/application/models/$name.php");
}

function load_controller($name){
    require_once(__WEB_DIR__."/application/controllers/$name.php");
}

require_once(__WEB_DIR__.'/system/core/Exceptions.php');

try {
    //require_once(__WEB_DIR__.'/system/core/Model.php');
    //require_once(__WEB_DIR__.'/system/core/Controller.php');
    require_once(__WEB_DIR__.'/system/core/CodeIgniter.php');
} catch (Exception $e) {
}

use PHPUnit\Framework\TestCase;
