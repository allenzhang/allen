<?php 
/**
 * 图片处理类
 * @author hb.zhanglu@gmail.com
 * @date 2013-07-18
 */

require_once ROOT . '/model/Model.class.php';
require_once ROOT . '/model/ZoneModel.class.php';

class ImgModel extends Model{

	private $_statusInfo = array(
		1 => '正常显示',
		2 => '待删除',
		3 => '已删除',
	);


	private $_typeInfo = array(
		1 => '普通',
		2 => 'logo',
		3 => '新闻图片',
	);



	/**
	 * 获取图片列表
	 * @param $wId 网站id
	 * @param $zoneId 区域id
	 * @param $id 图片id
	 * @param $status 0不显示，1正常显示，2待删除，3已删除
	 */
	public function getImg($wId, $zoneId, $status, $id){
		$arrImg = array();


		if(!$status){
			$status = 1;
		}
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
		$sql .= ' order by zone_id';

		$arrImg = DBMysql::getAll($handle, $sql);

		return $arrImg;
	}


	public function format($arrImg){
		$res = array();		

		foreach($arrImg as $img){
			$img['statusName'] = $this->_statusInfo[$img['status']]; 
			$img['typeName'] = $this->_typeInfo[$img['type']];
		
			//获取zone name
			$zoneModel = new ZoneModel();
			$zone = $zoneModel->getZone($img['wid'], $img['zone_id']);
			$img['zoneName'] = $zone[0]['description'];

			$img['path'] = CommonConfig::$IMAGE_DIRECTORY . "/{$img['website']}/{$img['uid']}";

			$res[$img['zone_id']][] = $img;
		}

		return $res;
	}


}

?>
