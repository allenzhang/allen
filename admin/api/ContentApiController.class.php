<?php 
/**
 * 内容API控制类
 * @author hb.zhanglu@gmail.com 
 * @date 2013-07-25
 */

require_once ROOT . '/api/ApiController.class.php';
require_once ROOT . '/model/ImgModel.class.php';
require_once ROOT . '/model/NewsModel.class.php';
require_once ROOT . '/model/ZoneModel.class.php';

class ContentApiController extends ApiController{

	public function getImgAction(){
		$wId = $this->PARAMS['wid'];
		$id = $this->PARAMS['id'];
        $tmpZoneId = $this->PARAMS['zoneid'];

		//判断是否是多个区域
		if(strstr($tmpZoneId, ',')){
			$zoneId = explode(',', $tmpZoneId);
		}else{
			$zoneId = $tmpZoneId;
		}
	
		$iModel = new ImgModel();
		$status = 1;
        $arrImg = $iModel->getImg($wId, $zoneId, $statusi, $id);
        $arrImg = $iModel->format($arrImg);

		echo  json_encode($arrImg);
	}
	

	public function getNewsAction(){
		$wId = $this->PARAMS['wid'];
		$id = $this->PARAMS['id'];
        $tmpZoneId = $this->PARAMS['zoneid'];

		//判断是否是多个区域
		if(strstr($tmpZoneId, ',')){
			$zoneId = explode(',', $tmpZoneId);
		}else{
			$zoneId = $tmpZoneId;
		}
	
		$nModel = new NewsModel();
		$status = 1;
        $tmpArrNews = $nModel->getNews($wId, $zoneId, $status, $id);

		//添加图片信息
		$arrNews = array();
		$iModel = new ImgModel();
		foreach($tmpArrNews as $news){
			if($news['img_count'] < 1)continue;

			$newsId = $news['id'];
			$tmpImg = $iModel->getImg(null,null,null,null, $newsId);
			$img = $iModel->format($tmpImg);
			$news['imgInfo'] = $img[$news['zone_id']];

			$arrNews[] = $news;
		}
        $arrNews = $iModel->format($arrNews);


		echo  json_encode($arrNews);
	}

}




?>
