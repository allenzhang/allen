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

		$model = new SiteModel();

		$arrImg = $arrNews  = array();
		$arrImg = $model->getImg(1, array(1,3,4,5));//$wid=1(yjssm)

		$arrNews = $model->getNews(1, 7);
		$tmplateValues = array(
			'arrImg' => $arrImg,
			'arrNews' => $arrNews,
		);

		$this->render('index', $tmplateValues);
	}


	/**
	 * 新闻页 
	 */
	public function newsAction(){
		$arrNews = array();		

		$model = new SiteModel(); 
		//获取新闻
		$wId = 1;
		$nZoneId = 7;
		$arrNews = $model->getNews($wId, $nZoneId);

		//获取热门图片
		$wId = 1;
		$iZoneId = 4;
		$arrImg = $model->getImg($wId, $iZoneId);
		
		$tmplateValues = array(
			'arrNews' => $arrNews,
			'arrImg' => $arrImg,
		);

		$this->render('news', $tmplateValues);
	}


	/**
	 * 新闻详情页 
	 */
	public function newsViewAction(){
		$news = array();     

		$id = $this->PARAMS['id'];

		$model = new SiteModel(); 
		//获取新闻  
		$tmpNews = $model->getNews(null, null, $id);
		$news = array_values($tmpNews);

		//获取热门图片
		$wId = 1;       
		$iZoneId = 4;        
		$arrImg = $model->getImg($wId, $iZoneId);
		

		$tmplateValues = array(
				'news' => $news[0][0],
				'arrImg' => $arrImg, 
				);	

		$this->render('news_view', $tmplateValues);
	}


	public function productAction(){

		$tmplateValues = array(

		);
		$this->render('product', $tmplateValues);
	}


	public function workshopAction(){

		$tmplateValues = array(

		);
		$this->render('workshop', $tmplateValues);
	}


	public function honorAction(){

		$tmplateValues = array(

		);
		$this->render('honor', $tmplateValues);
	}


	public function networkAction(){

        $tmplateValues = array(

        );  
        $this->render('network', $tmplateValues);
    }


	public function contactAction(){

		$tmplateValues = array(

		);
		$this->render('contact', $tmplateValues);
	}


}




?>
