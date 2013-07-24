<?php 
/**
 * 新闻处理类
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */

require_once CODE_BASE . '/db/DBMysql.class.php';
require_once ROOT . '/config/DBConfig.class.php';
require_once ROOT . '/model/Model.class.php';

class NewsModel extends Model{

	private $_statusInfo = array(
		1 => '正常显示',
		2 => '待删除',
		3 => '已删除',
	);

	/**
	 * 获取新闻列表
	 * @param $wId 网站id
	 * @param $zoneId 区域id
	 * @param $id 新闻id
	 * @param $status 0不显示，1正常显示，2待删除，3已删除
	 */
	public function getNews($wId, $zoneId, $status, $id){
		$arrNews = array();


		if(!$status){
			$status = 1;
		}
		$handle = DBMysql::createDBHandle(DBConfig::$DEFAULT_DB, DBConfig::$DEFAULT_DB['database']);
		$sql = "select * from vs_news where status={$status}";
		if($id){
			$sql .= " and id ={$id}";
		}else{
			if($wId){
				$sql .= " and wid={$wId}";
			}
			if($zoneId){
				$sql .= " and zone_id={$zoneId}";
			}
		}
		$sql .= ' order by zone_id';

		$arrNews = DBMysql::getAll($handle, $sql);

		return $arrNews;
	}


	public function format($arrNews){
		$res = array();

		foreach($arrNews as $news){
			$news['statusName'] = $this->_statusInfo[$news['status']];

			//获取zone name
			$zoneModel = new ZoneModel();
			$zone = $zoneModel->getZone($news['wid'], $news['zone_id']);
			$news['zoneName'] = $zone[0]['description'];

			$res[$news['zone_id']][] = $news;
		}

		return $res;
	}


}

?>
