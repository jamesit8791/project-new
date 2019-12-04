
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
    $count_page = 6;
    $moi = (string)$_POST["id_loaiview"];
    if($_POST["id_danhmuc"]==0){
      $str_van = "select type,tenkhongdau,ten_$lang as ten,id,photo from table_album where $moi!=0 and type='cong-trinh' and hienthi=1 order by stt asc,id desc";
    }else{
      $str_van = "select type,tenkhongdau,ten_$lang as ten,id,photo from table_album where $moi!=0 and type='cong-trinh' and id_list='".(int)$_POST["id_danhmuc"]."' and hienthi=1 order by stt asc,id desc";
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

<div class="item7 bx-border">
  <div class="img">
    <a href="<?=$row['type']?>/<?=$row['tenkhongdau']?>.html" title="<?=$row['ten']?>">
      <img src="resize/350x222/1/<?=_upload_album_l.$row['photo']?>" alt="<?=$row['ten']?>">
    </a>
  </div>
  <div class="desc">
    <h3>
      <a href="<?=$row['type']?>/<?=$row['tenkhongdau']?>.html" title="<?=$row['ten']?>">
        <?=$row['ten']?>
      </a>
    </h3>
  </div>
</div>
<?php $i++; } ?>
<?php if($count>$count_page){ ?>
<?php echo $paging->Load(); ?>
<?php } ?>