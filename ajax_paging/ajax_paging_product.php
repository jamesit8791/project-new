
<?php
  session_start();
  @define ( '_template' , '../templates/');
  @define ( '_source' , '../sources/');
  @define ( '_lib' , '../libraries/');
  
  if(!isset($_SESSION['lang']))
  {
  $_SESSION['lang']='vi';
  }
  $lang=$_SESSION['lang'];
  
  include_once _lib."config.php";
  include_once _lib."constant.php";
  include_once _lib."functions.php";
  include_once _lib."class.database.php";
  include_once _source."lang_$lang.php";
  include_once _lib."functions_giohang.php";
  include_once _lib."file_requick.php";
  include_once "class_paging_ajax.php";
  $d = new database($config['database']);
  
  if(isset($_POST["page"]))
  {
    $count_page = 8;
    $moi = (string)$_POST["id_loaiview"];
    if($_POST["id_danhmuc"]==0){
      $str_van = "select type,tenkhongdau,ten_$lang as ten,id,photo,giaban from table_product where $moi!=0 and type='san-pham' and hienthi=1 order by stt asc,id desc";
    }else{
      $str_van = "select type,tenkhongdau,ten_$lang as ten,id,photo,giaban from table_product where $moi!=0 and type='san-pham' and id_list='".(int)$_POST["id_danhmuc"]."' and hienthi=1 order by stt asc,id desc";
    }
    $paging = new paging_ajax();

    $paging->class_pagination = "pagination";
    $paging->class_active = "active";
    $paging->class_inactive = "inactive";
    $paging->class_go_button = "go_button";
    $paging->class_text_total = "total";
    $paging->class_txt_goto = "txt_go_button";
    $paging->per_page = $count_page;  
    $paging->page = $_POST["page"];
    $paging->text_sql = $str_van;
    $d->reset();
    $sql = $str_van;
    $d->query($sql);
    $tintuc_moi = $d->result_array();
    $count = count($tintuc_moi);
    $result_pag_data = $paging->GetResult();
    $message = '';
    $paging->data = "" . $message . "";
  }

?>

<?php
$i=0;
  while ($row = mysql_fetch_array($result_pag_data)){ 
?>

<div class="item cl-4">
  <div class="box">
    <div class="img">
      <a href="<?=$row['type']?>/<?=$row['tenkhongdau']?>.html" title="<?=$row['ten']?>">
        <img src="resize/365x268/1/<?=_upload_product_l.$row['photo']?>" alt="<?=$row['ten']?>">
      </a>
    </div>
    <div class="desc t-center">
      <h3><a href="<?=$row['type']?>/<?=$row['tenkhongdau']?>.html" title="<?=$row['ten']?>"><?=$row['ten']?></a></h3>
      <?php if($row['giaban']!=0){ ?>
      <p>Giá: <span class="price"><?=number_format($row['giaban'],0, ',', '.')?></span> <u>đ</u></p>
      <?php }else{ ?>
      <p>Liên hệ: <span class="price"><?=$row_setting['hotline']?></span></p>
      <?php } ?>
    </div>
  </div>
</div>
<?php $i++; } ?>
<?php if($count>$count_page){ ?>
<?php echo $paging->Load(); ?>
<?php } ?>