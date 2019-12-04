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
	
    updatesl($id,$soluong);
   	
    $total = get_total();
    $giax = get_price($id)*$soluong;
    $totalorder = get_order_total();



    $array_list = array(
		'total' => $total,
		'totalorder' => number_format(get_order_total(),0, ',', '.'),
		'thanhtien' => number_format($giax,0, ',', '.'),
		'status' => 1,
		'message' => $message
	);
	echo json_encode($array_list);
?>