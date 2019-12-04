<?php
function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_select">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	?>
<script type="text/javascript">

function TreeFilterChanged2(){		
			$('#validate').submit();		
}
function update(id){
	if(id>0){
		var sl=$('#product'+id).val();
		if(sl>0){
			$('#ajaxloader'+id).css('display', 'block');	
			jQuery.ajax({
				type: 'POST',
				url: "ajax.php?do=cart&act=update",
				data: {'id':id, 'sl':sl},				
				success: function(data) {					
					$('#ajaxloader'+id).css('display', 'none');	
					var getData = $.parseJSON(data);
					$('#id_price'+id).html(addCommas(getData.thanhtien)+'&nbsp;VNĐ');
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
			});			
		}else alert('Số lượng phải lớn hơn 0');
	}
}

function del(id){
	if(id>0){				
		jQuery.ajax({
			type: 'POST',
			url: "ajax.php?do=cart&act=delete",
			data: {'id':id},			
			success: function(data) {										
					var getData = $.parseJSON(data);
					$('#productct'+id).css('display', 'none');	
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
		});
	}
}
</script> 

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=dattour&act=mam"><span>Đặt tour</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Xem và sửa Đặt tour</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=dattour&act=save" method="post" enctype="multipart/form-data">
	<div class="oneOne">
		<div class="widget mtop0">
			
			<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
				<h6>Thông tin Đặt tour <?=@$item['madat']?></h6>
			</div>
			<div class="oneOne mtop10">
				<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
					<h6>Thông tin người mua</h6>
				</div>
				
		        <div class="formRow">
					<label style="white-space: initial;">Họ tên: <span style="color: #999;"><?=@$item['hoten']?></span></label>
					<div class="clear"></div>
				</div>	
		        
		        <div class="formRow">
					<label style="white-space: initial;">Điện thoại: <span style="color: #999;"><?=@$item['dienthoai']?></span></label>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label style="white-space: initial;">Email: <span style="color: #999;"><?=@$item['email']?></span></label>
					<div class="clear"></div>
				</div>	
		         <div class="formRow">
					<label style="white-space: initial;">Số khách: <span style="color: #999;"><?=$item['sokhach']?> khách</span></label>
					<div class="clear"></div>
				</div>	
				
		        <div class="formRow">
					<label style="white-space: initial;">Địa chỉ: <span style="color: #999;"><?=@$item['diachi']?></span></label>
					<div class="clear"></div>
				</div>	
		        
		        <div class="formRow">
					<label style="white-space: initial;">Yêu cầu thêm: <span style="color: #999;"><?=@$item['noidung']?></span></label>
					<div class="clear"></div>
				</div>	
			</div>		        
	        
	    </div>
	</div>
	<div class="oneOne">
		<div class="widget mtop0">
	        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
			    <thead>
			      <tr>
			        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">STT</a></td>      
			        <td class="sortCol"><div>Tên sản phẩm<span></span></div></td>
			        <td width="150" align="center" style="text-align: center !important;">Hình ảnh</td>
			        <td width="150" align="center" style="text-align: center !important;">Số khách</td>
			        <td width="150" align="center" style="text-align: center !important;">Đơn giá</td>
			        <td width="150" align="center" style="text-align: center !important;">Thành tiền</td>
			      </tr>
			    </thead> 
	    		<tbody>
		 		<?php $product_detail = get_fetch_array("select * from #_product where id='".(int)$item['id_product']."'"); ?>
		        <tr id="productct">
		          <td>1</td>
		          <td><?=$product_detail['ten_'.$lang]?></td>
		           <td align="center"><img src="<?=_upload_product.$product_detail['photo']?>" height="100"  /></td>
		          <td align="center"><?=$item['sokhach']?></td>
		          <td align="left"><?=number_format($product_detail['giaban'],0, ',', '.')?>&nbsp;VNĐ</td>
		          <td align="left"><?=number_format($item['gia'],0, ',', '.')?>&nbsp;VNĐ</td>
		        </tr>
			    <tr>
			        <td colspan="5"><div class="pagination">Tổng tiền</div></td>
			        <td><div class="pagination" id="sum_price"> <?=number_format($item['gia'],0, ',', '.')?>&nbsp;VNĐ</div></td>
			      </tr>
		    	</tbody>
		    </table>
		</div>
	</div>
        
	<div class="oneOne">
		<div class="widget mtop0">
			<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
				<h6>Thông tin thêm</h6>
			</div>
	        
			<div class="formRow">
				<label>Mô tả ngắn:</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Viết ghi chú cho Đặt tour" class="tipS" name="ghichu" id="ghichu"><?=@$item['ghichu']?></textarea>
				</div>
				<div class="clear"></div>
			</div>	
	        
	        <div class="formRow">
				<label>Tình trạng</label>
				<div class="formRight">
	            	<div class="selector">
						<?=tinhtrang($item['trangthai'])?>
	                </div>
				</div>
				<div class="clear"></div>
			</div>	
	        
	        
		</div>
	</div>
   
	<div class="formRow fixedBottom">
		<div class="formRight">	     
	        <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
	    	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Cập nhật" />
		</div>
		<div class="clear"></div>
	</div>
</form>