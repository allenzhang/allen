<?php require_once dirname(__FILE__) . '/inc/header.html'; ?>

<div class="row-fluid">

	<div class="span7 offset1 page">
		<div class="row-fluid" style="background-color:#eee;border-radius:5px;margin-top:10px;margin-bottom:10px;">
			<div class="span6">
				<a href="#" class="thumbnail"><img style="width:350px;height:215px" src="<?php echo $this->arrNews[7][0]['imgInfo'][0]['path'] ?>"></a>
			</div>
			<div class="span6" style="margin:10px 5px 10px 10px;">
			<h4><a href="./news_detail.php?id=<?php echo $this->arrNews[7][0]['id'];?>"><?php echo $this->arrNews[7][0]['title']; ?></a></h4>
				<span style="color:#272727;line-height: 28px;"><?php echo String::trword($this->arrNews[7][0]['content'],120,'...'); ?></span>
			</div>	
		</div>


<?php $index = 0;
	foreach($this->arrNews[7] as $news){$index++;
?>

	<?php if(1==$index%2){?>
		<div class="row-fluid" style="margin-top:20px;">
	<?php }?>
	<div class="span6">
		<div>
			<a href="./news_detail.php?id=<?php echo $news['id'];?>"><h5><?php echo $news['title'];?></h5></a>
		</div>
<div class="row-fluid">
		<div class="span4">
			<a class="thumbnail" href="./news_detail.php?id=<?php echo $news['id'];?>"><img style="width:90px;height:90px" src="<?php echo $news['imgInfo'][0]['path'] ?>"/></a>
		</div>
		<div class="span8">
			<?php echo String::trword($news['content'],60,'...'); ?>
		</div>
</div>
	</div>
	<?php if(0==$index%2){?>
		</div>
	<?php }?>
<?php }?>

	</div>


	<div class="span3">
		<?php require_once dirname(__FILE__) . '/hot.html'; ?>	
	</div>
</div>

<?php require_once dirname(__FILE__) . '/inc/footer.html'; ?>
