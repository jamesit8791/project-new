<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'thanhvien';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});

		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.php?com=thanhvien&act=man&keyword="+keyword;
		});

    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=thanhvien&act=delete&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});
</script>


<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=thanhvien&act=man"><span>Quản lý Thành viên</span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				  <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			    <?php }  else { ?>
          <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
          <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
  <div class="control_frm" style="margin-top:0;">
    	<div style="float:left;">
      	<input type="button" class="greenB" value="Thêm" onclick="location.href='index.php?com=thanhvien&act=add'" />
        <input type="button" class="redB" value="Xoá Chọn" id="xoahet" />
      </div>  
  </div>
  <div class="oneOne">
    <div class="title">
      <div class="timkiem">
        <span>Tìm kiếm:</span>
        <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
        <button type="button" class="blueB"  value="">Tìm kiếm</button>
      </div>
    </div>
  </div>
  <div class="oneOne">
    <div class="widget mtop0">
      <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
        <thead>
          <tr>
            <td class="tb_data_small" style="position: relative;">
              <span class="titleIcon"><input type="checkbox"  id="titleCheck" name="titleCheck" /></span>
            </td>
            <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>           
            <td class="sortCol">Tên tài khoản</tdtd>
    		    <td class="sortCol">Họ tên</td>
            <td class="tb_data_small">Ẩn/Hiện</td>
            <td class="tb_data_small"">Thao tác</td>
          </tr>
        </thead>

        <tbody>
          <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
            <td>
              <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
            </td>

            <td align="center">
                <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
                <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            </td> 
            <td class="title_name_data"><?=$items[$i]['email']?></td>
            <td class="title_name_data">
                <a href="index.php?com=thanhvien&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['username']?></a>
            </td>
            <td align="center">
              <a data-val2="table_thanhvien" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
            </td>
           
            <td class="actBtns">
                <a href="index.php?com=thanhvien&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

                <a href="index.php?com=thanhvien&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</form>
<div class="paging"><?=$paging?></div>