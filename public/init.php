<?php
require_once "../vendor/autoload.php";
ini_set('display_errors',1); 
error_reporting(E_ALL);
define('IN_DEVELOPEMENT', filter_var(ini_get('display_errors'), FILTER_VALIDATE_BOOLEAN));
if(IN_DEVELOPEMENT){
	//var_dump($_SERVER);
}