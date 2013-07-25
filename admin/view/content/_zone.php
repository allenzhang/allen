<?php require_once dirname(__FILE__) . '/../inc/header.html'; ?>
	<?php if('img'==$this->type){ ?>
		<?php require_once dirname(__FILE__) . '/_image.php'; ?>
	<?php }elseif('news'==$this->type){ ?>
		<?php require_once dirname(__FILE__) . '/_news.php'; ?>
	<?php } ?>
<?php require_once dirname(__FILE__) . '/../inc/footer.html'; ?>
