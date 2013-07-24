<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
define('ROOT', dirname(__FILE__));
//define('DS', DIRECTORY_SEPARATOR);
define('CODE_BASE', ROOT . '/../' . 'code_base');

$controller = $_GET['c'] ? $_GET['c'] : 'nav';
$action = $_GET['a'] ? $_GET['a'] : 'index';


$controller = ucwords($controller) . 'Controller';
$filePath = ROOT . '/controller/' . "{$controller}.class.php";

if(file_exists($filePath)){
	require_once $filePath;

	$action .= 'Action';
	$cObj = new $controller();
	if(method_exists($cObj, $action)){
		$cObj->$action();
	}else{
		echo "illegal request (method)";die();
	}
}else{
	echo "illegal request (controller)";die();
}





?>
