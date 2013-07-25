

<!-- Gallery  statrt -->
<div class="container-fluid">
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
		<a id="f_screen" class="btn btn-info">
            <span>Fullscreen</span>
        </a>
    </div>
</div>


<div id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery" data-slideshow="4000">
	<?php foreach($this->arrImg as $img){?>
    	<a href="<?php echo $img['path']; ?>" title="<?php echo $img['description']; ?>" data-gallery="gallery"><div style="float:left;width:100px;height:100px"><img src="<?php echo $img['path']; ?>"/></div></a>
	<?php }?>
</div>

<script>
	$('#f_screen').bind('click', function(){
		$('#modal-gallery').addClass('modal-fullscreen modal-fullscreen-stretch');
	});
</script>
</div>
<!-- Gallery  end -->

