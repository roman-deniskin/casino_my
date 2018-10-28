<?
ini_set("display_errors",1);
error_reporting(E_ALL);
define("PROLOG_CHECKER", true);
session_start([
	'cookie_lifetime' => 86400,
]);
spl_autoload_register(function ($class_name) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/core/classes/'.str_replace('\\', '/', $class_name).'.php');
})
?>