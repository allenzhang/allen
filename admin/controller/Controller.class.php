<?php
/**
 * 控制器基类
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */

require_once CODE_BASE . '/db/DBMysql.class.php';
require_once ROOT . '/config/DBConfig.class.php';	
require_once ROOT . '/config/CommonConfig.class.php';	

class Controller{
	
	public $domain = '';

	public $PARAMS = array();

	private $FILE_SUFFIX = '.php';  


	function __construct(){
		//检查客户端IP
		$ip = $this->_getRemoteIp();
		if(!$ip || !in_array($ip, CommonConfig::$WHITE_LIST_REMOTE_IP)){
			exit;
		}

		//创建全局http请求参数，并销毁$_GET,$_POST
		$this->PARAMS = $_REQUEST;
		$this->domain = CommonConfig::$DOMAIN;
		unset($_REQUEST);
		unset($_GET);
		unset($_POST);
	}


	public function render($template, &$values){
		$VIEW_DIR = dirname(__FILE__) . '/../view/';

		$filePath = $VIEW_DIR . $template . $this->FILE_SUFFIX;
		if(!file_exists($filePath)){
			$filePath = $VIEW_DIR . '400' . $this->FILE_SUFFIX;
		}


		foreach ((array)$values as $k => $v){
			$this->$k = $v;
		}

		header('Content-Type:text/html; charset=UTF-8');
		ob_start();
		include $filePath;
		$ret = ob_get_contents();
		ob_end_clean();
		echo $ret;
		exit;
	}


	/**
	 * 获取客户端ip
	 * @return $cip
	 */
	private function _getRemoteIp(){
		if(!empty($_SERVER["HTTP_CLIENT_IP"])){    
			$cip = $_SERVER["HTTP_CLIENT_IP"];
		}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){    
			$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];  
		}elseif(!empty($_SERVER["REMOTE_ADDR"])){    
			$cip = $_SERVER["REMOTE_ADDR"];  
		}else {
			$cip = "无法获取！"; 
		}
   
		return $cip; 
	}


}




?>
