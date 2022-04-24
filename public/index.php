<?php

require_once('../config/config.php');
require_once('../vendor/autoload.php');

use Classes\DispatchClass;

// error_reporting(1);

header("Content-Type: application/json; charset=UTF-8"); 

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // header('Access-Control-Allow-Origin: http://localhost:4200');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE');
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header('Content-Type: application/json');  
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
    
    
    // header("Access-Control-Allow-Origin: http://localhost:4200");
    // header('Access-Control-Allow-Credentials: true');
    // header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");         
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])){
        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
    exit(0);
}

$controller = new DispatchClass();
// echo '<pre>';
return $controller->addController();
// echo '</pre>';
