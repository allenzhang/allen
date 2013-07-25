<?php
/**
 * 内容管理控制器，其中包括"图片管理"和"新闻管理"
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */
	
require_once ROOT . '/controller/Controller.class.php';
require_once ROOT . '/model/ImgModel.class.php';
require_once ROOT . '/model/NewsModel.class.php';
require_once ROOT . '/model/ZoneModel.class.php';

class ContentController extends Controller{


	/**
	 * 内容管理首页
	 * @param $wid
	 */
	public function indexAction(){
		$wId = $this->PARAMS['wid'];
		$zoneId = $this->PARAMS['zoneid'];
		//$id = $this->PARAMS['id'];
		$status = $this->PARAMS['status'];

		//获取图片列表
		$iModel = new ImgModel();
		$arrImg = $iModel->getImg($wId, $zoneId, $status);
		$arrImg = $iModel->format($arrImg);

		//获取新闻列表
		$nModel = new NewsModel();
		$arrNews = $nModel->getNews($wId, $zoneId, $status);
		$arrNews = $nModel->format($arrNews);

		//获取区域列表
		$zModel = new ZoneModel();
		$arrZone = $zModel->getZone($wId);
		$arrZone = $zModel->format($arrZone);
		
		$templateValues = array(
			'arrImg' => $arrImg,
			'arrNews' => $arrNews,
			'arrZone' => $arrZone,
		);

		$this->render('content/index', $templateValues);
	}


	/**
	 *	展示"图片/新闻详情"（以网站为单位，分区域展示多图）
	 */
	public function viewAction(){
		$wId = $this->PARAMS['wid'];
		$zoneId = $this->PARAMS['zoneid'];
		$type = $this->PARAMS['type'] ? $this->PARAMS['type'] : 'img';

		if('img' == $type){
			$model = new ImgModel();
			$arrImg = $model->format($model->getImg($wId, $zoneId));

			$templateValues = array(
				'arrImg' => $arrImg[$zoneId], 
			);
		}elseif('news' == $type){
			$model = new NewsModel();
			$arrNews = $model->getNews($wId, $zoneId);

			$templateValues = array(
					'arrNews' => $arrNews,
			);
		}

		$zoneModel = new ZoneModel();
		$arrZone = $zoneModel->getZone($wId, $zoneId);
		$templateValues['type'] = $type;
		$templateValues['zone'] = $arrZone[0];
		$template = 'content/view';

		$this->render($template, $templateValues);
	}


	/**
	 * 上传图片/新闻
	 *
	 *
	 */
	public function uploadImgAction(){
		$wId = $this->PARAMS['wid'];

		//使用ajax上传
		if($type = $this->PARAMS['type']){
			$res = array();

			if('img' == $type){
				$model = new ImgModel();
				$res = $model->upload($this->PARAMS);
			}elseif('news' == $type){
				$model = new NewsModel();
				$res = $model->upload($this->PARAMS);
			}

			echo json_encode($res);
		}else{
			$this->render('img/upload');
		}
	}


}




?>
