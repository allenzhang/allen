<?php require_once dirname(__FILE__) . '/../inc/header.html'; ?>


<div class="row-fluid">

<!--Zone start-->
<div class="J_zone" style="width:60%">
	<h4>区域</h4>
	<table class="J_tb_zone table table-condensed table-bordered table-hover">
		<thead><tr style="font-weight:900;"><td>#</td><td>网站</td><td>操作</td><td>描述</td><td>状态</td><td>类型</td></tr></thead>
		<tbody>
		<?php $index=$j=0;foreach($this->arrZone as $wId=>$zones){ $j++?>
			<?php foreach($zones as $i=>$zone){ $index++; ?>
			<tr>
				<td><?php echo $index;?></td>
				<?php if(0==$i){ ?> 
				<td rowspan="<?php echo count($zones);?>" class="<?php if(1==$j%3){echo 'm_bg_td1';}elseif(2==$j%3){echo 'm_bg_td2';}else{echo 'm_bg_td3';}?>" style="vertical-align: middle;">
					<p><?php echo $zone['website'];?></p>
					<p><a class="J_add_zone" href="<?php echo $this->domain."/index.php?c=content&a=view&type=zone&wid={$zone['wid']}"; ?>"><i title="添加区域" class="icon-pencil"></i></a></p>
				</td>
				<?php }?>
                <td>
					<a href="<?php echo $this->domain."/index.php?c=content&a=delete&type=zone&wid={$zone['wid']}&zoneid={$zone['id']}"; ?>"><i title="删除区域" class="icon-remove"></i></a>
				</td>
                <td><?php echo $zone['description'];?></td>
                <td><?php echo $zone['statusName'];?></td>
                <td><?php echo $zone['type'];?></td>
			</tr>
			<?php }?>
		<?php }?>
		</tbody>		
	</table>
</div>
<script>
	function addZone(){
	
		alert('a');
	}
	$('.J_add_zone').bind('click', function(){
		//get tbody
		var tbody = $('.J_tb_zone tbody');
		var html = "<tr>"
		+"<td></td>"
		+"<td></td>"
		+"<td></td>"
		+"<td><input class=\"J_zone_des\" style=\"height:15px;width:110px;\" name=\"description\" type=\"text\" value=\"\"></td>"
		+"<td><select style=\"width:80px;\" class=\"J_zone_status\" name=\"status\"><option value=\"0\">取消</option><option value=\"1\">正常</option><select></td>"
		+"<td><select style=\"width:80px;\" class=\"J_zone_type\" name=\"type\"><option value=\"image\">image</option><option value=\"news\">news</option><select></td>"
		+"</tr>";

		tbody.append(html);

		return false;
	});
</script>
<!--Zone end-->



<!--News start-->
<div class="J_news" style="width:60%">
	<h4>新闻</h4>
	<table class="table table-condensed table-bordered table-hover">
		<tr style="font-weight:900;"><td>#</td><td>网站/区域</td><td>操作</td><td>标题</td><td>来源</td><td>数量</td><td>状态</td></tr>

	<?php $index=$j=0;foreach($this->arrNews as $zoneId=>$news1){ $j++?>
		<?php foreach($news1 as $i=>$news){ $index++; ?>
			<tr>
				<td><?php echo $index;?></td>
				<?php if(0==$i){ ?>
				<td rowspan="<?php echo count($news1);?>" class="<?php if(1==$j%3){echo 'm_bg_td1';}elseif(2==$j%3){echo 'm_bg_td2';}else{echo 'm_bg_td3';}?>" style="vertical-align:middle;text-align:center">
					<p><?php echo "{$news['website']}/{$news['zoneName']}({$news['zone_id']})";?></p>
	           		<p><a href="<?php echo $this->domain."/index.php?c=content&a=view&type=news&wid={$img['wid']}&zoneid={$zoneId}"; ?>"><i title="上传新闻" class="icon-circle-arrow-up"></i></a></p>
                </td>
				<?php }?>
                <td>
					<a href="<?php echo $this->domain."/index.php?c=content&a=view&type=news&wid={$img['wid']}&zoneid={$zoneId}"; ?>"><i title="查看新闻" class="icon-eye-open"></i></a>
					<a href="<?php echo $this->domain."/index.php?c=content&a=delete&type=news&wid={$img['wid']}&zoneid={$zoneId}"; ?>"><i title="删除新闻" class="icon-remove"></i></a>
				</td>
                <td><?php echo $news['title'];?></td>
                <td><?php echo $news['source'];?></td>
                <td><?php echo $news['img_count'];?></td>
                <td><?php echo $news['statusName'];?></td>
			</tr>
		<?php }?>
	<?php }?>
	</table>
</div>
<!--News end-->


<!--Image start-->
<div class="J_image" style="width:60%">
	<h4>图片</h4>
	<table class="table table-condensed table-bordered table-hover">
		<thead>
		<tr style="font-weight:900;"><td>#</td><td>网站/区域/操作</td><td>uid</td><td>描述</td><td>类型</td><td>状态</td></tr>
		</thead>
		<tbody>
		<?php $index=$j=0;foreach($this->arrImg as $zoneId=>$imgs){ $j++?>
			<?php foreach($imgs as $i=>$img){ $index++; ?>
			<tr>
				<td><?php echo $index;?></td>
				<?php if(0==$i){ ?>
				<td rowspan="<?php echo count($imgs);?>" class="<?php if(1==$j%3){echo 'm_bg_td1';}elseif(2==$j%3){echo 'm_bg_td2';}else{echo 'm_bg_td3';}?>" style="vertical-align: middle;">
					<p><?php echo "{$img['website']}/{$img['zoneName']}({$img['zone_id']})";?></p>
					</p>
						<a href="<?php echo $this->domain."/index.php?c=content&a=view&type=img&wid={$img['wid']}&zoneid={$zoneId}"; ?>"><i title="编辑" class="icon-pencil"></i></a>
					</p>
				</td>
				<?php }?>
				<td><?php echo $img['uid'];?></td>
                <td><?php echo $img['description'];?></td>
                <td><?php echo $img['typeName'];?></td>
                <td><?php echo $img['statusName'];?></td>
			</tr>
			<?php }?>
		<?php }?>
		</tbody>
	</table>
</div>
<!--Image end-->



</div>

<?php require_once dirname(__FILE__) . '/../inc/footer.html'; ?>
