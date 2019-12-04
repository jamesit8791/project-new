<div class="title t-center bx-border brt-none pb-5 bg-white w-100">
    <h1 class="ds-inline-block f-none p-relative"><?=$title?></h1>
</div>
<div class="desc">
	<div class="content-video">
		<?php for($i=0;$i<count($tintuc);$i++){ ?>
		<div class="item-video">
			<a data-fancybox="gallery" href="http://www.youtube.com/embed/<?=youtobi($tintuc[$i]['links'])?>?autoplay=1"" title="<?=$tintuc[$i]['ten_'.$lang]?>">
				<img src="http://i1.ytimg.com/vi/<?=youtobi($tintuc[$i]['links'])?>/0.jpg" alt="<?=$tintuc[$i]['ten_'.$lang]?>">
			</a>
			<h3>
				<?=$tintuc[$i]['ten_'.$lang]?>
			</h3>
		</div>
		<?php } ?>
	</div>
</div>