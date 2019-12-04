<div class="container">
	<div id="header-menu">
		<div class="logo">
			<a href="" title="<?=$row_setting['ten_'.$lang]?>">
				<img src="<?=_upload_hinhanh_l.$logo_top['photo']?>" alt="<?=$row_setting['ten_'.$lang]?>">
			</a>
		</div>
		<div class="banner">
			<?php include_once _template."layout/search.php"; ?>
		</div>
		<div class="hotline">
			<p>Hotline hỗ trợ</p>
			<p><?=$row_setting['hotline']?></p>
		</div>
		<div class="left-page">
          <?php include_once _template."layout/left.php"; ?>
        </div>
	</div>
</div>
