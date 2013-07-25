<?php require_once dirname(__FILE__) . '/../inc/header.html'; ?>



<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php'
			});
		});
	</script>






<div class="row-fluid">
<div class="span6">
	<!--Zone start-->
	<h4>区域</h4>
	<table class="table table-condensed table-bordered table-hover">
		<thead><tr><td>#</td><td>网站</td><td>描述</td><td>状态</td><td>类型</td><td>操作</td></tr></thead>
		<tbody>
		<?php $index=$j=0;foreach($this->arrZone as $wId=>$zones){ $j++?>
			<?php foreach($zones as $i=>$zone){ $index++; ?>
			<tr class="<?php if(1==$j%3){echo 'success';}elseif(2==$j%3){echo 'error';}else{echo 'info';}?>">
				<td><?php echo $index;?></td>
				<td><?php echo $zone['website'];?></td>
				<td><?php echo $zone['description'];?></td>
				<td><?php echo $zone['statusName'];?></td>
				<td><?php echo $zone['type'];?></td>
				<?php if(0==$i){ ?> 
				<td rowspan="<?php echo count($zones);?>">
					<a href="<?php echo $this->domain."/index.php?c=content&a=view&type=zone&wid={$zone['wid']}"; ?>"><i title="编辑" class="icon-pencil"></i></a>
				</td>
				<?php }?>
			</tr>
			<?php }?>
		<?php }?>
		</tbody>		
	</table>
	<!--Zone end-->
</div>

<div class="span6">
	<!--News start-->
	<h4>新闻</h4>
	<table class="table table-condensed table-bordered table-hover">
		<tr><td>#</td><td>网站</td><td>标题</td><td>来源</td><td>数量</td><td>状态</td><td>区域</td><td>修改</td></tr>

	<?php $index=$j=0;foreach($this->arrNews as $zoneId=>$news1){ $j++?>
		<?php foreach($news1 as $i=>$news){ $index++; ?>
			<tr class="<?php if(1==$j%3){echo 'success';}elseif(2==$j%3){echo 'error';}else{echo 'info';}?>">
				<td><?php echo $index;?></td>
				<td><?php echo $news['website'];?></td>
				<td><?php echo $news['title'];?></td>
				<td><?php echo $news['source'];?></td>
				<td><?php echo $news['img_count'];?></td>
				<td><?php echo $news['statusName'];?></td>
				<?php if(0==$i){ ?>
				<td rowspan="<?php echo count($news1);?>"><?php echo $news['zoneName'];?></td>
				<td rowspan="<?php echo count($news1);?>">
                    <a href="<?php echo $this->domain."/index.php?c=content&a=view&type=news&wid={$img['wid']}&zoneid={$zoneId}"; ?>"><i title="编辑" class="icon-pencil"></i></a>
                </td>
				<?php }?>
			</tr>
		<?php }?>
	<?php }?>
	</table>
	<!--News end-->
</div>

<div class="span12">
	<!--Image start-->
	<h4>图片</h4>
	<table class="table table-condensed table-bordered table-hover">
		<thead>
		<tr><td>#</td><td>uid</td><td>网站</td><td>描述</td><td>类型</td><td>状态</td><td>区域</td><td>操作</td></tr>
		</thead>
		<tbody>
		<?php $index=$j=0;foreach($this->arrImg as $zoneId=>$imgs){ $j++?>
			<?php foreach($imgs as $i=>$img){ $index++; ?>
			<tr class="<?php if(1==$j%3){echo 'success';}elseif(2==$j%3){echo 'error';}else{echo 'info';}?>">
				<td><?php echo $index;?></td>
				<td><?php echo $img['uid'];?></td>
				<td><?php echo $img['website'];?></td>
				<td><?php echo $img['description'];?></td>
				<td><?php echo $img['typeName'];?></td>
				<td><?php echo $img['statusName'];?></td>
				<?php if(0==$i){ ?>
				<td rowspan="<?php echo count($imgs);?>"><?php echo $img['zoneName'];?></td>
				<td rowspan="<?php echo count($imgs);?>">
					<a href="<?php echo $this->domain."/index.php?c=content&a=view&type=img&wid={$img['wid']}&zoneid={$zoneId}"; ?>"><i title="编辑" class="icon-pencil"></i></a>
				</td>
				<?php }?>
			</tr>
			<?php }?>
		<?php }?>
		</tbody>
	</table>
	<!--Image end-->
</div>



</div>

<?php require_once dirname(__FILE__) . '/../inc/footer.html'; ?>
