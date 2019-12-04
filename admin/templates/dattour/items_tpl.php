<script type="text/javascript">
function select_status()
{
  var a=document.getElementById("id_tinhtrang");
  window.location ="index.php?com=dattour&act=man&id_tinhtrang="+a.value; 
  return true;
}
</script>
<?php
function tinhtrang()
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_select" onchange="select_status()">	
      <option value="0">Xem theo tình trạng đặt tour</option>
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_tinhtrang"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
function tinhtrang_nc()
  {
    $sql="select * from table_tinhtrang order by id";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_tinhtrang_nc" name="id_tinhtrang_nc" class="select_nc"> 
      <option value="0">Xem theo tình trạng đặt tour</option>
      ';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_tinhtrang"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }	
?>
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=dattour&act=man"><span>đặt tour</span></a></li>
          <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá đặt tour này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn muốn xóa?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}		
	$(document).ready(function() {
      $('.ngayset').datetimepicker({
        lang:'en',
        timepicker:false,
        format:'d/m/Y',
        formatDate:'Y/m/d'
      }); 

      $('#search_btn').click(function() {
        var loai = 1;
        var madonhang = $('#madonhang').val();
        var id_tinhtrang = $('#id_tinhtrang').val();
        var dienthoai = $('#dienthoai').val();
        var hoten = $('#hoten').val();
        window.location ="index.php?com=dattour&act=man&loai="+loai+"&madonhang="+madonhang+"&id_tinhtrang="+id_tinhtrang+"&dienthoai="+dienthoai+"&hoten="+hoten; 
        return true;
      });

      $('#search_btn_nc').click(function() {
        var loai = 2;
        var madonhang_nc = $('#madonhang_nc').val();
        var id_tinhtrang_nc = $('#id_tinhtrang_nc').val();
        var dienthoai_nc = $('#dienthoai_nc').val();
        var hoten_nc = $('#hoten_nc').val();
        var ngaybd = $('#ngaybd_nc').val();
        var ngaykt = $('#ngaykt_nc').val();
        var giatu = $('#giatu_nc').val();
        var giaden = $('#giaden_nc').val();
        window.location ="index.php?com=dattour&act=man&loai="+loai+"&madonhang="+madonhang_nc+"&id_tinhtrang="+id_tinhtrang_nc+"&dienthoai="+dienthoai_nc+"&hoten="+hoten_nc+"&ngaybd="+ngaybd+"&ngaykt="+ngaykt+"&giatu="+giatu+"&giaden="+giaden; 
        return true;
      });


  });			
</script>
<form name="f" id="f" method="post">
<div class="oneOne" style="margin-top:0;">
    <div style="float:left;">
      <input type="button" name="id_tinhtrang" class="xoa_dt redB" value="Xoá" onclick="ChangeAction('index.php?com=dattour&act=man&multi=del');return false;" />
      <input type="text" name="madonhang" id="madonhang" class="input_search" placeholder="Mã đặt tour" />
      <input type="text" name="hoten" id="hoten" class="input_search" placeholder="Họ và tên" />
      <input type="text" name="dienthoai" id="dienthoai" class="input_search" placeholder="Số điện thoại" />
      <?=tinhtrang()?>
      <input type="button" id="search_btn" class="greenB" value="Tìm" />
      <input type="button" id="search_nc" data-modal="modal-7" class="md-trigger blueB" value="Tìm kiếm nâng cao" />

       <div class="md-modal md-effect-7" id="modal-7">
        <div class="md-content">
          <h3>Tìm kiếm nâng cao</h3>
          <div>
            <div class="formsear_donhang">
              <div class="formsear_donhang_row2">
                <input type="text" name="madonhang_nc" id="madonhang_nc" value="" placeholder="Mã đặt tour" class="text_search">
              </div>
              <div class="formsear_donhang_row2">
                <input type="text" name="hoten_nc" id="hoten_nc" value="" placeholder="Họ tên khách hàng" class="text_search">
              </div>
              <div class="formsear_donhang_row2">
                <input type="text" name="dienthoai_nc" id="dienthoai_nc" value="" placeholder="Điện thoại" class="text_search">
              </div>
              <div class="formsear_donhang_row2">
                <?=tinhtrang_nc()?>
              </div>
              <div class="formsear_donhang_row2">
                <input type="text" name="ngaybd_nc" id="ngaybd_nc" value="" placeholder="Từ ngày" class="text_search ngayset">
              </div>
              <div class="formsear_donhang_row2">
                <input type="text" name="ngaykt_nc" id="ngaykt_nc" value="" placeholder="Đến ngày" class="text_search ngayset">
              </div>
               <div class="formsear_donhang_row2">
                <input type="text" name="giatu_nc" id="giatu_nc" value="" placeholder="Giá từ" class="text_search conso">
              </div>
              <div class="formsear_donhang_row2">
                <input type="text" name="giaden_nc" id="giaden_nc" value="" placeholder="Giá đến" class="text_search conso">
              </div>
            </div>
            <div style="text-align: center; padding-top: 10px; width: 100%; float: left;">
              <a style="cursor: pointer;" class="md-tim" id="search_btn_nc">Tìm kiếm</a>
              <a style="cursor: pointer;" class="md-close">Đóng lại</a>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
      <div class="md-overlay"></div>
    </div> 
