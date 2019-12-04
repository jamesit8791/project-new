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
	$d = new database($config['database']);


	$idlist = (int)$_POST['idlist'];
	$total = (int)$_POST['total'];
	$showed = (int)$_POST['showed'];
	$subtotal = (int)$_POST['subtotal'];

	$product_bc = get_result_array("select id,ten_$lang as ten,tenkhongdau,thumb,photo,giaban,giacu from #_product where hienthi=1 and type='san-pham' and id_list='".$idlist."' order by stt asc,id desc limit $showed,4");
?>
<?php for($i=0;$i<count($product_bc);$i++){ ?>
    <div class="cl-4">
      <div class="box">
        <div class="img">
          <a href="<?=$product_bc[$i]['tenkhongdau']?>" title="<?=$product_bc[$i]['ten']?>">
            <img src="resize/300x250/2/<?=_upload_product_l.$product_bc[$i]['photo']?>" alt="<?=$product_bc[$i]['ten']?>">
          </a>
        </div>
        <div class="desc t-center">
          <h3><a href="<?=$product_bc[$i]['tenkhongdau']?>" title="<?=$product_bc[$i]['ten']?>"><?=$product_bc[$i]['ten']?></a></h3>
          <p>Thùng 110 ml</p>
          <p>Hạn sử dụng: 1 tháng</p>
          <p>
            <?php if($product_bc[$i]['giaban']!=0){ ?>
            <span class="price"><?=number_format($product_bc[$i]['giaban'],0, ',', '.')?> <u>đ</u></span> 
            <?php }else{ ?>
            Liên hệ: <span class="price"><?=$row_setting['hotline']?></span>
            <?php } ?>
            <?php if($product_bc[$i]['giacu']!=0){ ?>
            <span class="price-old"><?=number_format($product_bc[$i]['giacu'],0, ',', '.')?> <u>đ</u></span>
            <span class="sale"><?=giamgia($product_bc[$i]['giacu'],$product_bc[$i]['giaban'])?></span>
            <?php } ?>

          </p>
        </div>
      </div>
    </div>
  <?php } ?>