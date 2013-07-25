<?php 
/**
 * API控制层基类
 * @author hb.zhanglu@gmail.com 
 * @date 2013-07-25
 */

require_once CODE_BASE . '/db/DBMysql.class.php';
require_once ROOT . '/config/DBConfig.class.php';   
require_once ROOT . '/config/CommonConfig.class.php';  

class ApiController{

	function __construct(){  
		//创建全局http请求参数，并销毁$_GET,$_POST
		$this->PARAMS = $_REQUEST;
		$this->domain = CommonConfig::$DOMAIN; 
		unset($_REQUEST);    
		unset($_GET);        
		unset($_POST);   
	}

}




?>
