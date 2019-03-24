<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define("__ROOT_DIR__",dirname(__DIR__));
define("__VALIDATION_DIR__",__ROOT_DIR__.'/Validation');
define("__WEB_DIR__",__ROOT_DIR__.'/WebPortal');

function load_model($name){
    require_once(__WEB_DIR__."/application/models/$name.php");
}

function load_controller($name){
    require_once(__WEB_DIR__."/application/controllers/$name.php");
}
