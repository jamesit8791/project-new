<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
	<div class="control_frm">
	    <div class="bc">
	        <ul id="breadcrumbs" class="breadcrumbs">
	        	<li><a href="index.php?com=yahoo&act=man"><span>Hỗ trợ trực tuyến</span></a></li>
	            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
	        </ul>
	        <div class="clear"></div>
	    </div>
	</div>
	<form name="supplier" id="validate" class="form" action="index.php?com=yahoo&act=save" method="post" enctype="multipart/form-data">
		<div class="oneOne">
			<div class="widget mtop10">
				<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
					<h6>Nhập dữ liệu</h6>
				</div>		
				<div class="formRow">
					<label>Tên</label>
					<div class="formRight">
		                <input type="text" name="name" title="Nhập tên nhân viên hỗ trợ" id="name" class="tipS" value="<?=@$item['ten']?>" />
					</div>
					<div class="clear"></div>
				</div>
		        <div class="formRow">
					<label>Điện thoại</label>
					<div class="formRight">
		                <input type="text" name="dienthoai" title="Nhập số điện thoại" id="dienthoai" class="tipS" value="<?=@$item['dienthoai']?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label>Màu nền</label>
					<div class="formRight">
		                <input type="color" name="maunen" title="Nhập màu nền" id="maunen" class="tipS" value="<?=@$item['maunen']?>" />
					</div>
					<div class="clear"></div>
				</div>
		       <!--  <div class="formRow">
					<label>Email</label>
					<div class="formRight">
		                <input type="text" name="email" title="Nhập địa chỉ email" id="email" class="tipS" value="<?=@$item['email']?>" />
					</div>
					<div class="clear"></div>
				</div>
		        <div class="formRow">
					<label>Zalo</label>
					<div class="formRight">
		                <input type="text" name="yahoo" title="Nhập số điện thoại zalo" id="zalo" class="tipS" value="<?=@$item['yahoo']?>" />
					</div>
					<div class="clear"></div>
				</div>
		        <div class="formRow">
					<label>Skype</label>
					<div class="formRight">
		                <input type="text" name="skype" title="Nhập nick chat skype" id="skype" class="tipS" value="<?=@$item['skype']?>" />
					</div>
					<div class="clear"></div>
				</div> -->
				     
		        <div class="formRow">
		          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
		          <div class="formRight">
		            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
		            <label for="check1">Hiển thị</label>            
		          </div>
		          <div class="clear"></div>
		        </div>
		        <div class="formRow">
		            <label>Số thứ tự: </label>
		            <div class="formRight">
		                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
		            </div>
		            <div class="clear"></div>
		        </div>
				<div class="formRow">
					<div class="formRight">
		                 <input type="hidden" name="id" id="id_this_yahoo" value="<?=@$item['id']?>" />
		            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
		            	<a href="index.php?com=yahoo&act=man" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS redB" original-title="Thoát">Thoát</a>
					</div>
					<div class="clear"></div>
				</div>
			</div>  
		</div>
	</form>
</div>