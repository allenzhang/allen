<?php 
/**
 * 处理类
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */


require_once ROOT . '/model/Model.class.php';
require_once ROOT . '/utils/Curl.class.php';

class SiteModel extends Model{


	public function getImg($wId, $zoneId, $id){
		$arrImg = array();

		if(is_array($zoneId)){
			$tmpZoneId = implode(',', $zoneId);
		}else{
			$tmpZoneId = $zoneId;
		}

		$url = Config::$IMG_API_DOMAIN . "/index.php?c=content&a=getImg&wid={$wId}&zoneid={$tmpZoneId}&id={$id}"; 
		$transfer = Curl::callApiByCurl($url);
		$arrImg = json_decode($transfer['content'], true);

		return $arrImg;
	}

	public function getNews($wId, $zoneId, $id){
		$arrNews = array();

		$url = Config::$NEWS_API_DOMAIN . "/index.php?c=content&a=getNews&wid={$wId}&zoneid={$zoneId}&id={$id}"; 
		$transfer = Curl::callApiByCurl($url);
		$arrNews = json_decode($transfer['content'], true);

		return $arrNews;
	}

}

?>