</div>
<div class="oneOne">
  <div class="widget mtop10">
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td style="position: relative;">
          <span class="titleIcon"><input type="checkbox"  id="titleCheck" name="titleCheck" /></span>
        </td>
        <td class="sortCol" width="120"><div>Mã tour<span></span></div></td>     
        <td class="sortCol"><div>Họ tên<span></span></div></td>
        <td class="sortCol"><div>Điện thoại<span></span></div></td>
        <td class="sortCol" width="150"><div>Ngày đặt<span></span></div></td>
        <td width="150">Số tiền</td>
        <td width="150">Tình trạng</td>
        <td class="tb_data_small none">Xuất</td>
        <td class="tb_data_small">Thao tác</td>
      </tr>
    </thead>
    <tbody>
      <?php for($i=0, $count=count($items); $i<$count; $i++){?>
      <tr>
        <td>
          <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="left" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
          <?=$items[$i]['madat']?>
        </td> 
        <td <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
          <?=$items[$i]['hoten']?>
        </td>
        <td align="left" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
          <?=$items[$i]['dienthoai']?>
        </td>
        <td align="left" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
          <?=date('d/m/Y - g:i A',$items[$i]['ngaytao']);?>
        </td>
        <td align="left" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
          <?=number_format($items[$i]['gia'],0, ',', '.')?>&nbsp;VNĐ
        </td>
        <td align="left" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
           <?php 
              $sql="select trangthai from #_tinhtrang where id= '".$items[$i]['trangthai']."' ";
              $d->query($sql);
              $result=$d->fetch_array();
              echo $result['trangthai'];
           ?>
        </td>
        <td class="actBtns none">
            <a href="export.php?id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xuất đặt tour"><img src="./images/icons/dark/excel.png" alt=""></a>
        </td>
        <td class="actBtns">
            <a href="index.php?com=dattour&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xem và sửa đặt tour"><img src="./images/icons/dark/preview.png" alt=""></a>
            <a href="" onclick="CheckDelete('index.php?com=dattour&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa đặt tour"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
</form>               

 
<!-- classie.js by @desandro: https://github.com/desandro/classie -->
<script src="js/ModalWindowEffects/js/classie.js"></script>
<script src="js/ModalWindowEffects/js/modalEffects.js"></script>

<!-- for the blur effect -->
<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
<script>
  // this is important for IEs
  var polyfilter_scriptpath = '/js/';
</script>
<script type="text/javascript">
function onSearch(evt) {	
		var datefm = document.getElementById("datefm").value;	
		var dateto = document.getElementById("dateto").value;
		var status = document.getElementById("id_tinhtrang").value;		
		//var encoded = Base64.encode(keyword);
		location.href = "index.php?com=dattour&act=man&datefm="+datefm+"&dateto="+dateto+"&status="+status;
		loadPage(document.location);
			
}
$(document).ready(function(){						
	var dates = $( "#datefm, #dateto" ).datepicker({
			defaultDate: "+1w",
			dateFormat: 'dd/mm/yy',
			changeMonth: true,			
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				var option = this.id == "datefm" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
        
		});
		
</script>