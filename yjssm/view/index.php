<?php require_once dirname(__FILE__) . '/inc/header.html'; ?>

		<div class="row-fluid">
			<div class="span1"></div>
			<div class="span10" style="margin-top:20px">
				<div style="background-color:#eee;width:33.3%;height: 300px;float:left;">
					<div style="margin:25px;line-height:30px;">	
						<h4 style="text-align:center">衡水永佳电动伸缩门配件厂</h4>公司已有十余年的发展历史，主要生产电动伸缩门配件（轮类，轮罩，机头轮，行走轮等），专业维修电动伸缩门，在市场经济的大潮下，本厂跻身国内大型专业生产厂家的行列，生产的铸铁轮，橡胶轮等产品被许多国家大中型重点工程所采用，取得了经济效益和社会效益的双丰收。
						<p style="text-align:right;"><a href="#">更多信息&gt;&gt;</a></p>
					</div>
				</div>
				<div name="Carousel_img" style="width:66.7%;float:right;">
					<div id="myCarousel" class="carousel slide" >
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<?php $i = 0;foreach($this->arrImg[3] as $img){$i++;?>
							<div class="<?php if(1==$i)echo 'active';?> item"><img style="width:700px;height:300px" src="<?php echo $img['path']?>" alt=""></div>
							<?php }?>
						</div>
						<a id="prev" style="display:none" class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a id="next" style="display:none" class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
					</div>
				</div>

			</div>
		</div>	

		<div class="row-fluid">
			<div class="span1"></div>
			<?php foreach($this->arrImg[4] as $img){?>
			<div class="span2">
				<div style="background-color:#eee;padding-top:5px;padding-bottom:2px;">
					<div style="margin:0 auto;margin-top:10px;border:1px solid #ddd;width:130px;height:130px;text-align:center;padding:3px">
						<img width="130px" height="130px" src="<?php echo $img['path'];?>">
					</div>
					<div style="text-align:center;margin-top:10px;margin-bottom:10px"><?php echo $img['description']; ?></div>
				</div>
			</div>
			<?php }?>
			</div>
		</div>
		<div style="width:83%;height:1px;margin:0px auto;margin-top:20px;margin-bottom:19px;background-color:#D5D5D5;"></div>

		<div class="row-fluid">
			<div class="span10 offset1">
				<?php $index = 0;foreach($this->arrImg[5] as $img){$index++;?>
				<div class="span4 shadow-box">
				<a href="#" class="thumbnail"><img style="width:100%;height:100%" src="<?php echo $img['path']?>"></a>
				</div>
				<?php }?>
			</div>
		</div>



		<div class="row-fluid">
			<div class="span10 offset1" style="margin-top:10px">
				<div class="span4">
					<h5>行业咨询</h5>
					<ul>
					<?php 
					$index=0;
					foreach($this->arrNews[7] as $news){
						$index++;
						if($index<7){
					?>
						<li><?php echo String::trword($news['content'],15); ?></li>
					<?php }}?>
					</ul>
					<p style="text-align:center"><a href="#">更多信息&gt;&gt;</a></p>

				</div>
				<div class="span4">
					<h5>销售网络</h5>
					<ul class="unstyled">
						<li>华东地区: 沈阳 大连 长春 黑龙江 鸡西</li>
						<li>华北地区：北京 天津 承德 秦皇岛 霸州</li>
						<li>华东地区：济南 济宁 南京 义乌</li>
						<li>华中地区：武汉 襄樊 异常 长沙</li>
						<li>华南地区：广州 深圳 珠海 厦门 海口</li>
						<li>西部地区: 兰州 西安 重庆 成都</li>
					</ul>
					<p style="text-align:center"><a href="#">更多信息&gt;&gt;</a></p>
				</div>
				<div class="span4">
					<h5>在线留言</h5>
					<textarea style="height:140px;width:96%" rows="5" placeholder="请记得留下您的联系方式"></textarea>
					<button class="btn" style="float:right;" type="submit">提交</button>
				</div>
			</div>

		</div>

<script>
	$('.carousel').carousel();

    $('div[name="Carousel_img"]').bind({
		mouseover: function(){
			$('#prev').css('display', 'block');
            $('#next').css('display', 'block');
		},
		mouseout: function(){
			$('#prev').css('display', 'none');
            $('#next').css('display', 'none');
        }
	});
</script>
<?php require_once dirname(__FILE__) . '/inc/footer.html'; ?>

