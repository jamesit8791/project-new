<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'product_cat';
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
			window.location.href="index.php?com=product&act=man_cat&type=<?=$_GET['type']?>&keyword="+keyword;
		});
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=product&act=delete_cat&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});

  function select_list()
  {
    var a=document.getElementById("id_list");
    window.location ="index.php?com=product&act=man_cat&type=<?=$_GET['type']?>&id_list="+a.value; 
    return true;
  }
</script>
<?php
  function get_main_list()
  {
    $sql="select * from table_product_list where type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_list" name="id_list" onchange="select_list()" class="main_select">
      <option value="">Chọn danh mục 1</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_list"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
?>

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=product&act=man_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$config_cap2['title']?></span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				  <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			    <?php }else{ ?>
          <li class="current"><a href="#" onclick="return false;"><?=_title?></a></li>
          <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="f" id="f" method="post">

  <div class="control_frm" style="margin-top:0;">
      <div style="float:left;">
        <input type="button" class="greenB" value="Thêm" onclick="location.href='index.php?com=product&type=<?=$_GET['type']?>&act=add_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
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
          <td style="position: relative;">
            <span class="titleIcon"><input type="checkbox"  id="titleCheck" name="titleCheck" /></span>
          </td>
          <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
          <?php if($config_cap2['img']==true){ ?>
          <td style="width: 100px; text-align: center;">Hình ảnh</td>
          <?php } ?>   
          <?php if($cap1==true){ ?>
          <td class=""><?=get_main_list()?></td>
          <?php } ?>
          
          <td class="sortCol"><div>Tên danh mục<span></span></div></td>
          <td class="tb_data_small">Nổi bật</td>
          <td class="tb_data_small">Ẩn/Hiện</td>
          <td class="tb_data_small">Thao tác</td>
        </tr>
      </thead>

      <tbody>
        <?php for($i=0, $count=count($items); $i<$count; $i++){?>
        <tr>
          <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
          </td>

          <td align="left">
              <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự <?=_title?>" rel="<?=$items[$i]['id']?>" />
              <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
          </td>
           <?php if($config_cap2['img']==true){ ?>
            <td align="center">
              <a href="index.php?com=product&act=edit_cat&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold">
                <img src="<?=_upload_product.$items[$i]['photo']?>" alt="" width="100">
              </a>
            </td>
            <?php } ?> 
          <?php if($cap1==true){ ?>
          <td align="left">
            <?php
              $d->reset();
              $sql = "select ten_vi from table_product_list where id='".$items[$i]['id_list']."'";
              $result=mysql_query($sql);
              $name_danhmuc =mysql_fetch_array($result);
              echo @$name_danhmuc['ten_vi'];
            ?>  
          </td>
          <?php } ?>

          <td class="title_name_data">
            <a href="index.php?com=product&act=edit_cat&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold">
              <?=$items[$i]['ten_vi']?>
            </a>
          </td>
           <td align="center">
            <a data-val2="table_product_cat" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
          </td>
          <td align="center">
            <a data-val2="table_product_cat" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
          </td>

          <td class="actBtns">
              <a href="index.php?com=product&act=edit_cat&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa <?=_title?>"><img src="./images/icons/dark/pencil.png" alt=""></a>

              <a href="index.php?com=product&act=delete_cat&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa <?=_title?>"><img src="./images/icons/dark/close.png" alt=""></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
 </div>
</form>
<div class="pagination t-right"><?=$paging?></div>