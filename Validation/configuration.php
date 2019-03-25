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
$router->class='../../../Validation/FakeController';
$router->method='index';

print("debugging\n");



$e404 = false;
$class = ucfirst($router->class);
$method = $router->method;

if (empty($class) OR ! file_exists(APPPATH.'controllers/'.$router->directory.$class.'.php')){
    $e404 = true;print("\$e404 is false because of 1\n");
}else{
    echo "Loading\n";
    include_once(BASEPATH."core/Controller.php");
    echo "CI_Controller done\n";
    echo "directory directory ".$router->directory."\n";
    include_once(APPPATH.'controllers/'.$router->directory.$class.'.php');
    echo "Loaded\n";
    
    if ( ! class_exists($class, FALSE) OR $method[0] === '_' OR method_exists('CI_Controller', $method)){
        $e404 = true;print("\$e404 is false because of 2\n");
    } elseif (method_exists($class, '_remap'))  {
        $params = array($method, array_slice($URI->rsegments, 2));
        $method = '_remap';
    } elseif ( ! method_exists($class, $method)) {
        $e404 = true;print("\$e404 is false because of 3\n");
    } elseif ( ! is_callable(array($class, $method))) {
        $reflection = new ReflectionMethod($class, $method);
        if ( ! $reflection->isPublic() OR $reflection->isConstructor()){
            $e404 = true;print("\$e404 is false because of 4\n");
        }
    }
}

if ($e404){
    print("\$e404 was set to true\n");
    if ( ! empty($router->routes['404_override'])){
        print("test route overriding\n");
        if (sscanf($router->routes['404_override'], '%[^/]/%s', $error_class, $error_method) !== 2){
            $error_method = 'index';
        }
        
        $error_class = ucfirst($error_class);
        
        if ( ! class_exists($error_class, FALSE)) {
            if (file_exists(APPPATH.'controllers/'.$router->directory.$error_class.'.php')) {
                require_once(APPPATH.'controllers/'.$router->directory.$error_class.'.php');
                $e404 = ! class_exists($error_class, FALSE);
            } elseif ( ! empty($router->directory) && file_exists(APPPATH.'controllers/'.$error_class.'.php')) {
                require_once(APPPATH.'controllers/'.$error_class.'.php');
                if (($e404 = ! class_exists($error_class, FALSE)) === FALSE) {
                    $router->directory = '';
                }
            }
        } else  {
            print("set \$e404 to false\n");
            $e404 = FALSE;
        }
    }
}else print("\$e404 still set to false\n");


print("end debugging\n");











echo "To find: ".APPPATH.'controllers/'.$RTR->directory.$router->class.".php\n";
echo "File exists ? ".( file_exists(APPPATH.'controllers/'.$RTR->directory.$router->class.'.php') ?  "Oui" : "Non")."\n";

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
