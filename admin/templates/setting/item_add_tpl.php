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
	function TreeFilterChanged2(){
		$('#validate').submit();
	}
</script>

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=setting&act=capnhat"><span>Thiết lập hệ thống</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Cấu hình website</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=setting&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
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

	<div class="colLeft">
		<div class="widget mtop0">
			<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
				<h6>Thông tin chung</h6>
			</div>


			<?php  foreach ($config['lang'] as $k => $v){ ?>
	        <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
				<label>Tiêu đề [<?=$v?>]</label>
				<div class="formRight">
	                <input type="text" name="ten_<?=$k?>" title="Nhập tên công ty" id="ten_<?=$k?>" class="tipS validate[required]" value="<?=@$item['ten_'.$k]?>" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
				<label>Địa chỉ [<?=$v?>]</label>
				<div class="formRight">
	                <input type="text" name="diachi_<?=$k?>" title="Nhập địa chỉ" id="diachi_<?=$k?>" class="tipS validate[required]" value="<?=@$item['diachi_'.$k]?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden none lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
				<label>Slogan [<?=$v?>]</label>
				<div class="formRight">
	                <input type="text" name="slogan_<?=$k?>" title="Nhập slogan" id="slogan_<?=$k?>" class="tipS validate[required]" value="<?=@$item['slogan_'.$k]?>" />
				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>

			<div class="formRow">
				<label>Email</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập địa chỉ email" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow none">
				<label>Thời gian làm việc</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['thoigian_lv']?>" name="thoigian_lv" title="Nhập thời gian làm việc" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Hotline</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['hotline']?>" name="hotline" title="Nhập hotline" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>

	        <div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập số điện thoại" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Website</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['website']?>" name="website" title="Nhập địa chỉ website" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Nhúng bản đồ vào web</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Những đoạn code nhúng bản đồ vào đây" class="tipS" name="toado"><?=@$item['toado']?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow none">
				<label>Link lịch sử hình thành </label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Link lịch sử hình thành" class="tipS" name="link_history"><?=@$item['link_history']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Link bản đồ </label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Những đoạn code nhúng bản đồ vào đây" class="tipS" name="link_map"><?=@$item['link_map']?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			
			<div class="formRow">
				<label>FanPage Facebook</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['facebook']?>" name="facebook" title="Nhập link fanpage facebook" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>

		</div>
		<div class="widget mtop10">
			<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
				<h6>Code chèn thêm</h6>
			</div>
			<div class="formRow">
				<label>Code chèn trong thẻ head:</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Những đoạn code khách hàng muốn chèn trên header của website" class="tipS" name="analytics"><?=@$item['analytics']?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Code chèn trong thẻ body :</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Những đoạn code khách hàng muốn chèn trên footer của website" class="tipS" name="vchat"><?=@$item['vchat']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="colRight">
		<div class="widget mtop0">
			<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
				<h6>Thuộc tính cấu hình</h6>
			</div>
			<div class="formRow none">
				<label>Số item sản phẩm / 1 page</label>
				<div class="formRight">
	                <input type="text" name="page_sp" title="Nhập số item sản phẩm" id="page_sp"  class="tipS" value="<?=@$item['page_sp']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số item bài viết / 1 page</label>
				<div class="formRight">
	                <input type="text" name="page_ne" title="Nhập số item bài viết" id="page_ne"  class="tipS" value="<?=@$item['page_ne']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow none">
				<label>Số item trang chủ / 1 page</label>
				<div class="formRight">
	                <input type="text" name="page_in" title="Nhập số item trang chủ" id="page_in"  class="tipS" value="<?=@$item['page_in']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Màu footer</label>
				<div class="formRight">
	                <input type="color" name="maufooter" title="Nhập màu footer" id="maufooter"  class="tipS" value="<?=@$item['maufooter']?>" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Favicon :</label>
				<div class="formRight">
	            	<input type="file" id="file" name="file1" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Favicon :</label>
				<div class="formRight">
					<img src="<?=_upload_hinhanh.@$item['bgtop']?>" alt="Upload hình" class="icon_question tipS" width="50">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow none">
				<label>Hình đóng dấu :</label>
				<div class="formRight">
	            	<input type="file" id="file" name="file2" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow none">
				<label>Tải video:</label>
				<div class="formRight">
	            	<input type="file" id="video" name="video" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Định dạng MP4 dung lượng dưới 16MB">
					 <span style="display: inline-block; line-height: 30px;color:#CCC;">
	                   Định dạng MP4 dung lượng dưới 16MB
	                </span>
				</div>
				<div class="clear"></div>
			</div>

	        
			<div class="formRow none">
				<label>Video Hiện Tại :</label>
				<div class="formRight">
					<video id="videochinh" autoplay loop muted playsinline style="width: 100%; height: 200px;">
	                    <source src="<?=_upload_hinhanh.$item['video']?>" type="video/mp4" class="video_slider">
	                </video>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow none">
				<label>Hình đóng dấu :</label>
				<div class="formRight" style="background: #333333;">

					<img src="<?=_upload_hinhanh.@$item['bgcontent']?>" alt="Upload hình" class="icon_question tipS" width="100">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow none">
				<label>Tag:</label>
				<div class="formRight">
					<input id="tags_1" type="text" name="tags" class="tags" value="<?=@$item['tags']?>" />
				</div>
				<div class="clear"></div>
			</div>
		</div>



		<div class="widget mtop10">
			<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
				<h6>Nội dung seo</h6>
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
					<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho website" class="tipS" />
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
	</div>
    <div class="formRow fixedBottom">
		<div class="formRight">
            <input type="hidden" name="id" id="id_this_setting" value="<?=@$item['id']?>" />
        	<input type="submit" class="blueB"  value="Hoàn tất" />
        	<a href="index.php" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS redB" original-title="Thoát">Thoát</a>
		</div>
		<div class="clear"></div>
	</div>
</form>
