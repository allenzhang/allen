<?php 
/**
 * 区域处理类
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */

require_once CODE_BASE . '/db/DBMysql.class.php';
require_once ROOT . '/config/DBConfig.class.php';
require_once ROOT . '/model/Model.class.php';

class ZoneModel extends Model{

	private $_statusInfo = array(
        1 => '正常显示',
        2 => '待删除',
        3 => '已删除',
    );


	/**
	 * 获取区域列表
	 * @param $wId 网站id
	 * @param $id 区域id
	 * @param $status 0不显示，1正常显示，2待删除，3已删除
	 */
	public function getZone($wId, $id, $status){
		$arrZone = array();

		if(!$status){
			$status = 1;
		}
		$handle = DBMysql::createDBHandle(DBConfig::$DEFAULT_DB, DBConfig::$DEFAULT_DB['database']);
		$sql = "select * from vs_zone where status={$status}";
		if($id){
			$sql .= " and id ={$id}";
		}else{
			if($wId){
				$sql .= " and wid={$wId}";
			}
		}

		$arrZone = DBMysql::getAll($handle, $sql);

		return $arrZone;
	}


	public function format($arrZone){
		$res = array();

		foreach($arrZone as $zone){
			$zone['statusName'] = $this->_statusInfo[$zone['status']];

			$res[$zone['website']][] = $zone;
		}


		return $res;
	}

}

?>
