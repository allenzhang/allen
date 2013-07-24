<?php 
/**
 * 处理类
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */


require_once ROOT . '/model/Model.class.php';

class SiteModel extends Model{


	public function getImg($wId, $zoneId){
		$arrImg = array();

		$url = Config::$IMG_API_DOMAIN . "/index.php?r=imgApi/getImagesByZone&wid={$wid}&zone_id={$zone_id}"; 
		$transfer = Curl::callApiByCurl($url);
		$arrImg = json_decode($transfer['content'], true);
		/*foreach($res as $img){
			$img['path'] = Config::$IMG_PATH_PREFIX . '/' . $img['uid'];
			$arrImgInfo[] = $img;
		}*/

		return $arrImg;
	}

	public function getNews($wId, $zoneId){
		$arrNews = array();

		$url = Config::$NEWS_API_DOMAIN . "/index.php?r=newsApi/getNewsByZone&wid={$wid}&zoneId={$zoneId}"; 
		$transfer = Curl::callApiByCurl($url);
		$arrNews = json_decode($transfer['content'], true);

		return $arrNews;
	}


	public function getNewsById($wid, $newsId){

		$url = Config::$NEWS_API_DOMAIN . "/index.php?r=newsApi/getNewsById&wid={$wid}&newsId={$newsId}"; 
		$transfer = Curl::callApiByCurl($url);
		$res = json_decode($transfer['content'], true);

		return $res;
	}



}

?>
