<div class="container">
  <div class="about row ds-flex flex-wrap flex-between">
    <div class="item t">
      <h4>Giới thiệu về chúng tôi</h4>
      <h2><span><?=$row_setting['ten_'.$lang]?></span></h2>
      <?=$gioithieu['mota']?>
      <div class="read">
        <a href="gioi-thieu" role="button">Xem thêm<span class="btn ml-2"><i class="fa fa-arrow-right" aria-hidden="true"></i></span></a>
      </div>
    </div>
    <div class="item t">
    	<div class="slickAbout" id="slickAbout">
    		<?php for($i=0;$i<count($about);$i++){ ?>
    		<div>
    			<img src="resize/600x400/1/<?=_upload_hinhanh_l.$about[$i]['photo']?>" alt="<?=$about[$i]['ten']?>">
    		</div>
    		<?php } ?>
    	</div>
    </div>
  </div>
</div>