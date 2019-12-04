<script>
function text_count_changed(textfield_id,counter_id){
	var v = $(textfield_id).val();
	if(parseInt(v.length) > 170){
		$(textfield_id).css('border', '1px solid #D90000');
		$(textfield_id).css('background', '#e5e5e5');
		$(counter_id).val(parseInt(v.length));
	}else{
		$(textfield_id).css('border', '1px solid #DDDDDD');
		$(textfield_id).css('background', '#FFF');
		$(counter_id).val(parseInt(v.length));
	}
}
$(document).ready(function(){
	text_count_changed("#description","#des_char");
	$('#description').blur(function(event) {
		text_count_changed($(this),"#des_char");
	});
	$('#description').keypress(function(event) {
		text_count_changed($(this),"#des_char");
	});
});
</script>
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
<div class="wrapper">

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=album&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$config_cap['title']?></span></a></li>
            <li class="current"><a href="#" onclick="return false;"><?=($_GET['act']=='edit_list') ? 'Sửa':'Thêm'?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=album&act=save_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
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


		<div class="<?=($config_cap['full']==true) ? 'oneOne':'colLeft' ?>">
			<div class="widget mtop0">
				<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
					<h6>Thông tin</h6>
				</div>

				<?php if($config_cap['img']==true){ ?>
				<div class="formRow">
					<label>Tải hình ảnh:</label>
					<div class="formRight">
		            	<input type="file" id="file" name="file" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<br/>
						<br/>
						<span style="display: inline-block; line-height: 30px;color:#CCC;">
						 	Width: <?=$config_cap['img-width']*$config_cap['img-ratio']?>px - <?=$config_cap['img-height']*$config_cap['img-ratio']?>px
						</span>
					</div>
					<div class="clear"></div>
				</div>
		        <?php if($_GET['act']=='edit_list' && $item['thumb']!=''){?>
				<div class="formRow">
					<label>Hình Hiện Tại :</label>
					<div class="formRight">
						<div class="mt10"><img src="<?=_upload_album.$item['thumb']?>"  alt="NO PHOTO" width="40" /></div>
					</div>
					<div class="clear"></div>
				</div>
				<?php } ?>
				<?php } ?>

		        <?php  foreach ($config['lang'] as $k => $v){ ?>
		        <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
					<label>Tiêu đề [<?=$v?>]</label>
					<div class="formRight">
		                <input type="text" name="ten_<?=$k?>" title="Nhập tên danh mục" id="ten_<?=$k?>" class="tipS validate[required]" value="<?=@$item['ten_'.$k]?>" />
					</div>
					<div class="clear"></div>
				</div>
				<?php } ?>

				<div class="formRow">
		          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
		          <div class="formRight">
		         
		            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
		             <label>Số thứ tự: </label>
		              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
		          </div>
		          <div class="clear"></div>
		        </div>

			</div>
			<div class="clear"></div>
		</div>
		<div class="<?=($config_cap['full']==true) ? 'oneOne':'colRight' ?>">
			<?php if($config_cap['seo']==true){ ?>
			<div class="widget mtop0">
				<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
					<h6>Thuộc tính SEO</h6>
				</div>
				
				<div class="formRow">
					<label>Title</label>
					<div class="formRight">
						<input type="text" value="<?=@$item['title']?>" name="title" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<label>Từ khóa</label>
					<div class="formRight">
						<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho danh mục" class="tipS" />
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<label>Description:</label>
					<div class="formRight">
						<textarea rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description" id="description"><?=@$item['description']?></textarea>
		                <input readonly="readonly" type="text" style="width:45px; margin-top:10px; text-align:center;" name="des_char" id="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
					</div>
					<div class="clear"></div>
				</div>

				
			</div>
			<div class="clear"></div>
			<?php } ?>
		</div>
	</div>  
	<div class="formRow fixedBottom">
		<div class="formRight">
            <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
            <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
        	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
        	<a href="index.php?com=album&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS redB" original-title="Thoát">Thoát</a>

		</div>
		<div class="clear"></div>
	</div>
</form>
</div>
