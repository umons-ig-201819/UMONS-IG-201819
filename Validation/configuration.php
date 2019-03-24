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

// Rewrite show404 from CI_Exception class to prevent exit
require_once(__WEB_DIR__.'/system/core/Common.php');
load_class('Exceptions','../../Validation/');


// $_error =& load_class('Exceptions', 'core');
//$reflector = new ReflectionClass('CI_Exceptions');
//$show404 = $reflector->getMethod('show_404');

require_once(__WEB_DIR__.'/system/core/CodeIgniter.php');

use PHPUnit\Framework\TestCase;
