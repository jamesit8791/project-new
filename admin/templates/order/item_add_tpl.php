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

<?php
$citys = get_fetch_array("select id,ten from #_place_city where hienthi=1 and id='".$item['city']."' order by id desc");
$dists = get_fetch_array("select id,ten from #_place_dist where hienthi=1 and id='".$item['dist']."' order by id desc");	

$citys_nguoinhan = get_fetch_array("select id,ten from #_place_city where hienthi=1 and id='".$item['city_nguoinhan']."' order by id desc");
$dists_nguoinhan = get_fetch_array("select id,ten from #_place_dist where hienthi=1 and id='".$item['dist_nguoinhan']."' order by id desc");	

?>
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=order&act=mam"><span>Đơn hàng</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Xem và sửa đơn hàng</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=order&act=save" method="post" enctype="multipart/form-data">
	<div class="oneOne">
		<div class="widget mtop0">
			
			<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
				<h6>Thông tin đơn hàng <?=@$item['madonhang']?></h6>
			</div>
			<div class="oneTwo mtop10">
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
					<label style="white-space: initial;">Tỉnh thành: <span style="color: #999;"><?=$citys['ten']?></span></label>
					<div class="clear"></div>
				</div>	
				 <div class="formRow">
					<label style="white-space: initial;">Quận huyện: <span style="color: #999;"><?=$citys['ten']?></span></label>
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
	        <div class="oneTwo mtop10">
		        <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
					<h6>Thông tin người nhận</h6>
				</div>
				
		        <div class="formRow">
					<label style="white-space: initial;">Họ tên: <span style="color: #999;"><?=@$item['hoten_nguoinhan']?></span></label>
					<div class="clear"></div>
				</div>	
		        
		        <div class="formRow">
					<label style="white-space: initial;">Điện thoại: <span style="color: #999;"><?=@$item['dienthoai_nguoinhan']?></span></label>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label style="white-space: initial;">Email: <span style="color: #999;"><?=@$item['email_nguoinhan']?></span></label>
					<div class="clear"></div>
				</div>	
		         <div class="formRow">
					<label style="white-space: initial;">Tỉnh thành: <span style="color: #999;"><?=$citys_nguoinhan['ten']?></span></label>
					<div class="clear"></div>
				</div>	
				 <div class="formRow">
					<label style="white-space: initial;">Quận huyện: <span style="color: #999;"><?=$citys_nguoinhan['ten']?></span></label>
					<div class="clear"></div>
				</div>	
		        <div class="formRow">
					<label style="white-space: initial;">Địa chỉ: <span style="color: #999;"><?=@$item['diachi_nguoinhan']?></span></label>
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
			        <td width="150" align="center" style="text-align: center !important;">Đơn giá</td>
			        <td width="150" align="center" style="text-align: center !important;">Số lượng</td>
			        <td width="150" align="center" style="text-align: center !important;">Thành tiền</td>
			        <td class="tb_data_small none">Thao tác</td>
			      </tr>
			    </thead> 
	    		<tbody>
		 		<?php      
					$tongtien=0;          
					for($i=0,$count_donhang=count($result_ctdonhang);$i<$count_donhang;$i++){	
					$pid=$result_ctdonhang[$i]['id_product'];
						
						
					$pname=get_product_name($pid);
					$pphoto=get_thumb($pid);
					$tongtien+=	$result_ctdonhang[$i]['gia']*$result_ctdonhang[$i]['soluong'];				
				?>
			        <tr id="productct<?=$result_ctdonhang[$i]['id']?>">
			          <td><?=$i+1?></td>
			          <td><?=$pname?></td>
			           <td align="center"><img src="<?=_upload_product.$pphoto?>" height="100"  /></td>
			          <td align="center"><?=number_format($result_ctdonhang[$i]['gia'],0, ',', '.')?>&nbsp;VNĐ</td>
			          <td align="center"><?=$result_ctdonhang[$i]['soluong']?><!-- <input type="text" class="tipS" style="width:50px; text-align:center" original-title="Nhập số lượng sản phẩm" maxlength="3" value="<?=$result_ctdonhang[$i]['soluong']?>" onchange="update(<?=$result_ctdonhang[$i]['id']?>)" id="product<?=$result_ctdonhang[$i]['id']?>">
			          <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$result_ctdonhang[$i]['id']?>" src="images/loader.gif" alt="loader" /> --></div>
			            &nbsp;</td>
			          <td align="left" id="id_price<?=$result_ctdonhang[$i]['id']?>"><?=number_format($result_ctdonhang[$i]['gia']*$result_ctdonhang[$i]['soluong'],0, ',', '.')?>&nbsp;VNĐ</td>
			          <td class="actBtns none"><a class="smallButton tipS" original-title="Xóa sản phẩm" href="javascript:del(<?=$result_ctdonhang[$i]['id']?>)"><img src="./images/icons/dark/close.png" alt=""></a></td>
			        </tr>
			    <?php } ?>
			    <tr>
			        <td colspan="5"><div class="pagination">Tổng tiền</div></td>
			        <td><div class="pagination" id="sum_price"> <?=number_format(get_tong_tien($item['madonhang']),0, ',', '.')?>&nbsp;VNĐ</div></td>
			        
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
					<textarea rows="8" cols="" title="Viết ghi chú cho đơn hàng" class="tipS" name="ghichu" id="ghichu"><?=@$item['ghichu']?></textarea>
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