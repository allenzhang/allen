<?php
/**
 * 外部调用API入口
 * @author hb.zhanglu@gmail.com 
 * @date 2013-07-25
 */

ini_set('display_errors', 1);
error_reporting(E_ERROR);
define('ROOT', dirname(__FILE__) . '/..');
define('CODE_BASE', ROOT . '/../' . 'code_base');

$controller = $_GET['c'] ? $_GET['c'] : 'nav';
$action = $_GET['a'] ? $_GET['a'] : 'index';

$controller = ucwords($controller) . 'ApiController';
$filePath = ROOT . '/api/' . "{$controller}.class.php";

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
	echo "illegal request (api)";die();
}





?>
