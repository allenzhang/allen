<?php require_once dirname(__FILE__) . '/inc/header.html'; ?>

<div class="row-fluid">
	<div class="span7 offset1 page">
		<div><h4><?php echo $this->news['title']; ?></h4></div>
		<div><?php echo $this->news['pub_time']; ?>&nbsp;&nbsp;来源：<?php echo $this->news['source'];?></div>

		<div>
			<?php if($this->news && $this->news['imgInfo']){?>
				<img style="width:520px;height:280px" src="<?php echo $this->news['imgInfo'][0]['path'] ?>">
			<?php }?>	
		</div>
		<div class="row-fluid">
			<div class="span10 offset1" style="font-size:14px"><?php echo $this->news['content']; ?></div>
		</div>

	</div>


	<div class="span3">
		<?php require_once dirname(__FILE__) . '/hot.html'; ?>	
	</div>
</div>

<?php require_once dirname(__FILE__) . '/inc/footer.html'; ?>
