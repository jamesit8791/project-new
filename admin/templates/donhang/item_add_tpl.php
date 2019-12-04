<?php
function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="trangthai" name="trangthai" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	$d->reset();
	$sql = "select hoten from #_thanhvien where id='".$item['nguoimua']."' ";
	$d->query($sql);
	$thanhvien = $d->result_array();
	?>
<h3>Chi tiết đơn hàng</h3>

<form name="frm" method="post" action="index.php?com=order&act=save" enctype="multipart/form-data" class="nhaplieu">
	<b>Thành Viên :</b> <strong><a  href="index.php?com=thanhvien&act=edit&id=<?=$item['nguoimua']?>"><?=@$thanhvien[0]['hoten']?></a></strong><br />	
	<b>Mã đơn hàng:</b> <strong><?=@$item['madonhang']?></strong><br />		    
    <b>Họ tên: </b><strong><?=@$item['hoten']?></strong><br />		  
        <b>Điện thoại: </b><strong><?=@$item['dienthoai']?></strong><br />		  
        <b>Email: </b><strong><?=@$item['email']?></strong><br />		  
            <b>Địa chỉ: </b><strong><?=@$item['diachi']?></strong><br /><br />
            <b>HT Thanh Toán : </b><strong><?=@$item['httt']?></strong><br />	  <br />	
            <b>Thanh toán : </b>
            		<input type="radio" name="thanhtoan_1" value="0" <?php if($item['thanhtoan']==0){?> checked="checked"<?php } ?> /> Chưa thanh toán 
                    <input type="radio" name="thanhtoan_1" value="1" <?php if($item['thanhtoan']==1){?> checked="checked"<?php } ?> /> Đã thanh toán
            <br />	  <br />	
            
            <b>Nội dung thêm:</b>
	<div>
	<span style="color:#009999; font-weight:bold;"><?=$item['noidung']?></span></div>	  
    <div>  <br />	
    
<?=tact_gh($item['donhang']);?>
    
    
  </div><br/>  <br />	
	
	
    <b>Ghi chú</b>
     <textarea name="ghichu" cols="50" rows="5" id="ghichu"><?=@$item['ghichu']?></textarea><br/><br/>
     <b>Tình trạng</b><?=tinhtrang($item['trangthai'])?><br/>
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=order&act=man'" class="btn" />
</form>