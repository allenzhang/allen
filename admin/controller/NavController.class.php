<?php
/**
 * 图片控制器
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */
	
require_once ROOT . '/model/NavModel.class.php';
require_once ROOT . '/controller/Controller.class.php';

class NavController extends Controller{


	/**
	 * 首页 
	 */
	public function indexAction(){
		
		$this->render('index');
	}

	/**
	 * 上传图片
	 *
	 *
	 */
	public function uploadAction(){

		$this->render('img/upload');
	}


}




?>
