<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

define("__ROOT_DIR__",dirname(__DIR__));
define("__VALIDATION_DIR__",__ROOT_DIR__.'/Validation');
define("__WEB_DIR__",__ROOT_DIR__.'/WebPortal');

define('ENVIRONMENT', 'development');
define("BASEPATH",__WEB_DIR__.'/system/');
define("APPPATH",__WEB_DIR__.'/application/');
define("VIEWPATH",APPPATH.'/views/');

define('ICONV_ENABLED',false);
define('MB_ENABLED',false);

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
load_class('Utf8', 'core');
$router =& load_class('Router', 'core');
$router->class='FakeController';
$router->method='index';

try{
    include_once(__WEB_DIR__.'/system/core/CodeIgniter.php');
}catch(Exception $e){
}catch(Error $ee){}


include_once(BASEPATH."core/Model.php");
include_once(BASEPATH."core/Controller.php");
include_once(BASEPATH."libraries/Session/Session.php");

echo "Loading ci_controller instance:\n";
new CI_Controller();
CI_Controller::get_instance();
echo "done\n";


use PHPUnit\Framework\TestCase;

error_reporting(E_ALL);
