<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=yahoo&act=man"><span>Hỗ trợ trực tuyến</span></a></li>
          <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}		
</script>
<form name="f" id="f" method="post">
  <div class="control_frm" style="margin-top:0;">
    	<div style="float:left;">
    	  <input type="button" class="greenB" value="Thêm" onclick="location.href='index.php?com=yahoo&act=add'" />
        <input type="button" class="redB" value="Xoá" onclick="ChangeAction('index.php?com=yahoo&act=man&multi=del');return false;" />
      </div>    
  </div>
  <div class="oneOne">
    <div class="widget mtop0">
      <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
        <thead>
          <tr>
            <td style="position: relative;">
              <span class="titleIcon"><input type="checkbox"  id="titleCheck" name="titleCheck" /></span>
            </td>
            <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
            <td class="sortCol"><div>Tên<span></span></div></td>
            <!-- <td class="sortCol"><div>Email<span></span></div></td> -->
            <td class="sortCol"><div>Điện thoại<span></span></div></td>
            <td class="tb_data_small">Ẩn/Hiện</td>
            <td class="tb_data_small">Thao tác</td>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
            <td>
                <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
            </td>
            <td align="center">
                <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự danh mục" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('yahoo', '<?=$items[$i]['id']?>')" />
                <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            </td>       
            <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ten']?></a>
            </td>
            
            <!-- <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['email']?></a>
            </td> -->

            <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['dienthoai']?></a>
            </td>
            
            <td align="center">
              <a data-val2="table_yahoo" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
            </td>
            
            <td class="actBtns">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
                <a href="" onclick="CheckDelete('index.php?com=yahoo&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa danh mục"><img src="./images/icons/dark/close.png" alt=""></a>
            </td>
          </tr>
          <?php } ?> 
        </tbody>
      </table>
    </div>
  </div>
</form>
<div class="paging"><?=$paging?></div>