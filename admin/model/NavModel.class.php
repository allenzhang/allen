<?php 
/**
 * 导航处理类
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */

require_once CODE_BASE . '/db/DBMysql.class.php';
require_once ROOT . '/config/DBConfig.class.php';
require_once ROOT . '/model/Model.class.php';

class NavModel extends Model{


	/**
	 * 获取图片列表
	 * @param $wId 网站id
	 * @param $zoneId 区域id
	 * @param $id 图片id
	 * @param $status 0不显示，1正常显示，2待删除，3已删除
	 */
	public function getImg($wId, $zoneId, $status = 1, $id){
		$arrImg = array();

		$handle = DBMysql::createDBHandle(DBConfig::$DEFAULT_DB, DBConfig::$DEFAULT_DB['database']);
		$sql = "select * from vs_img where status={$status}";
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
		$sql .= ' order by weight desc';

		$arrImg = DBMysql::getAll($handle, $sql);

		return $arrImg;
	}




}

?>
