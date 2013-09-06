<?php require_once dirname(__FILE__) . '/inc/header.html'; ?>

<div class="row-fluid" style="margin-top:10px;">

	<div class="span1"></div>
	<div class="span7">
		<div style="background-color:#eee;margin-bottom:10px;overflow:hidden">
			<div style="float:right;width:50%">
				<div style="margin:15px 15px 3px 15px">
					<h4>衡水永佳电动伸缩门配件厂</h4>
					<span style="line-height: 28px;">公司已有十余年的发展历史，主要生产电动伸缩门配件（轮类，轮罩，机头轮，行走轮等），专业维修电动伸缩门，在市场经济的大潮下，本厂跻身国内大型专业生产厂家的行列，生产的铸铁轮，橡胶轮等产品被许多国家大中型重点工程所采用，取得了经济效益和社会效益的双丰收。</span>
				</div>
			</div>	
			<div style="float:left;width:50%">
				<a href="#"><img style="width:350px;height:215px" src="<?php echo $this->domain.'/media/img/news.jpg';?>"></a>
			</div>
		</div>


		<?php foreach($this->arrNews[7] as $news){?>
		<div style="width:50%;float:left;margin-top:17px">
			<div style="width:100%"><a href="./news_<?php echo $news['id'];?>.html"><div style="font-weight:600;margin-bottom:5px"><?php echo $news['title'];?></div></a></div>
			<div style="width:100%;overflow:hidden">
				<div style="width:30%;float:left"><a href="<?php echo $this->domain.'/news_'.$news['id'].'.html';?>"><img style="width:90px;height:90px" src="<?php echo $news['imgInfo'][0]['path'] ?>"/></a></div>
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
