
<script type="text/javascript">		
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});
</script>

<form name="supplier" id="validate" class="form" action="index.php?com=company&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="control_frm">
	    <div class="bc">
	        <ul id="breadcrumbs" class="breadcrumbs">
	        	<li><a href="index.php?com=company&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Cập nhật <?=$title_main?></span></a></li>
	        </ul>
	        <div class="clear"></div>
	    </div>
	</div>
	<div class="mtop0">
		<div class="oneOne">
			<div class="widget mtop0">
				<div class="title chonngonngu" style="border-bottom: 0px solid transparent">
					<ul>
						<?php  foreach ($config['lang'] as $k => $v){ ?>
						<li><a href="<?=$k?>" class="<?= ($k == 'vi') ? 'active': '' ?> tipS" title="<?=$v?>"><img src="./images/<?=$k?>.png" alt="" class="<?=changeTitle($v)?>" /><?=$v?></a></li>
						<?php } ?>
					</ul>
				</div>	
			</div>
		</div>
		<div class="oneOne">
			<div class="widget mtop0">
				<?php  foreach ($config['lang'] as $k => $v){ ?>
				<div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
					<label>Nội dung [<?=$v?>]</label>
					<div class="ck_editor">
		                <textarea title="Nhập nội dung . " id="noidung_<?=$k?>" class="ck_editors" name="noidung_<?=$k?>"><?=@$item['noidung_'.$k]?></textarea>
					</div>
					<div class="clear"></div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="formRow fixedBottom">
        	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Cập nhật" />
			<div class="clear"></div>
		</div>
	</div>
</form>   