<?php
		session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	$lang = 'vi';

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$login_name = 'NINACO';	

	$d = new database($config['database']);
	
	$noidung = $_POST['noidung'];
	$ten= $_POST['tieude'];
	$tenkhongdau = changeTitle($_POST['tieude']);
	$ngaytao = $_POST['ngaydang'];
	$mota = $_POST['mota'];
	$type = 'tin-tuc';
	$hienthi = 1;

	$sql = "INSERT INTO  table_baiviet (noidung_vi,ten_vi,ngaytao,mota_vi,hienthi,type,tenkhongdau) VALUES ('$noidung','$ten','$ngaytao','$mota','$hienthi','$type','$tenkhongdau')";
	mysql_query($sql);
	
?>