<?php require_once dirname(__FILE__) . '/inc/header.html'; ?>

<div class="row-fluid" style="margin-top:10px;">

	<div class="span1"></div>
	<div class="span7">
		<div style="background-color:#eee;margin-bottom:10px;overflow:hidden">
			<div style="float:right;width:50%">
				<h4><a href="./news_detail.php?id=<?php echo $this->arrNews[7][0]['id'];?>"><?php echo $this->arrNews[7][0]['title']; ?></a></h4>
				<span style="line-height: 28px;"><?php echo String::trword($this->arrNews[7][0]['content'],120,'...'); ?></span>
			</div>	
			<div style="float:left;width:50%">
				<a href="#"><img style="width:350px;height:215px" src="<?php echo $this->arrNews[7][0]['imgInfo'][0]['path'] ?>"></a>
			</div>
		</div>


		<?php unset($this->arrNews[7][0]); foreach($this->arrNews[7] as $news){?>
		<div style="width:50%;float:left;margin-top:10px">
			<div style="width:100%"><a href="./news_detail.php?id=<?php echo $news['id'];?>"><h5><?php echo $news['title'];?></h5></a></div>
			<div style="width:100%;overflow:hidden">
				<div style="width:30%;float:left"><a href="./news_detail.php?id=<?php echo $news['id'];?>"><img style="width:90px;height:90px" src="<?php echo $news['imgInfo'][0]['path'] ?>"/></a></div>
				<div style="width:70%;float:right;">
					<div style="margin-right:30px;"><?php echo String::trword($news['content'],60,'...'); ?></div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>

	<div class="span3">
		<?php require_once dirname(__FILE__) . '/hot.html'; ?>	
	</div>
</div>

<?php require_once dirname(__FILE__) . '/inc/footer.html'; ?>
