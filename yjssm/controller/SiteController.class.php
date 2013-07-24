<?php
/**
 * 控制器
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */
	
require_once ROOT . '/model/SiteModel.class.php';
require_once ROOT . '/controller/Controller.class.php';

class SiteController extends Controller{


	/**
	 * 首页 
	 */
	public function indexAction(){
		
		$this->render('index');
	}


	/**
	 * 新闻页 
	 */
	public function newsAction(){
		
		$this->render('news');
	}


	/**
	 * 新闻详情页 
	 */
	public function newsViewAction(){
		
		$this->render('news_view');
	}
}




?>
