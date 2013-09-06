<?php require_once dirname(__FILE__) . '/inc/header.html'; ?>

<div class="row-fluid" style="margin-top:10px">
	<div class="span1"></div>
	<div class="span7">
		<div style="text-align:center">
			<div><h4><?php echo $this->news['title']; ?></h4></div>
			<div style="margin-top:20px;"><?php echo $this->news['pub_time']; ?>&nbsp;&nbsp;来源：<?php echo $this->news['source'];?></div>
			<div>
				<?php if($this->news && $this->news['imgInfo']){?>
				<!--	<img style="width:520px;height:280px" src="<?php echo $this->news['imgInfo'][0]['path'] ?>">-->
				<?php }?>	
			</div>
		</div>
		<div style="font-size:14px;line-height:30px;text-indent:30px;padding:30px"><p><?php echo $this->news['content']; ?></p></div>

	</div>


	<div class="span3">
		<?php require_once dirname(__FILE__) . '/hot.html'; ?>	
	</div>
</div>

<?php require_once dirname(__FILE__) . '/inc/footer.html'; ?>
