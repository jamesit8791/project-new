<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'hoidap';
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
			window.location.href="index.php?com=hoidap&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
		});

    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=hoidap&act=delete&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});


</script>

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=hoidap&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main?></span></a></li>
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
      	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=hoidap&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
          <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />

      </div>  
  </div>
  <div class="oneOne">
    <div class="title">
        <div class="timkiem">
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
            <td style="position: relative;text-align: center !important;"  width="3%">
              <span class="titleIcon">
                <input type="checkbox" id="titleCheck" name="titleCheck" />
              </span>
            </td>
            <td class="tb_data_small" width="8%"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>           
            <td width="35%" class="sortCol"><div>Tiêu đề <?=$title_main?><span></span></div></td>
            <td width="35%" class="tb_data_small" style="text-align: left !important;">Tên người đặt câu hỏi</td>
            <td width="8%" style="text-align: center !important;">Ẩn/Hiện</td>
            <td width="8%" style="text-align: center;">Thao tác</td>
          </tr>
        </thead>

        <tbody>
             <?php for($i=0, $count=count($items); $i<$count; $i++){?>
              <tr>
           <td  width="3%">
                <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
            </td>

           
            <td align="center" width="8%">
                <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

                <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            </td> 
            
            <td class="title_name_data">
                <a href="index.php?com=hoidap&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['noidung']?></a>
            </td>
            <td class="title_name_data">
              Họ tên: <?=$items[$i]['ten']?><br>
              Email: <?=$items[$i]['email']?><br>
              Điện thoại: <?=$items[$i]['dienthoai']?><br>
            </td>
        
             <td align="center" width="8%">
              <a data-val2="table_hoidap" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
            </td>
           
            <td class="actBtns" width="8%">
                <a href="index.php?com=hoidap&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

                <a href="index.php?com=hoidap&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
            </td>
          </tr>
        <?php } ?>
       </tbody>
      </table>
    </div>
  </div>
</form>  
<div class="paging"><?=$paging?></div>