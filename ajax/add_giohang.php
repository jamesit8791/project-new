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
		
	@$id = (int)$_POST['id'];
	@$soluong = (int)$_POST['sl'];
	
    addtocart($id,$soluong);
   
    $danhmucps = get_fetch_array("select id,ten_vi from #_product where hienthi=1 and type='san-pham' and id='".$id."' order by stt asc,id desc");
    $message = "<p class='line-cart'>Bạn đã mua thành công [<span class='cl-orange'>".$danhmucps['ten_vi']."</span>]</p>";
    $total = get_total();
    $totalorder = get_order_total();

	/*
	$max_gh=count($_SESSION['cart']);
	$strf = '';
    for($i=0;$i<$max_gh;$i++){

    	$pid=$_SESSION['cart'][$i]['productid'];

    	$product = get_fetch_array("select * from #_product where id='".$pid."' and hienthi=1 and type='san-pham' order by stt asc,id desc");
		$q=$_SESSION['cart'][$i]['qty'];
		$pname=get_product_name($pid);
		$phinh=get_product_img($pid,$lang,_upload_product_l,$config_url,50);
		$codemd5=$_SESSION['cart'][$i]['codemd5'];
		if($q==0) continue;

    	$strf .= '<li>
			<div class="product-image">
				<a href="'.$product['tenkhongdau'].'" title="'.$product['ten_'.$lang].'">
					<img src="resize/50x50/1/'._upload_product_l.$product['photo'].'" alt="'.$product['ten_'.$lang].'">
				</a>
			</div>
			<div class="product-details">
				<p><a href="" title="'.$product['ten_'.$lang].'">'.$product['ten_'.$lang].'</a></p>
				<p><span>'.$q.'</span> x <b>'.number_format($product['giaban'],0, ',', '.').' VNĐ</b></p>
			</div>
			<div class="product-action">
				<span class="update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
				<span class="delete" data-id="'.$codemd5.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
			</div>
		</li>';
    }
	*/


    $array_list = array(
		'total' => $total,
		'totalorder' => number_format($totalorder,0, ',', '.'),
		'status' => 1,
		'message' => $message
	);
	echo json_encode($array_list);
?>