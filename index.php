<?php
/************** FRONT CONTROLLER ***************/

function printer($data)
{
    echo "<pre>";
        print_r($data);
    echo "</pre>";
    exit;
}
// petqa 1 0 sarqel vor erorner@ cuyc chta mardu
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

define("ROOT", dirname(__FILE__));
require_once ROOT . "/includes/Autoload.php";

//call Router
$router = new Router();
$router->run();