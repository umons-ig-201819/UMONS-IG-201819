<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

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
#require_once(__WEB_DIR__.'/system/core/Common.php');
require_once(__VALIDATION_DIR__.'/Common.php');

load_class('Exceptions','../../Validation/');

try{
    include_once(__WEB_DIR__.'/system/core/CodeIgniter.php');
}catch(Exception $e){
}catch(Error $ee){}


include_once(BASEPATH."core/Model.php");
include_once(BASEPATH."core/Controller.php");
include_once(BASEPATH."libraries/Session/Session.php");

echo "Loading ci_controller instance:\n";
echo new CI_Controller();
print_r(CI_Controller::get_instance());
echo "done\n";


use PHPUnit\Framework\TestCase;
