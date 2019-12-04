<?php
	session_start();
	@define ( '_template' , '../templates/');
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');

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

	@$id = (int)$_POST['id'];

	$product_dmx = get_result_array("select id,ten_$lang,tenkhongdau,thumb,masp,photo,masp,giaban,giacu,mota_$lang,spmoi,noibat,banchay,video,luotxem from #_product where noibat!=0 and id_cat='".$id."' and hienthi=1 and type='san-pham' order by stt asc,id desc limit 0,6");
?>
<?php
	if(count($product_dmx)>0){
?>

<?php for($i=0;$i<count($product_dmx);$i++){ ?>
<div class="product-slide animated zoomIn product-hover cl-3 bx-border f-left">
	<div class="product bg-white w-100">
	    <div class="product-img o-hidden w-100">
	        <a href="san-pham/<?=$product_dmx[$i]['tenkhongdau']?>.html" title="<?=$product_dmx[$i]['ten_'.$lang]?>">
	          <img src="resize/300x270/1/<?=_upload_product_l.$product_dmx[$i]['photo']?>" alt="<?=$product_dmx[$i]['ten_'.$lang]?>">
	        </a>
	    </div>
	  	<div class="product-title w-100 mt-10">
			<h4><a href="san-pham/<?=$product_dmx[$i]['tenkhongdau']?>.html" title="<?=$product_dmx[$i]['ten_'.$lang]?>">
				<?=$product_dmx[$i]['ten_'.$lang]?>
			</a></h4>
			<p>
				<?php if($product_dmx[$i]['giacu']!=0){ ?>
                <span class="price-old"><?=($product_dmx[$i]['giacu']!=0) ? number_format($product_dmx[$i]['giacu'],0, ',', '.').' đ' : 'Liên hệ' ?></span>
                <?php } ?>
                <span class="price"><?=($product_dmx[$i]['giaban']!=0) ? number_format($product_dmx[$i]['giaban'],0, ',', '.').' đ' : 'Liên hệ' ?></span>
            </p>
		</div>
	</div>
</div>
<?php } ?>

<?php }else{ ?>
	<div class="w-100 t-center">
		Sản phẩm đang được cập nhật
	</div>
<?php } ?>
