<?php require_once dirname(__FILE__) . '/inc/header.html'; ?>

<?php 
	$newsId = (int)$_GET['id'];
	if($newsId){
		$news = Utils::getNewsById(1, $newsId);
	}
?>
<div class="row-fluid">
	<div class="span7 offset1">
		<div><h4><?php echo $news['title']; ?></h4></div>
		<div><?php echo $news['pub_time']; ?>&nbsp;&nbsp;来源：<?php echo $news['source'];?></div>

		<div>
			<?php if($news && $news['imgInfo']){?>
				<img style="width:520px;height:280px" src="<?php echo $news['imgInfo'][0]['path'] ?>">
			<?php }?>	
		</div>
		<div class="row-fluid">
			<div class="span10 offset1" style="font-size:14px"><?php echo $news['content']; ?></div>
		</div>

	</div>


	<div class="span3">
		<?php require_once dirname(__FILE__) . '/hot.html'; ?>	
	</div>
</div>

<?php require_once dirname(__FILE__) . '/inc/footer.html'; ?>
